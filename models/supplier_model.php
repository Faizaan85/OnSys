<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    public function getAllCustomers($filter_name, $sort, $order,$limit = '' , $start = ''){
		
		$order = ($order == 'desc') ? 'desc' : 'asc';
		$this->db->select('tblSupplierMaster.*');
		$this->db->from('tblSupplierMaster');
		$this->db->where('supIsActive',1);
		$this->db->where('supIsDelete',0);
		if($start == 1)
		{
			$start = $start - 1;
		}
		$this->db->limit($limit,$start);
		
		if($filter_name != "")
		{
			$this->db->like('supCompanyName', $filter_name);
			$this->db->or_like('supCode', $filter_name); 
		}
		
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$ret['rows'] = $query->result_array();
		
		$this->db->select('tblSupplierMaster.*');
		$this->db->from('tblSupplierMaster');
		$this->db->where('supIsActive',1);
		$this->db->where('supIsDelete',0);
		if($filter_name != "")
		{
			$this->db->like('supCompanyName', $filter_name);
			$this->db->or_like('supCode', $filter_name); 
		}
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get(); 
		
		$rows_count = $query->result_array();
		$ret['count'] =  sizeof($rows_count);
		
		return $ret;
		
		
	}
	
	function updateSupplier(){
		
		$dataInsert = array(
								
								'supCompanyName' => strtoupper($this->input->post('cname')),
								'supAddress' => strtoupper($this->input->post('caddress')),
								'supContactPerson' => strtoupper($this->input->post('cperson')),
								'supPhoneNumber1' => strtoupper($this->input->post('cphone')),
								'supPhoneNumber2' => strtoupper($this->input->post('cphone1')),
								'supMobileNumber1' => strtoupper($this->input->post('cmobile')),
								'supMobileNumber2' => strtoupper($this->input->post('cmobile1')),
								'supFaxNumber' => strtoupper($this->input->post('cfax')),
								'supBillType' => strtoupper($this->input->post('cbilltype')),
								'supIsActive' => strtoupper($this->input->post('cstatus')),
								'supDateModified' => date('Y-m-d')
						   );
		
		$this->db->where('supId',$this->input->post('supplier_id'));
		$this->db->update('tblSupplierMaster',$dataInsert);
		
	}
	
	public function getCustomerDetail($adminId){
		$this->db->select('tblSupplierMaster.*');
		$this->db->from('tblSupplierMaster');
		$this->db->where('tblSupplierMaster.supId',$adminId);
		$fetchStatus=$this->db->get();
		if($fetchStatus->num_rows()>0){
		
			return $fetchStatus->row_array();
			
		}else{
			
			return 0;
			
		}
	}
	
	function insertSupplier(){
		
		if($this->input->post('cbalance')!=''){
			$balance = $this->input->post('cbalance');
		}else{
			$balance = 0;
		}
		
		$dataInsert = array(
								'supCode' => strtoupper($this->input->post('ccode')),
								'supCompanyName' => strtoupper($this->input->post('cname')),
								'supEmailId' => strtoupper($this->input->post('cemail')),
								'supAddress' => strtoupper($this->input->post('caddress')),
								'supContactPerson' => strtoupper($this->input->post('cperson')),
								'supPhoneNumber1' => strtoupper($this->input->post('cphone')),
								'supPhoneNumber2' => strtoupper($this->input->post('cphone1')),
								'supMobileNumber1' => strtoupper($this->input->post('cmobile')),
								'supMobileNumber2' => strtoupper($this->input->post('cmobile1')),
								'supFaxNumber' => strtoupper($this->input->post('cfax')),
								'supBillType' => strtoupper($this->input->post('cbilltype')),
								'supCreditLimit' => strtoupper($this->input->post('climit')),
								'supCreditAvailable' => strtoupper($this->input->post('climit')),
								'supBalance' => $balance,
								'supIsActive' => strtoupper($this->input->post('cstatus')),
								'supDateCreated' => date('Y-m-d')
						   );
		
		$this->db->insert('tblSupplierMaster',$dataInsert);
		
	}
	
	public function checkEmailExist($email){
		$this->db->select('tblSupplierMaster.*');
		$this->db->from('tblSupplierMaster');
		$this->db->where('tblSupplierMaster.supEmailId',$email);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
	}
	
	public function checkCustomerCode($code){
		
		$this->db->select('tblSupplierMaster.*');
		$this->db->from('tblSupplierMaster');
		$this->db->where('tblSupplierMaster.supCode',$code);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
		
	}
    
    function fetchCustomerActiveId($pk_i_id)
	{
		$this->db->select('tblSupplierMaster.supIsActive');
		$this->db->from('tblSupplierMaster');
		$this->db->where('tblSupplierMaster.supId',$pk_i_id);
		$fetchStatus=$this->db->get();
		return $fetchStatus->row();
	}
	function activeCustomerChange($id,$active)
	{
		if($active==1)
		{
			$active=0;
			$data = array(
							'supIsActive' => $active
						  );
			$this->db->where('tblSupplierMaster.supId',$id);
			$this->db->update('tblSupplierMaster',$data);
		}
		else
		{
			$active=1;
			$data = array(
							'cstIsActive' => $active
						  );
			$this->db->where('tblSupplierMaster.supId',$id);
			$this->db->update('tblSupplierMaster',$data);
		}
	}
}
?>