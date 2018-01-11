<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdc extends CI_Controller {
  
    public function __construct()
    {
		parent::__construct();
		$this->load->model("pdc_model");     
    }
    
    public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			redirect('pdc/addPDC');
		}
		else{
			redirect('admin');
		}
	}
	
	public function deletePDC(){
		
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
			$sort = 'tblPDC.pdcId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['pdc_id'])) {
			$id = $this->request->get['pdc_id'];
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
		if(isset($this->request->get['pdc_id'])) {
			$url .= '&pdc_id=' .$this->request->get['pdc_id'];
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
								'pdcIsDelete' => 1
							  );
		
		$this->db->where('pdcId',$id);
		$this->db->update('tblPDC',$dataQuotation);
		
		$this->session->set_flashdata('message','<strong>PDC Record Deleted Successfully</strong>');
		redirect('pdc/managePDC','refresh');
	}
	
    
    public function addPDC(){
		
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
			$sort = 'tblPDC.pdcId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['pdc_id'])) {
			$id = $this->request->get['pdc_id'];
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
		if(isset($this->request->get['pdc_id'])) {
			$url .= '&pdc_id=' .$this->request->get['pdc_id'];
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
		$data['pdc_id'] = $id;
		
		$this->form_validation->set_rules('qno','Quotation Number','required|xss_clean');
		$this->form_validation->set_rules('user_id','Customer Name','required');
		$this->form_validation->set_rules('cbilltype','Customer BillType','required');
		$this->form_validation->set_rules('pchequenumber','Cheque Number','xss_clean');
		$this->form_validation->set_rules('pbankname','Bank Name','xss_clean');
		$this->form_validation->set_rules('pamount','Amount','required|xss_clean');
		$this->form_validation->set_rules('pdate','Date','required|xss_clean');
		
		if($this->form_validation->run() == true){
			/*echo "<pre>";
			print_r($_POST);
			die;*/
			$this->pdc_model->insertQuotation();
			$this->session->set_flashdata('message','<strong>PDC Generated Successfully</strong>');
			redirect('pdc/managePDC','refresh');
		}
        
		$data['qno'] = $this->form_validation->set_value('qno');
		$data['user_id'] = $this->form_validation->set_value('user_id');
		$data['cbilltype'] = $this->form_validation->set_value('cbilltype');
		$data['pchequenumber'] = $this->form_validation->set_value('pchequenumber');
		$data['pbankname'] = $this->form_validation->set_value('pbankname');
		$data['pamount'] = $this->form_validation->set_value('pamount');
		$data['pdate'] = $this->form_validation->set_value('pdate');
		
		$this->load->view('pdc/add_pdc',$data);
        
    }
	
	public function editPDC(){
		
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
			$sort = 'tblPDC.pdcId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'asc';
		}	
		
		if(isset($this->request->get['pdc_id'])) {
			$id = $this->request->get['pdc_id'];
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
		if(isset($this->request->get['pdc_id'])) {
			$url .= '&pdc_id=' .$this->request->get['pdc_id'];
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
		$data['pdc_id'] = $id;
        
		
		
		$this->form_validation->set_rules('qno','Quotation Number','required|xss_clean');
		$this->form_validation->set_rules('user_id','Customer Name','required');
		$this->form_validation->set_rules('cbilltype','Customer BillType','required');
		$this->form_validation->set_rules('pchequenumber','Cheque Number','xss_clean');
		$this->form_validation->set_rules('pbankname','Bank Name','xss_clean');
		$this->form_validation->set_rules('pamount','Amount','required|xss_clean');
		$this->form_validation->set_rules('pdate','Date','required|xss_clean');
		
		if($this->form_validation->run() == true)
		{
			/*echo "<pre>";
			print_r($_POST);
			die;*/
			$this->pdc_model->updateQuotation();
			$this->session->set_flashdata('message','<strong>PDC Record Updated Successfully</strong>');
			redirect('pdc/managePDC','refresh');
		}
		
		$data['customer_info'] = $customerInfo = $this->pdc_model->getQuotationDetail($id);
		
		
		if($customerInfo==0){
			
			$data['errorMessage'] = 'No Record Found';
		
			$this->load->view('common/404',$data);
			
		}else{
			
			$data['url'] = $url;
			$data['page'] = $page;
			$data['quotation_id'] = $id;
			
			$data['qno'] = $customerInfo['pdcReceiptNo'];
			$data['user_id'] = $customerInfo['pdcCustomerId'];
			$data['cbilltype'] = $customerInfo['pdcPaymentType'];
			$data['pchequenumber'] = $customerInfo['pdcChequeNumber'];
			$data['pbankname'] = $customerInfo['pdcBankName'];
			$data['pamount'] = $customerInfo['pdcAmount'];
			$data['pdate'] = $customerInfo['pdcDate'];
		
			
			$this->load->view('pdc/add_pdc',$data);
		}
		
	}
	
	public function generateInvoice(){
		
		$quotationCode = $this->input->post('quotationCode');
		
		$this->pdc_model->generateInvoice($quotationCode);
		
	}
    
    public function managePDC(){
        
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
			$sort = 'tblPDC.pdcId';
		}
		
		if(isset($this->request->get['order'])) 
		{			
		   $order = $this->request->get['order'];
		}
		else 
		{
			$order = 'desc';
		}	
		
		if(isset($this->request->get['pdc_id'])) {
			$id = $this->request->get['pdc_id'];
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
		if(isset($this->request->get['pdc_id'])) {
			$url .= '&pdc_id=' .$this->request->get['pdc_id'];
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
		$data['pdc_id'] = $id;	
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
		$results = $this->pdc_model->getAllQuotation($filter_name, $sort, $order, $config["per_page"] , $page); 
		
		$config["base_url"] = site_url('pdc/managePDC/'.$url);
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
			$url = base_url().'pdc/managePDC/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0) 
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'pdc/managePDC/?&page='.$maxPage);
			}
		}
		
		foreach($results['rows'] as $result) 
		{	
		  $data['results'][] = array('pdc_id'	     => $result['pdcId'],
									 'pdcreceipt_code'    => $result['pdcReceiptNo'],
									 'customer_name'    => getCustomerName($result['pdcCustomerId']),
									 'pdcpayment_type' => $result['pdcPaymentType'],
									 'pdc_amount'  => $result['pdcAmount'],
									 'pdc_debited'   	 => $result['pdcIsDebited'],
									 'date_added'	 => convertDate($result['pdcDate']),
									 'edit_url'      => base_url().'pdc/editPDC/'.$url.'&pdc_id='.$result['pdcId'],
									 'delete_url'    => base_url().'pdc/deletePDC/'.$url.'&pdc_id='.$result['pdcId'],
									 'filter_name'  => base_url().'pdc/managePDC/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;	
		$data['search_url'] = base_url().'pdc/managePDC/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'pdc/managePDC/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;
		
		$this->load->view('pdc/manage_pdc',$data);
        
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
	
		$json = array('results' => $this->pdc_model->getCustomerWithAgCodeForSelect2($term,$id));
		
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