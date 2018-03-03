<?php
require(APPPATH.'libraries/fpdf/fpdf.php');
class PDF extends FPDF
{
	// Page header
	var $oinfo;
	var $pdf_type;
	var $tAmount=0.00;
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
		$this->Cell(170,30,"",0,1); //black space for logo or something
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
class Orders extends CI_Controller
{
	public function index()
	{
		// Loads up order list
		// $this->load->model('order_model');
		// $data['orders'] = $this->order_model->get_orders();
		$data['title'] = ucfirst("orders");
		$data['jslist']=array('custom_functions.js','orderslist.js');
		// $data['autorefresh']=TRUE;
		// $data['baseurl']=base_url();
		$this->load->view('templates/header', $data);
		$this->load->view('pages/orderslist');
		$this->load->view('templates/footer');
	}
	public function get()
	{
		$this->load->model('order_model');
		//Lets check for parameters. fun!!
		$data['days'] = $this->input->get('days');
		$data['oId'] = $this->input->get('oid');
		$result = $this->order_model->api_get_orders($data);
		if($this->checkDbError($result))
		{
			header('HTTP/1.1 500 Get Failed');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('message' => $result['message'], 'code' => $result['code'])));
		}
		else {
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	public function get_orderlist()
	{

		$this->load->model('order_model');
		$data['orders'] = $this->order_model->get_orders();
		echo json_encode($data['orders']);

	}

	public function get_order_details($omid,$print = "FALSE")
	{

		$this->load->model('order_model');
		$data['orderinfo'] = $this->order_model->get_orders($omid);
		$data['items'] = $this->order_model->get_order($omid);
		$data['title'] = ($print == "FALSE")? ucfirst("order Details") : ucfirst("Order Print");
		$jslist =array(($print == "FALSE")? "order_details.js" : "order_print.js");
		$data['jslist'] = $jslist;
		$data['autorefresh']=FALSE;

		$this->load->view('templates/header', $data);
		if($print == "FALSE")
		{
			$this->load->view('pages/order');
		}
		else
		{
			$this->load->view('pages/order_print');
		}
		$this->load->view('templates/footer');
	}
	public function create_new_order()
	{
		$this->load->model('client_model');
		$data['clients'] = $this->client_model->get_clients();
		$data['title'] = ucfirst("new Order");
		$data['mode'] = 'New';

		$jslist = array("custom_functions.js","neworder.js");
		$data['jslist'] = $jslist;
		//$data['clients'] =
		$data['autorefresh']=FALSE;
		$this->load->view('templates/header',$data);
		$this->load->view('pages/v_new_sales_order');
		$this->load->view('templates/footer');
	}
	public function save_order()
	{
		// Load models.
		$this->load->model('order_model');
		$this->load->model('user_model');
		// save post username to variable
		$usrname = $this->input->post('username');
		// get the userid from username
		$usrid = $this->user_model->get_userid($usrname);
		// if username not found. (only case to heppen: someone messed with the data)
		// if($usrid == false)
		// {
		// 	die(header("HTTP/1.0 404 Not Found"));
		// }
		// else send userid to post order and get result.
		$result = $this->order_model->post_order($usrid['UsrId']);
		// if($result)
		// {
		// 	header('HTTP/1.1 404 Item Not Found');
  //       	header('Content-Type: application/json; charset=UTF-8');
  //       	die(json_encode(array('message' => 'ERROR', 'code' => 404)));
		// }
		echo json_encode($result);
	}
	// Edit order
	// /Edit order

	// Delete order
	public function delete_order()
	{
		$usrLvl = $this->input->post('usrlvl');
		if($usrLvl<7)
		{
			header('HTTP/1.1 466 Unauthorized User');
			header('Content-Type: application/json; charset=UTF-8');
			die(json_encode(array('message' => 'ERROR', 'code' => 466)));
		}
		$this->load->model('order_model');
		$result = $this->order_model->delete_order();
		echo json_encode($result);
	}
	// /Delete Order
	public function print_order($orderNumber=0)
	{
		$this->load->model('order_model');
		$oinfo= $this->order_model->get_orders($orderNumber);
		$items= $this->order_model->get_order($orderNumber);
		// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])


		$pdf = new PDF();
		$pdf->setRows($oinfo);
		$pdf->AddPage();
		$pdf->FancyTable($items);
		//$pdf->Output();
		$pdf->Output('F','e:/Documents/Carryon/OnSysOrders/I-'.$orderNumber.'.pdf');
		// echo ('Order saved :'.$orderNumber);

	}

	public function order_item_state()
	{
		$this->load->model('order_model');
		$date = new DateTime();
		$state=array(
			'OiId' => $this->input->post('oiid'),
			'OiOmId' => $this->input->post('oiomid'),
			'OiModifiedOn' => $date->getTimestamp(),
			'OiStatus' => $this->input->post('status')
		);
		// Check if invoice made. already.
		$chkInv = $this->order_model->check_invoice_exists('InOmId', $state['OiOmId']);
		if(array_key_exists('InOmId', $chkInv) && $state['OiStatus'] == 0)
		{
			// Means the invoice is already made.
			header('HTTP/1.1 500 Invoice Already Made.');
        	header('Content-Type: application/json; charset=UTF-8');
        	print(json_encode(array('message' => 'Invoice already exists.', 'code' => 500, 'invoice' => $chkInv['InId'])));
        	die();
		}
		elseif($this->input->post('oitotalqty') != NULL)
		{
			// Create additional Array
			$state_addition = array(
				'OiLeftQty' => $this->input->post('oileftqty'),
				'OiRightQty' => $this->input->post('oirightqty'),
				'OiTotalQty' => $this->input->post('oitotalqty')
			);
			// Merge it with Existing $state array
			$state = array_merge($state,$state_addition);
		}
		$result = $this->order_model->order_item_state($state);
		echo json_encode($state);
	}
	public function set_store_state()
	{
		$this->load->model('order_model');
		$result = $this->order_model->set_store_state();
		echo json_encode($result);
	}
	public function set_print_state()
	{
		$this->load->model('order_model');
		$orderid = $this->input->post('orderid');
		$result = $this->order_model->set_print_state($orderid);
		// print_order($orderid);
		//$this->print_order($orderid);
		echo json_encode($result);
	}
	//BETA version of CRUD system. version 2.0 if you will.
	private function validate_user($user_lvl, $allowed_lvl)
	{
		//return true if allowed_lvl >= $user_lvl
		if($user_lvl >= $allowed_lvl)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function crud_sales_order($state, $order_id="")
	{
		// 1.check what the state is.
		// 2.after that check if user lvl is allowed to execute state.
		// 3.check if its a valid order id and that its not being edited by someone else.
		echo $state;
		$user_lvl = $this->session->level;
		if($state == "New") {
			if($this->validate_user($user_lvl, 3) == TRUE) {
				//do the new order things.
				$this->load->model('client_model');
				$data['clients'] = $this->client_model->get_clients();
				$data['title'] = ucfirst("New Order");
				$data['mode'] = $state; //this will be "New"
				$data['jslist'] = array('custom_functions.js','neworder.js');
				//$data['clients'] =
				$data['autorefresh']=FALSE;
				$this->load->view('templates/header',$data);
				$this->load->view('pages/v_new_sales_order');
				$this->load->view('templates/footer');
			}
		}
		elseif ($state == "Edit") {
			//load only for level 7 user or higher
			echo $order_id;
			if ($this->validate_user($user_lvl,3) == TRUE) {
				//load order_model
				$this->load->model('order_model');
				$data['orderinfo'] = $this->order_model->get_orders($order_id);
				$data['items'] = $this->order_model->get_order($order_id);
				$data['title'] = "Order Edit";
				$data['mode'] = $state;
				$jslist =array('custom_functions.js','editorder.js');
				$data['jslist'] = $jslist;
				$data['autorefresh']=FALSE;
				echo $order_id;
				$this->load->view('templates/header', $data);
				$this->load->view('pages/v_new_sales_order');
				$this->load->view('templates/footer');
			}

		}
		elseif ($state == "Delete") {
			# code...

		}
		else {
			# code...
			// show 404 error.
		}
	}
	public function new_cash_sale()
	{
		$data['title'] = 'Cash Sale';
		$jslist = array("vue.js","vue-resource.js","vuetify.js","vues/v_new_cash_sale.js");
		$data['jslist'] = $jslist;
		$data['autorefresh'] = FALSE;

		$this->load->view('templates/header', $data);
		$this->load->view('orders/v_sales_order.php');
		$this->load->view('templates/footer');
	}
	public function make_invoice()
	{

		//first i need to get the order_id and do the invoice making process,
		$this->load->model('order_model');
		//then actually make/create invoice from order_id and return Invoice number
		$order_id = $this->input->post('order_id');
		$invNo = $this->order_model->make_invoice();
		$oinfo= $this->order_model->get_invoices($invNo);
		$items= $this->order_model->get_invoice_items($invNo);

		$pdf = new PDF('P','mm',array(230,280));
		$pdf->setLeftMargin(30);
		$pdf->setRows($oinfo);
		$pdf->AddPage();
		$pdf->InvoiceTable($items);
		$pdf->Output('F','e:/Documents/Carryon/OnSysOrders/I-'.$invNo.'.pdf');	// return ($invNo);
		echo json_encode($invNo);
		// return $this->crud_sales_order("Edit", $order_id);
		// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
		// $pdf = new PDF('P','mm','A4');
		// $pdf->setRows($oinfo);
		// $pdf->AddPage();
		// $pdf->SetFont('Arial','B',16);
		// $pdf->Cell(40,10,'Hello World!');
		// //$pdf->FancyTable($items);
		// //$pdf->Output();
		// $pdf->Output();
	}
	public function print_invoice($inv_id=0)
	{
		$this->load->model('order_model');
		$oinfo= $this->order_model->get_invoices($inv_id);
		$items= $this->order_model->get_invoice_items($inv_id);
		// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

		$location = $_SERVER['DOCUMENT_ROOT'].'/OnSys/Invoices/I-';
		$pdf = new PDF('P','mm',array(230,280));
		$pdf->setLeftMargin(30);
		$pdf->setRows($oinfo);
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(true, 50.00);
		$pdf->InvoiceTable($items);
		date_default_timezone_set("Asia/Muscat");
		$pdf->Output('F',$location.$inv_id.'-'.date("Ymd-his").'.pdf',true);
		$pdf->Output('I','Invoice-'.$inv_id.'.pdf',true);

		// echo ('Order saved :'.$orderNumber);

	}
	public function view_order($order_id=0)
	{
		//Here I will have to go order, invoice, crnotes
		$this->load->model('order_model');
		$this->load->model('return_model');
		$orderinfo = $this->order_model->get_orders($order_id);
		if($this->checkDbError($orderinfo))
		{
			if($orderinfo['code']==0)
			{
				show_error("Order Not Found", 404, "No Order");
				die();
			}
			else
			{
				show_error($orderinfo['message'], 404, $orderinfo['code']);
				die();
			}
		}
		else
		{
			$orderitems = $this->order_model->get_order($order_id);
		}
		//now lets get invoice
		$invoice_id = $orderinfo['InId'];
		if($invoice_id!='')
		{
			$invinfo = $this->order_model->get_invoices($invoice_id);
			$invitems = $this->order_model->get_invoice_items($invoice_id);
			$cr_notes = $this->return_model->find_credit_notes($invoice_id);
			if($this->checkDbError($cr_notes)==false)
			{
				$cr_notes_items;
				foreach($cr_notes as $key => $value)
				{

					$cr_num = $value['cnmId'];
					$cr_notes_items[$cr_num] = $this->return_model->get_credit_note_items($cr_num);
				}
				$data['cr_notes'] = $cr_notes;
				$data['cr_notes_items'] = $cr_notes_items;
			}
			$data['invinfo'] = $invinfo;
			$data['invitems'] = $invitems;
		}
		$data['orderinfo'] = $orderinfo;
		$data['orderitems'] = $orderitems;

		$data['title'] = "Order View";
		$jslist = array("custom_functions.js","v_o_i_cns.js");
		$data['jslist'] = $jslist;
		$data['autorefresh'] = FALSE;


		$this->load->view('templates/header',$data);
		$this->load->view('pages/v_o_i_cns.php');
		$this->load->view('templates/footer');
	}
	public function view_invoice($invoice_id=0)
	{
		//Because I already have Invoice id, I can jump to step 2.
		// Second, we need to get the invoice itself
		$this->load->model('order_model');
		$this->load->model('return_model');
		$data['invinfo'] = $this->order_model->get_invoices($invoice_id);
		if($this->checkDbError($data['invinfo']))
		{
			if($data['invinfo']['code']==0)
			{
				show_error("Invoice Not Found",404,"No Invoice.");
			}
			else
			{
				show_error($data['invinfo']['message'], 404, $data['invinfo']['code']);
				die();
			}

		}

		// And, invoice items
		$data['invitems'] = $this->order_model->get_invoice_items($invoice_id);
		// Third, we need to get the Order
		$order_id = $data['invinfo']['InOmId'];
		$data['orderinfo'] = $this->order_model->get_orders($order_id);
		// And, order items
		$data['orderitems'] = $this->order_model->get_order($order_id);
		// Fourth, Now the tough part. Need list of credit notes
		$cr_notes = $this->return_model->find_credit_notes($invoice_id);

		if(array_key_exists('code',$cr_notes))
		{
			//means there was an error of some kind
			//ignore with creditnotes and its items.

		}
		else
		{
			$cr_notes_items;

			foreach($cr_notes as $key => $value)
			{

				$cr_num = $value['cnmId'];
				$cr_notes_items[$cr_num] = $this->return_model->get_credit_note_items($cr_num);
			}
			$data['cr_notes'] = $cr_notes;
			$data['cr_notes_items'] = $cr_notes_items;
		}

		//  $data['invinfo'] = $this->order_model;
		// $data['cninfo'] = $this->return_model->get_credit_notes($cn_id);
		// $data['items'] = $this->return_model->get_credit_note_items($cn_id);
		$data['title'] = "Invoice View";
		$jslist = array("custom_functions.js","v_o_i_cns.js");
		$data['jslist'] = $jslist;
		$data['autorefresh'] = FALSE;


		$this->load->view('templates/header',$data);
		$this->load->view('pages/v_o_i_cns.php');
		$this->load->view('templates/footer');
	}
	private function checkDbError($Ar)
	{
		if(array_key_exists('code',$Ar))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
