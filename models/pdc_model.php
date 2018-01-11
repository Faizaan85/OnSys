<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(FCPATH.'application/libraries/Fpdf/Fpdf.php');
class PDF extends FPDF
{
	protected $B = 0;
	protected $I = 0;
	protected $U = 0;
	protected $HREF = '';
	
	// Page header
	function Header(){	// Logo
		//Header
		//$this->Image(SITEURL.'external/image/header.jpg',10,10,190,0,'jpg',SITEURL);
		$this->SetFont('helvetica','',20);
		$title = "Quotation";
		$this->Cell(0,10,$title,0,2,'C',false);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(2,20,250,20);
		// Line break
		$this->Ln(5);
	}

	// Page footer
	/*function Footer(){
		// Footer
		$this->SetY(-35);
		//$this->Image(SITEURL.'external/image/footer.jpg',10,null,190);
	
		$this->SetY(-50);
		$this->SetFont('helvetica','',18);
		
		$title ="Rivendell Carpets & Flooring Limited. Baynton Road, Ashton, Bristol, BS3 2EB";
		$title1 ="t: 0117 963 7979 f: 0117 966 4269 e: info@rivendellcarpets.co.uk www.rivendell.co.uk";
		$title ="Invoice";
		
		$w = $this->GetStringWidth($title)+6;
		$this->SetX(85);
		$this->Cell(35,5,$title,0,2,'C',false);
		$this->SetX(0);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(2,320,250,320);
		
		$w = $this->GetStringWidth($title1)+6;
		$this->SetX((210-$w)/2);
		$this->Cell($w,5,$title1,0,2,'C',false);
	}*/
	
	/*function Footer(){
		
		$this->SetY(-50);
		$this->SetFont('helvetica','',10);
		$title1 ="Invoice";
		//$this->SetX(90);
		$w = $this->GetStringWidth($title1)+6;
		$this->SetX(170);
		$this->Cell($w,10,'Page '.$this->PageNo(),0,2,'C',false);
		$this->SetX(150);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(1,320,250,320);
		
		
	}*/
	
	function WriteHTML($html){
		// HTML parser
		$html = str_replace("\n",' ',$html);
		$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e){
			if($i%2==0){
				// Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else
					$this->Write(5,$e);
			}else{
				// Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else{
					// Extract attributes
					$a2 = explode(' ',$e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach($a2 as $v){
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}
	
	function OpenTag($tag, $attr){
		// Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF = $attr['HREF'];
		if($tag=='BR')
			$this->Ln(5);
	}

}
class INVOICEPDF extends FPDF
{
	protected $B = 0;
	protected $I = 0;
	protected $U = 0;
	protected $HREF = '';
	
	// Page header
	function Header(){	// Logo
		//Header
		//$this->Image(SITEURL.'external/image/header.jpg',10,10,190,0,'jpg',SITEURL);
		$this->SetFont('helvetica','',20);
		$title = "Invoice";
		$this->Cell(0,10,$title,0,2,'C',false);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(2,20,250,20);
		// Line break
		$this->Ln(5);
	}

	// Page footer
	/*function Footer(){
		// Footer
		$this->SetY(-35);
		//$this->Image(SITEURL.'external/image/footer.jpg',10,null,190);
	
		$this->SetY(-50);
		$this->SetFont('helvetica','',18);
		
		$title ="Rivendell Carpets & Flooring Limited. Baynton Road, Ashton, Bristol, BS3 2EB";
		$title1 ="t: 0117 963 7979 f: 0117 966 4269 e: info@rivendellcarpets.co.uk www.rivendell.co.uk";
		$title ="Invoice";
		
		$w = $this->GetStringWidth($title)+6;
		$this->SetX(85);
		$this->Cell(35,5,$title,0,2,'C',false);
		$this->SetX(0);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(2,320,250,320);
		
		$w = $this->GetStringWidth($title1)+6;
		$this->SetX((210-$w)/2);
		$this->Cell($w,5,$title1,0,2,'C',false);
	}*/
	
	/*function Footer(){
		
		$this->SetY(-50);
		$this->SetFont('helvetica','',10);
		$title1 ="Invoice";
		//$this->SetX(90);
		$w = $this->GetStringWidth($title1)+6;
		$this->SetX(170);
		$this->Cell($w,10,'Page '.$this->PageNo(),0,2,'C',false);
		$this->SetX(150);
		$this->SetDrawColor(150,188,188);
		$this->SetLineWidth(2.3);
		$this->Line(1,320,250,320);
		
		
	}*/
	
	function WriteHTML($html){
		// HTML parser
		$html = str_replace("\n",' ',$html);
		$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
		foreach($a as $i=>$e){
			if($i%2==0){
				// Text
				if($this->HREF)
					$this->PutLink($this->HREF,$e);
				else
					$this->Write(5,$e);
			}else{
				// Tag
				if($e[0]=='/')
					$this->CloseTag(strtoupper(substr($e,1)));
				else{
					// Extract attributes
					$a2 = explode(' ',$e);
					$tag = strtoupper(array_shift($a2));
					$attr = array();
					foreach($a2 as $v){
						if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
							$attr[strtoupper($a3[1])] = $a3[2];
					}
					$this->OpenTag($tag,$attr);
				}
			}
		}
	}
	
	function OpenTag($tag, $attr){
		// Opening tag
		if($tag=='B' || $tag=='I' || $tag=='U')
			$this->SetStyle($tag,true);
		if($tag=='A')
			$this->HREF = $attr['HREF'];
		if($tag=='BR')
			$this->Ln(5);
	}

}
class Pdc_model extends CI_Model
{
	
    function getCustomerWithAgCodeForSelect2($search = "", $id = 0)
	{
		$this->db->select('tblCustomerMaster.cstId as id ,tblCustomerMaster.cstCode as code');
		$this->db->from('tblCustomerMaster');
		$this->db->where('tblCustomerMaster.cstIsActive', '1');
		$this->db->where('tblCustomerMaster.cstIsDelete', '0');
		if($search != "")
		{
			$this->db->like('tblCustomerMaster.cstCode', $search); 
		}
		
		if($id <> 0)
		{
			$this->db->where('tblCustomerMaster.cstId', $id);
		}		
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}
	
	function getAllQuotation($filter_name, $sort, $order,$limit = '' , $start = ''){
		
		$order = ($order == 'desc') ? 'desc' : 'asc';
		$this->db->select('tblPDC.*');
		$this->db->from('tblPDC');
		$this->db->where('pdcIsDelete',0);
		if($start == 1)
		{
			$start = $start - 1;
		}
		$this->db->limit($limit,$start);
		
		if($filter_name != "")
		{
			$this->db->like('pdcReceiptNo', $filter_name); 
		}
		
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$ret['rows'] = $query->result_array();
		
		$this->db->select('tblPDC.*');
		$this->db->from('tblPDC');
		$this->db->where('pdcIsDelete',0);
		if($filter_name != "")
		{
			$this->db->like('pdcReceiptNo', $filter_name); 
		}
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get(); 
		
		$rows_count = $query->result_array();
		$ret['count'] =  sizeof($rows_count);
		
		return $ret;
		
	}
	
	function generateInvoice($quotationCode){
		
		$getQuotationRecord = getQuotationRecord($quotationCode);
		
		$getQuotationLineRecord = getQuotationLineRecord($quotationCode);
		
		$getCustomerBalance = getCustomerBalance($getQuotationRecord['quatCustomerId']);
		
		// Create Small PDF
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$pdf = new INVOICEPDF();
		
		$pdf->AliasNbPages();
		$pdf->AddPage('P','Legal');
		//$pdf->AddFont('Calibri','',FCPATH.'application/libraries/Fpdf/font/Calibri.php');
		//$pdf->AddFont('Calibri','B',FCPATH.'application/libraries/Fpdf/font/Calibrib.php');
		$pdf->AddFont('Calibri');
		$pdf->AddFont('Calibri','B');
		$pdf->SetFont('calibri','',12);
		
		$pdf->SetFillColor(224,235,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(135,189,55);
		$pdf->SetLineWidth(.3);
		$pdf->SetFont('','B',8);
		$pound =  chr(200);
		
		$tot_width = 35;
		$cw1 = 38;
		$line1 = 1;
		$ticketSubTotal = 0;
		$ticketTax = 0;
		$finaltotal = 0;
		// Header
		$pdf->Cell($cw1,10,'Sr. No.',1,0,'C',true);
		$pdf->Cell($cw1,10,'ProductName',1,0,'C',true);
		$pdf->Cell($cw1,10,'Quantity',1,0,'C',true);
		$pdf->Cell($cw1,10,'Unit Cost',1,0,'C',true);
		$pdf->Cell($cw1,10,'Amount',1,0,'C',true);
		
		$pdf->SetFillColor(224,235,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('','',8);
		
		$line=1;
		$finaltotal = 0;
		foreach($getQuotationLineRecord as $getQuotationLineRecord){
			
				$pdf->Ln();
				$pdf->Cell($cw1,10,$line1,1,0,'C',true);
				$pdf->Cell($cw1,10,getProductNameByProductId($getQuotationLineRecord['qlProductId']),1,0,'C',true);
				$pdf->Cell($cw1,10,$getQuotationLineRecord['qlQuantity'],1,0,'C',true);
				$pdf->Cell($cw1,10,$getQuotationLineRecord['qlUnitPrice'],1,0,'C',true);
				$pdf->Cell($cw1,10,number_format($getQuotationLineRecord['qlTotalPrice'],2,'.',''),1,0,'C',true);
				$line++;
				
				$finalTotal = $finalTotal + $getQuotationLineRecord['qlTotalPrice'];
		}
		
		
		
		$pdf->Ln(12);
		$pdf->SetX(130);
		$pdf->Cell($cw1,10,'Quotation Total: ',1,0,'C',true);
		$pdf->Cell($cw1,10,number_format($finalTotal,2,'.',''),1,0,'C',true);
		
		$pdf->Ln(12);
		$pdf->SetX(130);
		$pdf->Cell($cw1,10,'Discount: ',1,0,'C',true);
		$pdf->Cell($cw1,10,number_format($getQuotationRecord['quatDiscount'],2,'.',''),1,0,'C',true);
		
		/*For Total */
		$lastTotal = $finalTotal - $getQuotationRecord['quatDiscount'];
		
		$pdf->Ln(12);
		$pdf->SetX(130);
		$pdf->Cell($cw1,10,'Previous Balance: ',1,0,'C',true);
		$pdf->Cell($cw1,10,number_format($getCustomerBalance,2,'.',''),1,0,'C',true);
		
		
		$pdf->Ln(12);
		$pdf->SetX(130);
		$pdf->Cell($cw1,10,'Grand Total: ',1,0,'C',true);
		$pdf->Cell($cw1,10,number_format($lastTotal,2,'.',''),1,0,'C',true);
		
		$pdf->Ln(12);
		$pdf->SetX(130);
		$pdf->Cell($cw1,10,'Signature: ',1,0,'C',true);
		
		
		
		$dir = ABSPATH.'/external/invoicePDF/';
		
		$getCustomerName = getCustomerName($getQuotationRecord['quatCustomerId']);
		
		$customerName = preg_replace('/\s+/', '', $getCustomerName);
		
		$outputFileNamePDF = preg_replace("/[^a-zA-Z0-9]/", "", $customerName).'-'.date('dmY').'-'.date('His').".pdf";
		$pdf->Output($dir.$outputFileNamePDF,'F');
		
		$getLastInvoiceCode = getLastInvoiceCode();
		
		if($getLastInvoiceCode==0){
			$getLastInvoiceCode = 10001;
		}else{
			$getLastInvoiceCode = $getLastInvoiceCode + 1;
		}
		
		$dataInsertInvoice = array(
										'invCode' => $getLastInvoiceCode,
										'invCustomerId' => $getQuotationRecord['quatCustomerId'],
										'invInvoiceAmount' => $lastTotal,
										'invTotal' => $lastTotal,
										'invDownloadLink' => base_url().'external/invoicePDF/'.$outputFileNamePDF,
										'invDateCraeted' => date('Y-m-d H:i:s')
								  );
		
		$this->db->insert('tblInvoice',$dataInsertInvoice);
		
		$dataUpdateQuotation = array(
										'quatInvoiceCode' => $getLastInvoiceCode
									);
		
		$this->db->where('quatCode',$quotationCode);
		$this->db->update('tblQuatation',$dataUpdateQuotation);
		
		if($getCustomerBalance<0){
			
			if($lastTotal>abs($getCustomerBalance)){
				
				$finalCustomerBalance = $lastTotal - $getCustomerBalance;
				
				$dataUpdate = array(
										'cstBalance' => $finalCustomerBalance
									);
				
				$this->db->where('cstId',$getQuotationRecord['quatCustomerId']);
				$this->db->update('tblCustomerMaster',$dataUpdate);
				
			}if($lastTotal<abs($getCustomerBalance)){
				
				$finalCustomerBalance =  (abs($getCustomerBalance) - $lastTotal)*-1;
				
				$dataUpdate = array(
										'cstBalance' => $finalCustomerBalance
									);
				
				$this->db->where('cstId',$getQuotationRecord['quatCustomerId']);
				$this->db->update('tblCustomerMaster',$dataUpdate);
				
			}else{
				
				$finalCustomerBalance = abs($getCustomerBalance) - $lastTotal;
				
				$dataUpdate = array(
										'cstBalance' => $finalCustomerBalance
									);
				
				$this->db->where('cstId',$getQuotationRecord['quatCustomerId']);
				$this->db->update('tblCustomerMaster',$dataUpdate);
			}
			
			
		}else{
			
				$finalCustomerBalance = $lastTotal + $getCustomerBalance;
				
				$dataUpdate = array(
										'cstBalance' => $finalCustomerBalance
									);
				
				$this->db->where('cstId',$getQuotationRecord['quatCustomerId']);
				$this->db->update('tblCustomerMaster',$dataUpdate);
			
		}
		
		
	}
	
	
	function getQuotationDetail($id){
		
		$this->db->select('tblPDC.*');
		$this->db->from('tblPDC');
		$this->db->where('pdcId',$id);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	function updateQuotation(){
	
		if($this->input->post('cbilltype')=='cash'){
			$pdcDebited = 1;
		}else{
			$pdcDebited = 0;
		}
		
		$dataInsertQuotation = array(
										'pdcCustomerId' => $this->input->post('user_id'),
										'pdcReceiptNo' => $this->input->post('qno'),
										'pdcPaymentType' => $this->input->post('cbilltype'),
										'pdcChequeNumber' => $this->input->post('pchequenumber'),
										'pdcBankName' => $this->input->post('pbankname'),
										'pdcAmount' => $this->input->post('pamount'),
										'pdcDate' => date('Y-m-d',strtotime($this->input->post('pdate'))),
										'pdcIsDebited' => $pdcDebited,
										
									);
		
		$this->db->where('pdcId',$this->input->post('pdc_id'));
		$this->db->update('tblPDC',$dataInsertQuotation);	
	
	}
	
	function insertQuotation(){
		
		if($this->input->post('cbilltype')=='cash'){
			$pdcDebited = 1;
		}else{
			$pdcDebited = 0;
		}
		
		$dataInsertQuotation = array(
										'pdcCustomerId' => $this->input->post('user_id'),
										'pdcReceiptNo' => $this->input->post('qno'),
										'pdcPaymentType' => $this->input->post('cbilltype'),
										'pdcChequeNumber' => $this->input->post('pchequenumber'),
										'pdcBankName' => $this->input->post('pbankname'),
										'pdcAmount' => $this->input->post('pamount'),
										'pdcDate' => date('Y-m-d',strtotime($this->input->post('pdate'))),
										'pdcIsDebited' => $pdcDebited,
										'pdcDateCreated' => date('Y-m-d')
										
									);
		
		$this->db->insert('tblPDC',$dataInsertQuotation);
		
		
	}
}
?>