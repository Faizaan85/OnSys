<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
  
    public function __construct()
    {
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model("supplier_model");     
    }
    
    public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			redirect('supplier/manageSupplier');
		}
		else{
			redirect('admin');
		}
	}
	
	public function checkEmailExist($cemail){
		
		$checkCodeExist = $this->supplier_model->checkEmailExist($cemail);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkEmailExist', 'Please Enter Unique EmailId');
			return false;
		}else{
			return true;
		}
	}
	
	public function checkCustomerCode($ccode){
		
		$checkCodeExist = $this->supplier_model->checkCustomerCode($ccode);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkCustomerCode', 'Please Enter Unique Code');
			return false;
		}else{
			return true;
		}
		
	}
    
    public function addSupplier(){
        
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblSupplierMaster.supId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['customer_id'])) {
			$id = $this->request->get['customer_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['supplier_id'])) {
			$url .= '&supplier_id=' .$this->request->get['supplier_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
        
		$data['url'] = $url;
		$data['page'] = $page;
		$data['supplier_id'] = $id;
		
		$this->form_validation->set_rules('ccode','Supplier Code','required|callback_checkCustomerCode|xss_clean');
		$this->form_validation->set_rules('cname','Company Name','required|xss_clean');
		$this->form_validation->set_rules('cemail','Supplier Email','required|valid_email|callback_checkEmailExist|xss_clean');
		$this->form_validation->set_rules('cperson','Supplier Person Name','required');
		$this->form_validation->set_rules('climit','Supplier Limit','required|xss_clean');
		$this->form_validation->set_rules('caddress','Supplier Address','required');
		$this->form_validation->set_rules('cstatus','Supplier Status','required');
		$this->form_validation->set_rules('cphone','Supplier Phone','xss_clean');
		$this->form_validation->set_rules('cphone1','Supplier Phone','xss_clean');
		$this->form_validation->set_rules('cmobile','Supplier Mobile','xss_clean');
		$this->form_validation->set_rules('cmobile1','Supplier Mobile','xss_clean');
		$this->form_validation->set_rules('cbilltype','Supplier Bill Type','xss_clean');
		$this->form_validation->set_rules('cfax','Supplier Fax','xss_clean');
		$this->form_validation->set_rules('cavailable','Supplier Credit Available','xss_clean');
		$this->form_validation->set_rules('cbalance','Supplier Blance','xss_clean');
		
		if($this->form_validation->run() == true)
		{
			$this->supplier_model->insertSupplier();
			$this->session->set_flashdata('message','<strong>Supplier Record Inserted Successfully</strong>');
			redirect('supplier/manageSupplier');
		}
        
		$data['ccode'] = $this->form_validation->set_value('ccode');
		$data['cname'] = $this->form_validation->set_value('cname');
		$data['cemail'] = $this->form_validation->set_value('cemail');
		$data['cperson'] = $this->form_validation->set_value('cperson');
		$data['climit'] = $this->form_validation->set_value('climit');
		$data['caddress'] = $this->form_validation->set_value('caddress');
		$data['cstatus'] = $this->form_validation->set_value('cstatus');
		$data['cphone'] = $this->form_validation->set_value('cphone');
		$data['cphone1'] = $this->form_validation->set_value('cphone1');
		$data['cmobile'] = $this->form_validation->set_value('cmobile');
		$data['cmobile1'] = $this->form_validation->set_value('cmobile1');
		$data['cbilltype'] = $this->form_validation->set_value('cbilltype');
		$data['cfax'] = $this->form_validation->set_value('cfax');
		$data['cavailable'] = $this->form_validation->set_value('cavailable');
		$data['cbalance'] = $this->form_validation->set_value('cbalance');
		
		$this->load->view('supplier/add_supplier',$data);
        
    }
	
	public function editSupplier(){
		
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblSupplierMaster.cstId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['supplier_id'])) {
			$id = $this->request->get['supplier_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['supplier_id'])) {
			$url .= '&supplier_id=' .$this->request->get['supplier_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
        
		
		
		$this->form_validation->set_rules('ccode','Supplier Code','required|xss_clean');
		$this->form_validation->set_rules('cname','Company Name','required||xss_clean');
		$this->form_validation->set_rules('cemail','Supplier Email','required|valid_email|xss_clean');
		$this->form_validation->set_rules('cperson','Supplier Person Name','required');
		$this->form_validation->set_rules('climit','Supplier Limit','required|xss_clean');
		$this->form_validation->set_rules('caddress','Supplier Address','required');
		$this->form_validation->set_rules('cstatus','Supplier Status','required');
		$this->form_validation->set_rules('cphone','Supplier Phone','xss_clean');
		$this->form_validation->set_rules('cphone1','Supplier Phone','xss_clean');
		$this->form_validation->set_rules('cmobile','Supplier Mobile','xss_clean');
		$this->form_validation->set_rules('cmobile1','Supplier Mobile','xss_clean');
		$this->form_validation->set_rules('cbilltype','Supplier Bill Type','xss_clean');
		$this->form_validation->set_rules('cfax','Supplier Fax','xss_clean');
		$this->form_validation->set_rules('cavailable','Supplier Credit Available','xss_clean');
		$this->form_validation->set_rules('cbalance','Supplier Blance','xss_clean');
		
		if($this->form_validation->run() == true)
		{
			$this->supplier_model->updateSupplier();
			$this->session->set_flashdata('message','<strong>Supplier Record Updated Successfully</strong>');
			redirect('supplier/manageSupplier');
		}
		
		$data['customer_info'] = $customerInfo = $this->supplier_model->getCustomerDetail($id);
		
		if($customerInfo==0){
			
			$data['errorMessage'] = 'No Record Found';
		
			$this->load->view('common/404',$data);
			
		}else{
			
			$data['url'] = $url;
			$data['page'] = $page;
			$data['supplier_id'] = $id;
		
			$data['ccode'] = $customerInfo['supCode'];
			$data['cname'] = $customerInfo['supCompanyName'];
			$data['cemail'] = $customerInfo['supEmailId'];
			$data['cperson'] = $customerInfo['supContactPerson'];
			$data['climit'] = $customerInfo['supCreditLimit'];
			$data['caddress'] = $customerInfo['supAddress'];
			$data['cstatus'] = $customerInfo['supIsActive'];
			$data['cphone'] = $customerInfo['supPhoneNumber1'];
			$data['cphone1'] = $customerInfo['supPhoneNumber2'];
			$data['cmobile'] = $customerInfo['supMobileNumber1'];
			$data['cmobile1'] = $customerInfo['supMobileNumber2'];
			$data['cbilltype'] = $customerInfo['supBillType'];
			$data['cfax'] = $customerInfo['supFaxNumber'];
			$data['cavailable'] = $customerInfo['supCreditAvailable'];
			$data['cbalance'] = $customerInfo['supBalance'];
			
			/*echo "<pre>";
			print_r($data);
			die;*/
			
			$this->load->view('supplier/add_supplier',$data);
		}
		
	}
    
    public function manageSupplier(){
        
        if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblSupplierMaster.supId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['supplier_id'])) {
			$id = $this->request->get['supplier_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['supplier_id'])) {
			$url .= '&supplier_id=' .$this->request->get['supplier_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		$data['url'] = $url;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['supplier_id'] = $id;	
		$data['status'] = $sts;
		$data['order_url'] = $order_url;
		$data['filter_name'] = $filter_name;
		
		if ($page < 1) 
		{
			$page = 1;
		}
		else
		{
			$page = $page;
		}
		
		$config = array();
		$config["per_page"] =  10;
		$results = $this->supplier_model->getAllCustomers($filter_name, $sort, $order, $config["per_page"] , $page); 
		
		$config["base_url"] = site_url('supplier/manageSupplier/'.$url);
		$config["total_rows"] = $results['count'];
		$config["uri_segment"] = 4;  
		$config['query_string_segment'] = 'page';
		$config['page_query_string'] = TRUE;
		$config['uri_protocol'] = "PATH_INFO";
		$this->pagination->initialize($config); 
		
		$data['total_count'] = $results['count'];
		
		
		if(count($results['rows']) == 0 &&  $page!=1)
		{
			$total = (int)$data['total_count'];
			$maxPage = ceil( $total / (int)$config["per_page"] );
			$url = base_url().'supplier/manageSupplier/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0) 
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'supplier/manageSupplier/?&page='.$maxPage);
			}
		}
		
		foreach($results['rows'] as $result) 
		{	
		  $data['results'][] = array('customer_id'	     => $result['supId'],
									 'customer_company'    => $result['supCompanyName'],
									 'customer_code'    => $result['supCode'],
									 'customer_contact_person'   	 => $result['supContactPerson'],
									 'customer_billtype'   	 => $result['supBillType'],
									 'customer_status'  => $result['supIsActive'],
									 'date_added'	 => convertDate($result['supDateCreated']),
									 'edit_url'      => base_url().'supplier/editSupplier/'.$url.'&supplier_id='.$result['supId'],
									 'delete_url'    => base_url().'supplier/deleteSupplier/'.$url.'&supplier_id='.$result['supId'],
									 'filter_name'  => base_url().'supplier/manageSupplier/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;	
		$data['search_url'] = base_url().'supplier/manageSupplier/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'supplier/manageSupplier/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;
		
		$this->load->view('supplier/manage_supplier',$data);
        
    }
    
    public function deleteSupplier(){
		if (isset($this->request->get['filter_name'])) 
		{
			$filter_name = $this->request->get['filter_name'];
		}
		else if (isset($this->request->post['filter_name'])) 
		{
			$filter_name = $this->request->post['filter_name'];
		}
		else 
		{
			$filter_name = "";
		}
		
		if(isset($this->request->get['sort'])) 
		{
			$sort = $this->request->get['sort'];
		} 
		else
		{
			$sort = 'tblSupplierMaster.supId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['supplier_id'])) {
			$id = $this->request->get['supplier_id'];
		}
		else
		{
			$id = "";
		}
		
		if(isset($this->request->get['status'])) {
			$sts = $this->request->get['status'];
		}
		else
		{
			$sts = "";
		}
		
		if(isset($this->request->get['order_url'])) {
			$order_url = $this->request->get['order_url'];
		}
		else 
		{
			$order_url = "";
		}
		
		if (isset($this->request->get['delete_url'])) 
		{
			$delete_url = $this->request->get['delete_url'];
		}
		else if (isset($this->request->post['delete_url'])) 
		{
			$delete_url = $this->request->post['delete_url'];
		}
		else 
		{
			$delete_url = "";
		}
		
		if(isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		} 
		else 
		{
			$page = 1;
		}
		
		$url = '?';
		
		if(isset($this->request->get['filter_name']) || isset($this->request->post['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($filter_name, ENT_QUOTES, 'UTF-8'));
		}
		if(isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if(isset($this->request->get['order'])) {
			$url .= '&order=' .$this->request->get['order'];
		}
		if(isset($this->request->get['supplier_id'])) {
			$url .= '&supplier_id=' .$this->request->get['supplier_id'];
		}
		if(isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if(isset($this->request->get['status'])) {
			$url .= '&status=' . $this->request->get['status'];
		}
		if(isset($this->request->get['order_url'])) {
			$url .= '&order_url=' .$this->request->get['order_url'];
		}
		if(isset($this->request->get['delete_url'])) {
			$url .= '&delete_url=' . $this->request->get['delete_url'];
		}
		
		$data['url'] = $url;
		$data['page'] = $page;
        
        $dataArray = array(
                            'supIsDelete' => 1
                          );
		
		$this->db->where('supId',$id);
		$this->db->update('tblSupplieMaster',$dataArray);
		$this->session->set_flashdata('message','<strong>Supplier Record Deleted Successfully</strong>');
		redirect('supplier/manageSupplier','refresh');
	}
    
    
    public function activeAdminRecord()
	{ 	
			$pk_i_id = $this->request->get['category_id'];
			$data['fetch_status'] = $this->supplier_model->fetchCustomerActiveId($pk_i_id);
			$this->supplier_model->activeCustomerChange($pk_i_id,$data['fetch_status']->cstIsActive);
			$data['active'] = $this->supplier_model->fetchCustomerActiveId($pk_i_id);
			$json = array();
  			$json['success'] = true;
			$json['msg'] = "";
			if(($data['active']->cstIsActive)==1)
			{
				$json['msg'] = "Active";
			}
			else
			{
				$json['msg'] = "In Active";
			}
			echo json_encode($json);
  			return false;
	}
    
}
?>