<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
  
    public function __construct()
    {
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model("customer_model");     
    }
    
    public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			redirect('customer/manageCustomer');
		}
		else{
			redirect('admin');
		}
	}
	
	public function checkEmailExist($cemail){
		
		$checkCodeExist = $this->customer_model->checkEmailExist($cemail);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkEmailExist', 'Please Enter Unique EmailId');
			return false;
		}else{
			return true;
		}
	}
	
	public function checkCustomerCode($ccode){
		
		$checkCodeExist = $this->customer_model->checkCustomerCode($ccode);
		
		if($checkCodeExist>0){
			$this->form_validation->set_message('checkCustomerCode', 'Please Enter Unique Code');
			return false;
		}else{
			return true;
		}
		
	}
    
    public function addCustomer(){
        
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
			$sort = 'tblCustomerMaster.cstId';
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
		if(isset($this->request->get['customer_id'])) {
			$url .= '&customer_id=' .$this->request->get['customer_id'];
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
		$data['customer_id'] = $id;
		
		$this->form_validation->set_rules('ccode','Customer Code','required|callback_checkCustomerCode|xss_clean');
		$this->form_validation->set_rules('cname','Company Name','required|xss_clean');
		$this->form_validation->set_rules('cemail','Customer Email','required|valid_email|callback_checkEmailExist|xss_clean');
		$this->form_validation->set_rules('cperson','Customer Person Name','required');
		$this->form_validation->set_rules('climit','Customer Limit','required|xss_clean');
		$this->form_validation->set_rules('caddress','Customer Address','required');
		$this->form_validation->set_rules('cstatus','Customer Status','required');
		$this->form_validation->set_rules('cphone','Customer Phone','xss_clean');
		$this->form_validation->set_rules('cphone1','Customer Phone','xss_clean');
		$this->form_validation->set_rules('cmobile','Customer Mobile','xss_clean');
		$this->form_validation->set_rules('cmobile1','Customer Mobile','xss_clean');
		$this->form_validation->set_rules('cbilltype','Customer Bill Type','xss_clean');
		$this->form_validation->set_rules('cfax','Customer Fax','xss_clean');
		$this->form_validation->set_rules('cavailable','Customer Credit Available','xss_clean');
		$this->form_validation->set_rules('cbalance','Customer Blance','xss_clean');
		
		if($this->form_validation->run() == true)
		{
			$this->customer_model->insertCustomer();
			$this->session->set_flashdata('message','<strong>Customer Record Inserted Successfully</strong>');
			redirect('customer/manageCustomer');
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
		
		$this->load->view('customer/add_customer',$data);
        
    }
	
	public function editCustomer(){
		
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
			$sort = 'tblCustomerMaster.cstId';
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
		if(isset($this->request->get['customer_id'])) {
			$url .= '&customer_id=' .$this->request->get['customer_id'];
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
        
		
		
		$this->form_validation->set_rules('ccode','Customer Code','required|xss_clean');
		$this->form_validation->set_rules('cname','Company Name','required||xss_clean');
		$this->form_validation->set_rules('cemail','Customer Email','required|valid_email|xss_clean');
		$this->form_validation->set_rules('cperson','Customer Person Name','required');
		$this->form_validation->set_rules('climit','Customer Limit','required|xss_clean');
		$this->form_validation->set_rules('caddress','Customer Address','required');
		$this->form_validation->set_rules('cstatus','Customer Status','required');
		$this->form_validation->set_rules('cphone','Customer Phone','xss_clean');
		$this->form_validation->set_rules('cphone1','Customer Phone','xss_clean');
		$this->form_validation->set_rules('cmobile','Customer Mobile','xss_clean');
		$this->form_validation->set_rules('cmobile1','Customer Mobile','xss_clean');
		$this->form_validation->set_rules('cbilltype','Customer Bill Type','xss_clean');
		$this->form_validation->set_rules('cfax','Customer Fax','xss_clean');
		$this->form_validation->set_rules('cavailable','Customer Credit Available','xss_clean');
		$this->form_validation->set_rules('cbalance','Customer Blance','xss_clean');
		
		if($this->form_validation->run() == true)
		{
			$this->customer_model->updateCustomer();
			$this->session->set_flashdata('message','<strong>Customer Record Updated Successfully</strong>');
			redirect('customer/manageCustomer');
		}
		
		$data['customer_info'] = $customerInfo = $this->customer_model->getCustomerDetail($id);
		
		if($customerInfo==0){
			
			$data['errorMessage'] = 'No Record Found';
		
			$this->load->view('common/404',$data);
			
		}else{
			
			$data['url'] = $url;
			$data['page'] = $page;
			$data['customer_id'] = $id;
		
			$data['ccode'] = $customerInfo['cstCode'];
			$data['cname'] = $customerInfo['cstCompanyName'];
			$data['cemail'] = $customerInfo['cstEmailId'];
			$data['cperson'] = $customerInfo['cstContactPerson'];
			$data['climit'] = $customerInfo['cstCreditLimit'];
			$data['caddress'] = $customerInfo['cstAddress'];
			$data['cstatus'] = $customerInfo['cstIsActive'];
			$data['cphone'] = $customerInfo['cstPhoneNumber1'];
			$data['cphone1'] = $customerInfo['cstPhoneNumber2'];
			$data['cmobile'] = $customerInfo['cstMobileNumber1'];
			$data['cmobile1'] = $customerInfo['cstMobileNumber2'];
			$data['cbilltype'] = $customerInfo['cstBillType'];
			$data['cfax'] = $customerInfo['cstFaxNumber'];
			$data['cavailable'] = $customerInfo['cstCreditAvailable'];
			$data['cbalance'] = $customerInfo['cstBalance'];
			
			$this->load->view('customer/add_customer',$data);
		}
		
	}
    
    public function manageCustomer(){
        
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
			$sort = 'tblCustomerMaster.cstId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
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
		if(isset($this->request->get['customer_id'])) {
			$url .= '&customer_id=' .$this->request->get['customer_id'];
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
		$data['customer_id'] = $id;	
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
		$results = $this->customer_model->getAllCustomers($filter_name, $sort, $order, $config["per_page"] , $page); 
		
		$config["base_url"] = site_url('customer/manageCustomer/'.$url);
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
			$url = base_url().'customer/manageCustomer/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0) 
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'customer/manageCustomer/?&page='.$maxPage);
			}
		}
		
		foreach($results['rows'] as $result) 
		{	
		  $data['results'][] = array('customer_id'	     => $result['cstId'],
									 'customer_company'    => $result['cstCompanyName'],
									 'customer_code'    => $result['cstCode'],
									 'customer_contact_person'   	 => $result['cstContactPerson'],
									 'customer_billtype'   	 => $result['cstBillType'],
									 'customer_status'  => $result['cstIsActive'],
									 'date_added'	 => convertDate($result['cstDateCreated']),
									 'edit_url'      => base_url().'customer/editCustomer/'.$url.'&customer_id='.$result['cstId'],
									 'delete_url'    => base_url().'customer/deleteCustomer/'.$url.'&customer_id='.$result['cstId'],
									 'filter_name'  => base_url().'customer/manageCustomer/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;	
		$data['search_url'] = base_url().'customer/manageCustomer/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'customer/manageCustomer/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;
		
		$this->load->view('customer/manage_customer',$data);
        
    }
    
    public function deleteCustomer(){
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
			$sort = 'tblCustomerMaster.cstId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
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
		if(isset($this->request->get['customer_id'])) {
			$url .= '&customer_id=' .$this->request->get['customer_id'];
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
                            'cstIsDelete' => 1
                          );
		
		$this->db->where('cstId',$id);
		$this->db->update('tblCustomerMaster',$dataArray);
		$this->session->set_flashdata('message','<strong>Customer Record Deleted Successfully</strong>');
		redirect('customer/manageCustomer','refresh');
	}
    
    
    public function activeAdminRecord()
	{ 	
			$pk_i_id = $this->request->get['category_id'];
			$data['fetch_status'] = $this->customer_model->fetchCustomerActiveId($pk_i_id);
			$this->customer_model->activeCustomerChange($pk_i_id,$data['fetch_status']->cstIsActive);
			$data['active'] = $this->customer_model->fetchCustomerActiveId($pk_i_id);
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