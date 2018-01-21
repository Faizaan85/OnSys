<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Return_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}
	public function get_credit_notes($cond = "ALL")
	{
		if($cond =="ALL")
		{
			$this->db->select('cnmId, cnmInId, InOmCompanyName, CnmLpo, CnmNetAmount, CnmCreatedOn');
			$query = $this->db->order_by('cnmId','DESC')->get('creditnotemaster_user_client');
			return $query->result_array();
		}
		else
		{
			$query = $this->db->get_where('creditnotemaster_user_client',array('cnmId'=>$cond));
			$result = $query->row_array();
			if(isset($result))
			{
				return $result;
			}
			else
			{
				return $this->db->error();
			}

		}

	}
	public function get_credit_note_items($cnmid)
	{
		$query = $this->db->get_where('creditnoteitems',array('CnmId'=>$cnmid));
		return $query->result_array();


	}
	public function post_credit_note($userid)
	{
		$cn_master = array(
			'cnmInId' => $this->input->post('inv_id'),
			'CnmCompanyCode' => $this->input->post('company_code'),
			'CnmLpo' => $this->input->post('lpo'),
			'CnmAmount' => $this->input->post('cn_amount'),
			'CnmDiscount' => $this->input->post('cn_discount'),
			'CnmVatPercent' => $this->input->post('cn_vat_percent'),
			'CnmVatAmount' => $this->input->post('cn_vat_amount'),
			'CnmNetAmount' => $this->input->post('cn_net_amount'),
			'CnmCreatedBy' => $userid
		);
		// Object array for creditnoteitems
		$items_post = $this->input->post('items');

		//saving process begins
		$this->db->trans_begin();
		$this->db->insert('creditnotemaster',$cn_master);
		$insert_id = $this->db->insert_id();
		//$file = "./datas.txt";
		//file_put_contents($file,$items_post,FILE_APPEND);
		for($i=0;$i<count($items_post);$i++)
		{
			$insertdata = array(
				'CnmId' => $insert_id,
				'IiId' => $items_post[$i][0],
				'CniPartNo' => $items_post[$i][1],
				'CniSupplierNo' => $items_post[$i][2],
				'CniDescription' => $items_post[$i][3],
				'CniLeftQty' => $items_post[$i][4],
				'CniRightQty' => $items_post[$i][5],
				'CniTotalQty' => $items_post[$i][6],
				'CniPrice' => $items_post[$i][7],
				'CniAmount' => ($items_post[$i][6]*$items_post[$i][7]),
				'CniReason' => ""
			);
			$this->db->insert('creditnoteitems',$insertdata);
		}
		if($this->db->trans_status() === FALSE)
		{
			$errormsg = $this->db->_error_message();
			$this->db->trans_rollback();
			return $errormsg;
		}
		else
		{
			$this->db->trans_commit();
			return $insert_id;
		}
		// return $insert_id;
	}
	public function get_invoiceid($cn_id)
	{
		$this->db->select('cnmInId');
		$query = $this->db->get_where('creditnotemaster_user_client',array('cnmId'=>$cn_id));
		$result = $query->row_array();//this will return first row. Doesnt matter cause all rows will have same info.
		if(isset($result))
		{
			return $result;
		}
		else{
			return $this->db->error();
		}
	}
	public function find_credit_notes($inv_id)
	{
		// function to find and return array of credit notes.
		// there can be more than 1 credit note for 1 invoice. 
		$this->db->select('cnmId');
		$query = $this->db->get_where('creditnotemaster_user_client',array('cnmInId'=>$inv_id));
		$result= $query->result_array();//this will return arry with 1 column. multiple rows possible.
		if(isset($result))
		{
			return $result;
		}
		else
		{
			return $this->db->error();
		}
		
		
	}

}

/* End of file Return_model.php */
/* Location: ./application/models/Return_model.php */
