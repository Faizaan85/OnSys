<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/fpdf/fpdf.php');
class CNPDF extends FPDF
{
  var $cninfo;

  function setRows($data)
  {
    $this->cninfo = $data;
  }
  function Header()
  {
    $this->SetFillColor(217,217,217);
    $fill=true;
      //row 1

    $this->SetFont('Arial','',10);
    $this->Cell(170,30,"",0,1); //black space for logo or something
    $this->Cell(170,5,"VAT Number: 100019982600003",0,1,'R');
    $this->SetFont('Arial','BU',16);
    $this->Cell(170,5,"Credit Note",0,1,'C');

    $this->SetFont('Arial','',9);
    //row2
    $this->Cell(80,5,'Customer Details',1,0,'L',$fill);
    $this->Cell(45,5,'Credit Note #',1,0,'C',$fill);
    $this->Cell(45,5,'Date',1,1,'C',$fill);

    //row3
    $this->Cell(15,5,'Name',1,0,'L',$fill);
    $this->Cell(65,5,$this->cninfo['InOmCompanyName'],1,0,'C');
    $this->Cell(45,5,$this->cninfo['cnmId'],1,0,'C');
    $this->Cell(45,5,date('d-m-Y h:i a', strtotime($this->cninfo['CnmCreatedOn'])),1,1,'C');

    //row4
    $this->Cell(15,5,'Address',1,0,'L',$fill);
    $this->Cell(65,5,$this->cninfo['InOmAdd'],1,0,'C');
    $this->Cell(45,5,'Customer ID',1,0,'C',$fill);
    $this->Cell(45,5,'Invoice #',1,1,'C',$fill);

    //row5
    $this->Cell(15,5,'Phone',1,0,'L',$fill);
    $this->Cell(65,5,$this->cninfo['InOmTel1'],1,0,'C');
    $this->Cell(45,5,$this->cninfo['CnmCompanyCode'],1,0,'C');
    // $this->Cell(40,5,date('d-m-Y', strtotime($this->cninfo['inDueDate'])),1,1,'C');
    $this->Cell(45,5,$this->cninfo['cnmInId'],1,1,'C');

    //row6
    $this->Cell(15,5,'Phone 2',1,0,'L',$fill);
    $this->Cell(65,5,$this->cninfo['InOmTel2'],1,0,'C');
    $this->Cell(90,5,'VAT Registration #',1,1,'C',$fill);

    //row7
    $this->Cell(25,5,'LPO No:',1,0,'L',$fill);
    $this->Cell(65,5,$this->cninfo['CnmLpo'],1,0,'C');
    $this->Cell(80,5,$this->cninfo['ClVatNo'],1,1,'C');

    //row8 table column header

    $this->cell(10,5,'No.',1,0,'C'); //sr no
    $this->cell(30,5,'Part No',1,0,'C'); //part no
    $this->cell(55,5,'Description',1,0,'C'); //description
    $this->cell(15,5,'Left Qty',1,0,'C'); //left qty
    $this->cell(15,5,'Right Qty',1,0,'C'); //right qty
    $this->cell(15,5,'Total Qty',1,0,'C'); //total qty
    $this->cell(15,5,'Price',1,0,'C'); //price
    $this->cell(15,5,'Amount',1,1,'C'); //
  }
  function CreditNoteTable($rows)
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
      $amount = number_format(($row['CniPrice'] * $row['CniTotalQty']), 2, '.', '');
          $this->Cell($headerwidth[0],6,$rc,1,0,'L',$fill);
          // $this->Cell($headerwidth[1],6,$row['IiOiPartNo'],1,0,'L',$fill);
      $this->SetFontSize(8);
      $this->Cell($headerwidth[1],6,$row['CniSupplierNo'],1,0,'L',$fill);
      $this->Cell($headerwidth[2],6,$row['CniDescription'],1,0,'L',$fill);
      $this->SetFontSize(10);
      $this->Cell($headerwidth[3],6,$row['CniLeftQty'],1,0,'C',$fill);
      $this->Cell($headerwidth[4],6,$row['CniRightQty'],1,0,'C',$fill);
      $this->Cell($headerwidth[5],6,$row['CniTotalQty'],1,0,'C',$fill);
      $this->Cell($headerwidth[6],6,$row['CniPrice'],1,0,'R',$fill);
      $this->Cell($headerwidth[7],6,$amount,1,0,'R',$fill);
      $this->SetFontSize(10);
      $this->Ln();
      $totalAmount += $amount; //$amount is amount for each item. added on to totalAmount for sum.
          $fill = !$fill;
      $rc += 1;
      }
  }
  function Footer()
  {
    //Go to 5 cm from the bottom
    $this->SetY(-50);
    //Set font
    $this->SetFont('Arial','',10);
    $this->SetFillColor(217,217,217);
    $fill = true;

    $this->Cell(95);
    $this->Cell(45,6,"Total Amount (AED): ",1,0,'R',$fill);
    $this->Cell(30,6,$this->cninfo['CnmAmount'],1,0,'R',$fill);
    $this->Ln();
    $this->Cell(95);
    $this->Cell(45,6,"- Discount (AED): ",1,0,'R');
    $this->Cell(30,6,$this->cninfo['CnmDiscount'],1,0,'R');
    $this->Ln();
    $this->Cell(95);
    $this->Cell(45,6,"VAT ".$this->cninfo['CnmVatPercent']."% (AED): ",1,0,'R',$fill);
    $this->Cell(30,6,$this->cninfo['CnmVatAmount'],1,0,'R',$fill);
    $this->Ln();
    $this->Cell(95);
    $this->Cell(45,6,"Net Total (AED): ",1,0,'R');
    $this->Cell(30,6,$this->cninfo['CnmNetAmount'],1,0,'R');
    $this->Ln();
  }
}

class Returns extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data['title'] = "Returns";
    $data['jslist'] = array('returnslist.js');
    $this->load->view('templates/header', $data);
    $this->load->view('pages/returnslist');
    $this->load->view('templates/footer');

  }
  public function new_credit_note()
  {
	  $data['title'] = "Sales Return";
	  $data['jslist'] = array('custom_functions.js', 'credit_note.js');
      $data['mode'] = 'New';
	  $this->load->view('templates/header',$data);
	  $this->load->view('pages/v_new_credit_note');
	  $this->load->view('templates/footer');
  }
  public function get_credit_notes()
  {
    $inv_id=$this->input->get('inv_id');
    $this->load->model('order_model');
    $result = $this->order_model->get_invoices($inv_id);
    $result_inv_id = $result['InId'];

    $this->load->model('return_model');
    $result_credit_note;

  }
  public function get_creditnotes_json()
  {
    $this->load->model('return_model');
    $result = $this->return_model->get_credit_notes("ALL");
    echo json_encode($result);
  }
  public function get_invoice()
  {
    $inv_id = $this->input->get('inv_id');
    if($inv_id==""){
      die(json_encode(array('message' => 'ERROR'.$inv_id, 'code' => 4404)));
    }
    $this->load->model('order_model');
    $inv_details = $this->order_model->get_invoices($inv_id);
    $inv_items =  $this->order_model->get_invoice_items($inv_id);
    $return_array = array('im'=>$inv_details, 'ii'=>$inv_items);
    // die(json_encode(array('message'=>$result,'code'=>200)));
    echo json_encode($return_array);
  }
  public function post_credit_note()
  {
    $this->load->model('return_model');
    $this->load->model('user_model');
    // save post username to variable
    $usrname = $this->session->username;
    // get the userid from username
    $usrid = $this->user_model->get_userid($usrname);
    $result = $this->return_model->post_credit_note($usrid['UsrId']);
    echo $result;
  }
  public function print_credit_note()
  {
    $this->load->model('return_model');
    $cnNo = $this->input->get('cn_id');
    $cninfo = $this->return_model->get_credit_notes($cnNo);
    $cnitems = $this->return_model->get_credit_note_items($cnNo);
    $location = $_SERVER['DOCUMENT_ROOT'].'/OnSys/CreditNotes/CN-';
    $pdf = new CNPDF('P','mm',array(230,280));
    $pdf->setLeftMargin(30);
    $pdf->setRows($cninfo);
    $pdf->AddPage();
    $pdf->CreditNoteTable($cnitems);
    date_default_timezone_set("Asia/Muscat");
    $pdf->Output('F',$location.$cnNo.'-'.date("Ymd-his").'.pdf',true);
    $pdf->Output('D','CN-'.$cnNo.'.pdf',true);
  }
	public function view_credit_note($cn_id=0)
  	{
		$this->load->model('return_model');
		// First, we need to get the invoice number of the credit note.
		$invoice_id = $this->return_model->get_invoiceid($cn_id);
		if(!array_key_exists('cnmInId',$invoice_id))
		{
			echo("ErrorDocument 404");
			die;
		}
		$invoice_id = $invoice_id['cnmInId'];
		// Second, we need to get the invoice itself
		$this->load->model('order_model');
		$data['invinfo'] = $this->order_model->get_invoices($invoice_id);
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
		$data['title'] = "Credit Note View";
		$jslist = array("custom_functions.js","v_o_i_cns.js");
		$data['jslist'] = $jslist;
		$data['autorefresh'] = FALSE;

		$this->load->view('templates/header',$data);
		$this->load->view('pages/v_o_i_cns.php');
		$this->load->view('templates/footer');
  }
}
