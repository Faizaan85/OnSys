<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function getAllProducts($filter_name, $sort, $order,$limit = '' , $start = ''){
		
		$order = ($order == 'desc') ? 'desc' : 'asc';
		$this->db->select('tblProduct.*');
		$this->db->from('tblProduct');
		$this->db->where('prdIsActive',1);
		if($start == 1)
		{
			$start = $start - 1;
		}
		$this->db->limit($limit,$start);
		
		if($filter_name != "")
		{
			$this->db->like('prdName', $filter_name); 
		}
		
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		$ret['rows'] = $query->result_array();
		
		$this->db->select('tblProduct.*');
		$this->db->from('tblProduct');
		$this->db->where('prdIsActive',1);
		if($filter_name != "")
		{
			$this->db->like('prdName', $filter_name); 
		}
		
		$this->db->order_by($sort,$order); 
		$query = $this->db->get(); 
		
		$rows_count = $query->result_array();
		$ret['count'] =  sizeof($rows_count);
		
		return $ret;
		
		
	}
	
	function updateProduct(){
		
		$dataInsert = array(
								'prdCode' => strtoupper($this->input->post('pcode')),
								'prdOEMCode' => strtoupper($this->input->post('poemcode')),
								'prdSupplierCode' => strtoupper($this->input->post('scode')),
								'prdName' => strtoupper($this->input->post('pname')),
								'prdDescription' => strtoupper($this->input->post('pdescription')),
								'prdSupplierId' => strtoupper($this->input->post('user_id')),
								'prdRemark' => strtoupper($this->input->post('premark')),
								'prdMeasure' => strtoupper($this->input->post('pmeasure')),
								'prdUnitMeasure' => strtoupper($this->input->post('pumeasure')),
								'prdQuantity' => strtoupper($this->input->post('pquantity')),
								'prdFromYear' => strtoupper($this->input->post('pfyear')),
								'prdToYear' => strtoupper($this->input->post('ptyear')),
								'prdMinLevel' => strtoupper($this->input->post('pmnlevel')),
								'prdMaxLevel' => strtoupper($this->input->post('pmxlevel')),
								'prdUnitCost' => strtoupper($this->input->post('pucost')),
								'prdSalesPrice' => strtoupper($this->input->post('pscost')),
								'prdIsActive' => 1,
								'prdIsDeadStock' => 0,
								'prdDateModified' => date('Y-m-d')
						   );
		
		$this->db->where('prdId',$this->input->post('product_id'));
		$this->db->update('tblProduct',$dataInsert);
		
	}
	
	public function getProductDetail($adminId){
		$this->db->select('tblProduct.*');
		$this->db->from('tblProduct');
		$this->db->where('tblProduct.prdId',$adminId);
		$fetchStatus=$this->db->get();
		if($fetchStatus->num_rows()>0){
		
			return $fetchStatus->row_array();
			
		}else{
			
			return 0;
			
		}
	}
	
	function insertProduct(){
		
		$dataInsert = array(
								'prdCode' => strtoupper($this->input->post('pcode')),
								'prdOEMCode' => strtoupper($this->input->post('poemcode')),
								'prdSupplierCode' => strtoupper($this->input->post('scode')),
								'prdName' => strtoupper($this->input->post('pname')),
								'prdDescription' => strtoupper($this->input->post('pdescription')),
								'prdSupplierId' => strtoupper($this->input->post('user_id')),
								'prdRemark' => strtoupper($this->input->post('premark')),
								'prdMeasure' => strtoupper($this->input->post('pmeasure')),
								'prdUnitMeasure' => strtoupper($this->input->post('pumeasure')),
								'prdQuantity' => strtoupper($this->input->post('pquantity')),
								'prdFromYear' => strtoupper($this->input->post('pfyear')),
								'prdToYear' => strtoupper($this->input->post('ptyear')),
								'prdMinLevel' => strtoupper($this->input->post('pmnlevel')),
								'prdMaxLevel' => strtoupper($this->input->post('pmxlevel')),
								'prdUnitCost' => strtoupper($this->input->post('pucost')),
								'prdSalesPrice' => strtoupper($this->input->post('pscost')),
								'prdIsActive' => 1,
								'prdIsDeadStock' => 0,
								'prdDateCreated' => date('Y-m-d')
						   );
		
		$this->db->insert('tblProduct',$dataInsert);
		
	}
    
    function fetchCustomerActiveId($pk_i_id)
	{
		$this->db->select('tblProduct.prdIsActive');
		$this->db->from('tblProduct');
		$this->db->where('tblProduct.prdId',$pk_i_id);
		$fetchStatus=$this->db->get();
		return $fetchStatus->row();
	}
	function activeCustomerChange($id,$active)
	{
		if($active==1)
		{
			$active=0;
			$data = array(
							'prdIsActive' => $active
						  );
			$this->db->where('tblProduct.prdId',$id);
			$this->db->update('tblProduct',$data);
		}
		else
		{
			$active=1;
			$data = array(
							'prdIsActive' => $active
						  );
			$this->db->where('tblProduct.prdId',$id);
			$this->db->update('tblProduct',$data);
		}
	}
	
	function getUserWithAgCodeForSelect2($search = "", $id = 0)
	{
		$this->db->select('tblSupplierMaster.supId as id ,tblSupplierMaster.supCompanyName as code');
		$this->db->from('tblSupplierMaster');
		$this->db->where('tblSupplierMaster.supIsActive', '1');
		$this->db->where('tblSupplierMaster.supIsDelete', '0');
		if($search != "")
		{
			$this->db->like('tblSupplierMaster.supCompanyName', $search); 
		}
		
		if($id <> 0)
		{
			$this->db->where('tblSupplierMaster.supId', $id);
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
	
	public function checkProductCode($code){
		
		$this->db->select('tblProduct.*');
		$this->db->from('tblProduct');
		$this->db->where('tblProduct.prdCode',$code);
		$fetchStatus=$this->db->get();
		return $fetchStatus->num_rows();
		
	}
}
?>