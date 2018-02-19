<?php 
// require(APPPATH.'libraries/fpdf/fpdf.php');
class TPDF extends FPDF
{
	// Page header
	var $oinfo;
	var $pdf_type;
	var $tAmount=0.00;
	var $setLogo = false;
	// var $logoPath = $_SERVER['DOCUMENT_ROOT'].'/OnSys/assets/pics/lhead.jpg';
	var $logoPath = 'H:/XAMPP/htdocs/OnSys12/OnSys/assets/pics/lhead.jpg';
	function setRows($data)
	{
		$this->oinfo = $data;
		// $this->$pdf_type = $pdftype;
	}
	function Header()
	{
		// $this->SetFont('Arial','BU',16);
		// if($pdf_type == "order"){
		//     // Logo
		//     //$this->Image('logo.png',10,6,30);
		//     // Arial bold 15

		//     // Move to the right
		//     //$this->Cell(80);
		// 	$this->Cell(100,10,'Order #: '.$this->oinfo['OmId'],1,0);
		// 	$this->SetFont('Arial','',12);
		// 	$this->Cell(70,10,'Date: '.date("d-m-Y",strtotime($this->oinfo['OmCreatedOn'])),1,1);
		// 	$this->MultiCell(170,10,'Name: '.$this->oinfo['OmCompanyName'],1);
		// 	$this->Cell(70,10,'LPO: '.$this->oinfo['OmLpo'],1,0,'L');
		// 	$this->Cell(100,10,'Salesman: '.$this->oinfo['OmCreatedBy'],1,1);
		// 	// Line break
		//     $this->Ln(5);
		// }elseif ($pdf_type == "invoice") {

		$this->SetFillColor(217,217,217);
		$fill=true;
		//row 1

		$this->SetFont('Arial','',10);
		$this->Image($this->logoPath,30,5,170,30);
		$this->Ln(30);
		//$this->Cell(170,30,"",0,1); //black space for logo or something
		$this->Cell(170,5,"VAT Number: 100019982600003",0,1,'R');
		$this->SetFont('Arial','BU',16);
		$this->Cell(170,5,"Tax Invoice",0,1,'C');

		$this->SetFont('Arial','',9);
		//row2
		$this->Cell(80,5,'Customer Details',1,0,'L',$fill);
		$this->Cell(45,5,'Invoice #',1,0,'C',$fill);
		$this->Cell(45,5,'Date',1,1,'C',$fill);

		//row3
		$this->Cell(15,5,'Name',1,0,'L',$fill);
		$X = $this->GetX();
		$Y = $this->GetY();
		$this->MultiCell(65,5,$this->oinfo['InOmCompanyName'],1,'L');
		$Y2 = $this->GetY();
		$this->SetXY($X+65,$Y);
		$this->Cell(45,5,$this->oinfo['InId'],1,0,'C');
		$this->Cell(45,5,date('d-m-Y h:i a', strtotime($this->oinfo['InCreatedOn'])),1,1,'C');
		$this->SetXY($X-15,$Y2);
		// $this->Ln();
		//row4
		$this->Cell(15,5,'Address',1,0,'L',$fill);
		$this->Cell(65,5,$this->oinfo['InOmAdd'],1,0,'L');
		$this->Cell(45,5,'Customer ID',1,0,'C',$fill);
		$this->Cell(45,5,'Due Date',1,1,'C',$fill);

		//row5
		$this->Cell(15,5,'Phone',1,0,'L',$fill);
		$this->Cell(65,5,$this->oinfo['InOmTel1'],1,0,'L');
		$this->Cell(45,5,$this->oinfo['InOmCompanyCode'],1,0,'C');
		$this->Cell(45,5,date('d-m-Y', strtotime($this->oinfo['inDueDate'])),1,1,'C');

		//row6
		$this->Cell(15,5,'Phone 2',1,0,'L',$fill);
		$this->Cell(65,5,$this->oinfo['InOmTel2'],1,0,'L');
		$this->Cell(90,5,'VAT Registration #',1,1,'C',$fill);

		//row7
		$this->Cell(15,5,'LPO No:',1,0,'L',$fill);
		$this->Cell(65,5,$this->oinfo['InOmLpo'],1,0,'C');
		$this->Cell(90,5,$this->oinfo['ClVatNo'],1,1,'C');

		//row8 table column header

		$this->cell(10,5,'No.',1,0,'C'); //sr no
		$this->cell(30,5,'Part No',1,0,'C'); //part no
		$this->cell(55,5,'Description',1,0,'C'); //description
		$this->cell(15,5,'Left Qty',1,0,'C'); //left qty
		$this->cell(15,5,'Right Qty',1,0,'C'); //right qty
		$this->cell(15,5,'Total Qty',1,0,'C'); //total qty
		$this->cell(15,5,'Price',1,0,'C'); //price
		$this->cell(15,5,'Amount',1,1,'C'); //amount
		// $this->cell(); //

		// }
	}
	function InvoiceTable($rows)
	{

	    // Colors, line width and bold font
		$this->SetFillColor(255,255,255);
	    // $this->SetTextColor(255);
	    //$this->SetDrawColor(128,0,0);
	    //$this->SetLineWidth(.3);
	    $this->SetFont('Arial','B',10);
	    // Header
		//$header = array("Sr #", "Supplier #", "Description", "R-Qty", "L-Qty", "T-Qty","Price","Amount");
	    $headerwidth = array(10, 30, 55, 15, 15, 15,15,15);

	    //for($i=0;$i<count($header);$i++)
	    //    $this->Cell($headerwidth[$i],10,$header[$i],1,0,'C',true);
	     ////$this->Ln();

	    // Color and font restoration
	    //$this->SetFillColor(78, 77, 79);
	    // $this->SetTextColor(0);
	    // $this->SetFont('');
	    // Data
		$this->SetFillColor(217,217,217);
	    $fill = false; // Flag
		$rc = 1; // RowCount
		$totalAmount = 0.00; //Total Counter
		$this->SetFont('Arial','',10);
	    foreach($rows as $row)
	    {
			// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
			$amount = number_format(($row['IiOiPrice'] * $row['IiOiTotalQty']), 2, '.', '');
	        $this->Cell($headerwidth[0],6,$rc,1,0,'L',$fill);
	        // $this->Cell($headerwidth[1],6,$row['IiOiPartNo'],1,0,'L',$fill);
			$this->SetFontSize(8);
			$this->Cell($headerwidth[1],6,$row['IiOiSupplierNo'],1,0,'L',$fill);
			$this->Cell($headerwidth[2],6,$row['IiOiDescription'],1,0,'L',$fill);
			$this->SetFontSize(10);
			$this->Cell($headerwidth[3],6,$row['IiOiLeftQty'],1,0,'C',$fill);
			$this->Cell($headerwidth[4],6,$row['IiOiRightQty'],1,0,'C',$fill);
			$this->Cell($headerwidth[5],6,$row['IiOiTotalQty'],1,0,'C',$fill);
			$this->Cell($headerwidth[6],6,$row['IiOiPrice'],1,0,'R',$fill);
			$this->Cell($headerwidth[7],6,$amount,1,0,'R',$fill);
			$this->SetFontSize(10);
			$this->Ln();
			$totalAmount += $amount; //$amount is amount for each item. added on to totalAmount for sum.
			$this->tAmount = $totalAmount;
	        $fill = !$fill;
			$rc += 1;
	    }

		// $this->Ln();
		// $this->Cell(85);
		// $this->Cell(45,6,"Total Amount (AED): ",1,0,'R',$fill);
		// $this->Cell(30,6,$this->oinfo['InAmount'],1,0,'R',$fill);
		// $this->Ln();
		// $this->Cell(85);
		// $this->Cell(45,6,"- Discount (AED): ",1,0,'R');
		// $this->Cell(30,6,$this->oinfo['InDiscount'],1,0,'R');
		// $this->Ln();
		// $this->Cell(85);
		// $this->Cell(45,6,"VAT ".$this->oinfo['InVatPercent']."% (AED): ",1,0,'R',$fill);
		// $this->Cell(30,6,$this->oinfo['InVatAmount'],1,0,'R',$fill);
		// $this->Ln();
		// $this->Cell(85);
		// $this->Cell(45,6,"Net Total (AED): ",1,0,'R');
		// $this->Cell(30,6,$this->oinfo['InNetAmount'],1,0,'R');
		// $this->Ln();


		// $this->Cell(30,6,number_format($totalAmount, 2, '.', ''),'LTRB',0,'R',$fill);
	    // Closing line
	    //$this->Cell(array_sum($headerwidth),0,'','T');
	}
	function Footer()
	{
		//Go to 5 cm from the bottom
		$this->SetY(-50);
		//Set font
		$this->SetFont('Arial','',10);
		$this->SetFillColor(217,217,217);
		$fill = true;

		// $this->Cell(30,6,$this->tAmount,1,0,'R',$fill);
		// $this->Cell(65);
		//Above 2 lines were experimental, can replace the oinfo[inamount] to $his->tAmount for per page Item Sum.

		$this->Cell(50,6,"Receivers Signature",1,0,'C',$fill);
		$this->Cell(45);
		$this->Cell(45,6,"Total Amount (AED): ",1,0,'R',$fill);
		$this->Cell(30,6,$this->oinfo['InAmount'],1,0,'R',$fill);
		$this->Ln();
		$this->Cell(95);
		$this->Cell(45,6,"- Discount (AED): ",1,0,'R');
		$this->Cell(30,6,$this->oinfo['InDiscount'],1,0,'R');
		$this->Ln();
		$this->Cell(95);
		$this->Cell(45,6,"VAT ".$this->oinfo['InVatPercent']."% (AED): ",1,0,'R',$fill);
		$this->Cell(30,6,$this->oinfo['InVatAmount'],1,0,'R',$fill);
		$this->Ln();
		$this->Cell(95);
		$this->Cell(45,6,"Net Total (AED): ",1,0,'R');
		$this->Cell(30,6,$this->oinfo['InNetAmount'],1,0,'R');
		$this->Ln();
	}
}