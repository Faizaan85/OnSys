<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotation extends CI_Controller {
  
    public function __construct()
    {
		parent::__construct();
		$this->load->model("quotation_model");     
    }
    
    public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			redirect('quotation/addQuotation');
		}
		else{
			redirect('admin');
		}
	}
	
	public function deleteQuotation(){
		
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
			$sort = 'tblQuatation.quatId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['quotation_id'])) {
			$id = $this->request->get['quotation_id'];
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
		if(isset($this->request->get['quotation_id'])) {
			$url .= '&quotation_id=' .$this->request->get['quotation_id'];
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
		
		$dataQuotation = array(
								'quatIsDelete' => 1
							  );
		
		$this->db->where('quatCode',$id);
		$this->db->update('tblQuatation',$dataQuotation);
		
		$dataQuotationLine = array(
								'qlIsDelete' => 1
							  );
		
		$this->db->where('qlQuotationCode',$id);
		$this->db->update('tblQuationLine',$dataQuotationLine);
		
		$this->session->set_flashdata('message','<strong>Quatation Deleted Successfully</strong>');
		redirect('quotation/manageQuotation','refresh');
	}
	
    
    public function addQuotation(){
		
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
			$sort = 'tblQuatation.quatId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['quotation_id'])) {
			$id = $this->request->get['quotation_id'];
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
		if(isset($this->request->get['quotation_id'])) {
			$url .= '&quotation_id=' .$this->request->get['quotation_id'];
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
		$data['quotation_id'] = $id;
		
		$this->form_validation->set_rules('qno','Quotation Number','required|callback_checkQuotationCode|xss_clean');
		$this->form_validation->set_rules('user_id','Customer Name','required');
		$this->form_validation->set_rules('cbilltype','Quotation Bill Type','required|xss_clean');
		$this->form_validation->set_rules('qlponumber','Quotation LPO Number','required|xss_clean');
		$this->form_validation->set_rules('qdiscount','Quotation Discount','required|xss_clean');
		$this->form_validation->set_rules('cart_id[]','Product Id','required');
		$this->form_validation->set_rules('desc[]','Product Description','xss_clean');
		$this->form_validation->set_rules('lqty[]','Product Left Quantity','xss_clean');
		$this->form_validation->set_rules('rqty[]','Product Right Quantity','xss_clean');
		$this->form_validation->set_rules('qty[]','Product Quantity','xss_clean');
		$this->form_validation->set_rules('uprice[]','Product Unit Cost','xss_clean');
		$this->form_validation->set_rules('tamount[]','Product Total Cost','xss_clean');
		
		if($this->form_validation->run() == true){
			/*echo "<pre>";
			print_r($_POST);
			die;*/
			$this->quotation_model->insertQuotation();
			$this->session->set_flashdata('message','<strong>Quotation Generated Successfully</strong>');
			redirect('quotation/manageQuotation');
		}
        
		$data['qno'] = $this->form_validation->set_value('qno');
		//$data['qno'] = 'Q-'.generateQuotationCode();
		$data['user_id'] = $this->form_validation->set_value('user_id');
		$data['cbilltype'] = $this->form_validation->set_value('cbilltype');
		$data['qlponumber'] = $this->form_validation->set_value('qlponumber');
		$data['qdiscount'] = $this->form_validation->set_value('qdiscount');
		$data['quotation_records'] = '';
		$data['quotation_count'] = '';
		
		$this->load->view('quotation/add_quotation',$data);
        
    }
	
	public function editQuotation(){
		
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
			$sort = 'tblQuatation.quatId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['quotation_id'])) {
			$id = $this->request->get['quotation_id'];
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
		if(isset($this->request->get['quotation_id'])) {
			$url .= '&quotation_id=' .$this->request->get['quotation_id'];
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
		$data['quotation_id'] = $id;
        
		
		
		$this->form_validation->set_rules('qno','Quotation Number','required|xss_clean');
		$this->form_validation->set_rules('user_id','Customer Name','required');
		$this->form_validation->set_rules('cbilltype','Quotation Bill Type','required|xss_clean');
		$this->form_validation->set_rules('qlponumber','Quotation LPO Number','required|xss_clean');
		$this->form_validation->set_rules('qdiscount','Quotation Discount','required|xss_clean');
		$this->form_validation->set_rules('cart_id[]','Product Id','required');
		$this->form_validation->set_rules('desc[]','Product Description','xss_clean');
		$this->form_validation->set_rules('lqty[]','Product Left Quantity','xss_clean');
		$this->form_validation->set_rules('rqty[]','Product Right Quantity','xss_clean');
		$this->form_validation->set_rules('qty[]','Product Quantity','xss_clean');
		$this->form_validation->set_rules('uprice[]','Product Unit Cost','xss_clean');
		$this->form_validation->set_rules('tamount[]','Product Total Cost','xss_clean');
		
		if($this->form_validation->run() == true)
		{
			/*echo "<pre>";
			print_r($_POST);
			die;*/
			$this->quotation_model->updateQuotation();
			$this->session->set_flashdata('message','<strong>Quotation Record Updated Successfully</strong>');
			redirect('quotation/manageQuotation');
		}
		
		$data['customer_info'] = $customerInfo = $this->quotation_model->getQuotationDetail($id);
		$data['quotation_records'] = $quotation_records = $this->quotation_model->getQuotationLineDetail($id);
		$data['quotation_count'] = count($quotation_records);
		
		
		if($customerInfo==0){
			
			$data['errorMessage'] = 'No Record Found';
		
			$this->load->view('common/404',$data);
			
		}else{
			
			$data['url'] = $url;
			$data['page'] = $page;
			$data['quotation_id'] = $id;
			
			$data['qno'] =$customerInfo['quatCode'];
			$data['user_id'] = $customerInfo['quatCustomerId'];
			$data['cbilltype'] = getCustomerBillType($customerInfo['quatCustomerId']);
			$data['qlponumber'] = $customerInfo['quatLPOnumber'];
			$data['qdiscount'] = $customerInfo['quatDiscount'];
		
			
			$this->load->view('quotation/add_quotation',$data);
		}
		
	}
	
	public function generateInvoice(){
		
		$quotationCode = $this->input->post('quotationCode');
		
		$this->quotation_model->generateInvoice($quotationCode);
		
	}
    
    public function manageQuotation(){
        
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
			$sort = 'tblQuatation.quatId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['quotation_id'])) {
			$id = $this->request->get['quotation_id'];
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
		if(isset($this->request->get['quotation_id'])) {
			$url .= '&quotation_id=' .$this->request->get['quotation_id'];
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
		$data['quotation_id'] = $id;	
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
		$results = $this->quotation_model->getAllQuotation($filter_name, $sort, $order, $config["per_page"] , $page); 
		
		$config["base_url"] = site_url('quotation/manageQuotation/'.$url);
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
			$url = base_url().'quotation/manageQuotation/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0) 
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'quotation/manageQuotation/?&page='.$maxPage);
			}
		}
		
		foreach($results['rows'] as $result) 
		{	
		  $data['results'][] = array('quotation_id'	     => $result['quatId'],
									 'quotation_code'    => $result['quatCode'],
									 'customer_name'    => getCustomerName($result['quatCustomerId']),
									 'quotation_invoicecode'  => $result['quatInvoiceCode'],
									 'quotation_lpo_number'   	 => $result['quatLPOnumber'],
									 'quotation_link'  => $result['quatReceiptDownloadLink'],
									 'date_added'	 => convertDate($result['quatDateCreated']),
									 'edit_url'      => base_url().'quotation/editQuotation/'.$url.'&quotation_id='.$result['quatCode'],
									 'delete_url'    => base_url().'quotation/deleteQuotation/'.$url.'&quotation_id='.$result['quatCode'],
									 'filter_name'  => base_url().'quotation/manageQuotation/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;	
		$data['search_url'] = base_url().'quotation/manageQuotation/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'quotation/manageQuotation/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;
		
		$this->load->view('quotation/manage_quotation',$data);
        
    }
	
	public function getCutomerBillType(){
		
		$customerId = $this->input->post('customerId');
		
		$getCustomerBillType = getCustomerBillType($customerId);
		
		$json = array();
		$json['msg'] = $getCustomerBillType;
		echo json_encode($json);
		exit;
		
	}
	
	public function getProductByAjax($id=0){
		
		if (isset($this->request->get['term'])) 
		{
			$term = $this->request->get['term'];
		}
		else if (isset($this->request->post['term'])) 
		{
			$term = $this->request->post['term'];
		}
		else 
		{
			$term = "";
		}
		
		$url = '?';
		
		
		if(isset($this->request->get['term']) || isset($this->request->post['term'])) {
			$url .= '&term=' . urlencode(html_entity_decode($term, ENT_QUOTES, 'UTF-8'));
		}
	
		$json = array('results' => $this->quotation_model->getProductWithAgCodeForSelect2($term,$id));
		
		echo json_encode($json);
		
	}
	
	public function getProductSalesPrice(){
		
		$value = $this->input->post('product_id');
		$unitPrice = getSalesPriceByProductId($value);
		$salesPrice = getUnitPriceByProductId($value);
		$description = getDescriptionByProductId($value);
		$productName = getProductDetail($value);
		$json = array();
		$json['msg'] = $unitPrice;
		$json['msg1'] = $salesPrice;
		$json['prdName'] = $productName['prdCode'];
		$json['desc'] = $description;
		echo json_encode($json);
		exit;
		
	}
	
	public function getSupplierByAjax($id=0){
		
		if (isset($this->request->get['term'])) 
		{
			$term = $this->request->get['term'];
		}
		else if (isset($this->request->post['term'])) 
		{
			$term = $this->request->post['term'];
		}
		else 
		{
			$term = "";
		}
		
		$url = '?';
		
		
		if(isset($this->request->get['term']) || isset($this->request->post['term'])) {
			$url .= '&term=' . urlencode(html_entity_decode($term, ENT_QUOTES, 'UTF-8'));
		}
	
		$json = array('results' => $this->quotation_model->getSupplierWithAgCodeForSelect2($term,$id));
		
		echo json_encode($json);
		
	}
	
	public function getCustomerByAjax($id=0){
		if (isset($this->request->get['term'])) 
		{
			$term = $this->request->get['term'];
		}
		else if (isset($this->request->post['term'])) 
		{
			$term = $this->request->post['term'];
		}
		else 
		{
			$term = "";
		}
		
		$url = '?';
		
		
		if(isset($this->request->get['term']) || isset($this->request->post['term'])) {
			$url .= '&term=' . urlencode(html_entity_decode($term, ENT_QUOTES, 'UTF-8'));
		}
	
		$json = array('results' => $this->quotation_model->getCustomerWithAgCodeForSelect2($term,$id));
		
		echo json_encode($json);
	}
    
    
    public function activeAdminRecord()
	{ 	
			$pk_i_id = $this->request->get['category_id'];
			$data['fetch_status'] = $this->product_model->fetchCustomerActiveId($pk_i_id);
			$this->product_model->activeCustomerChange($pk_i_id,$data['fetch_status']->prdIsActive);
			$data['active'] = $this->product_model->fetchCustomerActiveId($pk_i_id);
			$json = array();
  			$json['success'] = true;
			$json['msg'] = "";
			if(($data['active']->prdIsActive)==1)
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