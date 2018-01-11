<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model("product_model");
    }

    public function index()
	{
		$value = $this->session->userdata('user_id');
		if(!empty($value)){
			redirect('product/manageProduct');
		}
		else{
			redirect('admin');
		}
	}

	public function checkProductCode($ccode){

		$checkCodeExist = $this->product_model->checkProductCode($ccode);

		if($checkCodeExist>0){
			$this->form_validation->set_message('checkProductCode', 'Please Enter Unique Product Code');
			return false;
		}else{
			return true;
		}

	}

	public function check_toyear_value($ptyear,$pfyear){

		if($ptyear>$pfyear){
			return true;
		}else{
			$this->form_validation->set_message('check_toyear_value', 'Please Enter Greater To Year than From Year');
			return false;
		}

	}

	public function check_sale_cost($pscost,$pucost){

		if($pscost>$pucost){
			return true;
		}else{
			$this->form_validation->set_message('check_sale_cost', 'Please Enter Greater Sale Cost than Unit Cost');
			return false;
		}

	}

    public function addProduct(){

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
			$sort = 'tblProduct.prdId';
		}

		if(isset($this->request->get['order']))
		{
		   $order = $this->request->get['order'];
		}
		else
		{
			$order = 'asc';
		}

		if(isset($this->request->get['product_id'])) {
			$id = $this->request->get['product_id'];
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
		if(isset($this->request->get['product_id'])) {
			$url .= '&product_id=' .$this->request->get['product_id'];
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
		$data['product_id'] = $id;

		$this->form_validation->set_rules('pcode','Product Code','required|callback_checkProductCode|xss_clean');
		$this->form_validation->set_rules('poemcode','Product OEM  Name','required|xss_clean');
		$this->form_validation->set_rules('pname','Product Name','required|xss_clean');
		$this->form_validation->set_rules('user_id','Supplier Name','required');
		$this->form_validation->set_rules('scode','Supplier Code','required');
		$this->form_validation->set_rules('premark','Product Remark','required|xss_clean');
		$this->form_validation->set_rules('pdescription','Product Description','xss_clean');
		$this->form_validation->set_rules('pmeasure','Product Measure','required');
		$this->form_validation->set_rules('pumeasure','Product Unit Measure','required');
		$this->form_validation->set_rules('pquantity','Product Quantity','required|xss_clean');
		$this->form_validation->set_rules('pfyear','Product From Year','required|xss_clean');
		if($this->input->post('ptyear')!=''){
			$this->form_validation->set_rules('ptyear', 'Product To Type', 'trim|required|callback_check_toyear_value['.$this->input->post('pfyear').']');
		}
		$this->form_validation->set_rules('pmnlevel','Product Min. Level','required|xss_clean');
		$this->form_validation->set_rules('pmxlevel','Product Max. Level','required|xss_clean');
		$this->form_validation->set_rules('pucost','Product Unit Cost','required|xss_clean');
		if($this->input->post('pscost')!=''){
			$this->form_validation->set_rules('pscost', 'Product Sale Cost', 'trim|required|callback_check_sale_cost['.$this->input->post('pucost').']');
		}

		if($this->form_validation->run() == true)
		{
			$this->product_model->insertProduct();
			$this->session->set_flashdata('message','<strong>Product Record Inserted Successfully</strong>');
			redirect('product/manageProduct');
		}

		$data['pcode'] = $this->form_validation->set_value('pcode');
		$data['poemcode'] = $this->form_validation->set_value('poemcode');
		$data['pname'] = $this->form_validation->set_value('pname');
		$data['user_id'] = $this->form_validation->set_value('user_id');
		$data['scode'] = $this->form_validation->set_value('scode');
		$data['premark'] = $this->form_validation->set_value('premark');
		$data['pdescription'] = $this->form_validation->set_value('pdescription');
		$data['pmeasure'] = $this->form_validation->set_value('pmeasure');
		$data['pumeasure'] = $this->form_validation->set_value('pumeasure');
		$data['pquantity'] = $this->form_validation->set_value('pquantity');
		$data['pfyear'] = $this->form_validation->set_value('pfyear');
		$data['ptyear'] = $this->form_validation->set_value('ptyear');
		$data['pmnlevel'] = $this->form_validation->set_value('pmnlevel');
		$data['pmxlevel'] = $this->form_validation->set_value('pmxlevel');
		$data['pucost'] = $this->form_validation->set_value('pucost');
		$data['pscost'] = $this->form_validation->set_value('pscost');

		$this->load->view('product/add_product',$data);

    }

	public function editProduct(){

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
			$sort = 'tblProduct.prdId';
		}

		if(isset($this->request->get['order']))
		{
		   $order = $this->request->get['order'];
		}
		else
		{
			$order = 'asc';
		}

		if(isset($this->request->get['product_id'])) {
			$id = $this->request->get['product_id'];
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
		if(isset($this->request->get['product_id'])) {
			$url .= '&product_id=' .$this->request->get['product_id'];
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


		$this->form_validation->set_rules('pcode','Product Code','required|xss_clean');
		$this->form_validation->set_rules('poemcode','Product OEM  Name','required|xss_clean');
		$this->form_validation->set_rules('pname','Product Name','required|xss_clean');
		$this->form_validation->set_rules('user_id','Supplier Name','required');
		$this->form_validation->set_rules('scode','Supplier Code','required');
		$this->form_validation->set_rules('premark','Product Remark','required|xss_clean');
		$this->form_validation->set_rules('pdescription','Product Description','xss_clean');
		$this->form_validation->set_rules('pmeasure','Product Measure','required');
		$this->form_validation->set_rules('pumeasure','Product Unit Measure','required');
		$this->form_validation->set_rules('pquantity','Product Quantity','required|xss_clean');
		$this->form_validation->set_rules('pfyear','Product From Year','required|xss_clean');
		$this->form_validation->set_rules('ptyear','Product To Type','required|xss_clean');
		$this->form_validation->set_rules('pmnlevel','Product Min. Level','required|xss_clean');
		$this->form_validation->set_rules('pmxlevel','Product Max. Level','required|xss_clean');
		$this->form_validation->set_rules('pucost','Product Unit Cost','required|xss_clean');
		$this->form_validation->set_rules('pscost','Product Sale Cost','required|xss_clean');

		if($this->form_validation->run() == true)
		{
			$this->product_model->updateProduct();
			$this->session->set_flashdata('message','<strong>Product Record Updated Successfully</strong>');
			redirect('product/manageProduct');
		}

		$data['customer_info'] = $customerInfo = $this->product_model->getProductDetail($id);

		if($customerInfo==0){

			$data['errorMessage'] = 'No Record Found';

			$this->load->view('common/404',$data);

		}else{

			$data['url'] = $url;
			$data['page'] = $page;
			$data['product_id'] = $id;

			$data['pcode'] = $customerInfo['prdCode'];
			$data['poemcode'] = $customerInfo['prdOEMCode'];
			$data['pname'] = $customerInfo['prdName'];
			$data['user_id'] = $customerInfo['prdSupplierId'];
			$data['scode'] = $customerInfo['prdSupplierCode'];
			$data['premark'] = $customerInfo['prdRemark'];
			$data['pdescription'] = $customerInfo['prdDescription'];
			$data['pmeasure'] = $customerInfo['prdMeasure'];
			$data['pumeasure'] = $customerInfo['prdUnitMeasure'];
			$data['pquantity'] = $customerInfo['prdQuantity'];
			$data['pfyear'] = $customerInfo['prdFromYear'];
			$data['ptyear'] = $customerInfo['prdToYear'];
			$data['pmnlevel'] = $customerInfo['prdMinLevel'];
			$data['pmxlevel'] = $customerInfo['prdMaxLevel'];
			$data['pucost'] = $customerInfo['prdUnitCost'];
			$data['pscost'] = $customerInfo['prdSalesPrice'];

			$this->load->view('product/add_product',$data);
		}

	}

	public function manageProduct(){
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
			$sort = 'tblProduct.prdId';
		}

		if(isset($this->request->get['order']))
		{
		   $order = $this->request->get['order'];
		}
		else
		{
			$order = 'desc';
		}

		if(isset($this->request->get['product_id'])) {
			$id = $this->request->get['product_id'];
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
		if(isset($this->request->get['product_id'])) {
			$url .= '&product_id=' .$this->request->get['product_id'];
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
		$data['product_id'] = $id;
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
		$config["per_page"] = 10;
		$results = $this->product_model->getAllProducts($filter_name, $sort, $order, $config["per_page"] , $page);

		$config["base_url"] = site_url('product/manageProduct/'.$url);
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
			$url = base_url().'product/manageProduct/'.'?'.$_SERVER['QUERY_STRING'];

			if($maxPage==0)
			{
				$url = preg_replace('/&page=(\d)+/', '&page=1', $url);
				redirect($url);
			}
			elseif($maxPage==1)
			{
				redirect(base_url().'product/manageProduct/?&page='.$maxPage);
			}
		}

		foreach($results['rows'] as $result)
		{
		  $data['results'][] = array('customer_id'	     => $result['prdId'],
									 'customer_company'    => $result['prdName'],
									 'customer_code'    => $result['prdCode'],
									 'customer_contact_person'   	 => getSupplierName($result['prdSupplierId']),
									 'customer_oem_code'   	 => $result['prdOEMCode'],
									 'customer_status'  => $result['prdIsActive'],
									 'product_deadlock' => $result['prdIsDeadStock'],
									 'date_added'	 => convertDate($result['prdDateCreated']),
									 'edit_url'      => base_url().'product/editProduct/'.$url.'&product_id='.$result['prdId'],
									 'delete_url'    => base_url().'product/deleteProduct/'.$url.'&product_id='.$result['prdId'],
									 'deadlock_url'  => base_url().'product/deadlockProduct/'.$url.'&product_id='.$result['prdId'],
									 'filter_name'  => base_url().'product/manageProduct/'.$url.'&filter_name='.$filter_name,
									 'order' => $order,
									 'page'	=>$page,
									 'sort'	=> $sort,
									 'filter_name' 	=> $filter_name,
								     );
	    }
		$data['page'] = $page;
		$data['search_url'] = base_url().'product/manageProduct/?filter_='.(($order == 'asc') ? 'desc' : 'asc').'&sort='.$sort .'&page='.$page ;
		$data['order_url'] = base_url().'product/manageProduct/?order='.(($order == 'asc') ? 'desc' : 'asc').'&filter_name='.$filter_name.'&sort='.$sort.'&page='.$page ;

		$this->load->view('product/manage_product',$data);

    }


	public function deleteProduct(){

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
			$sort = 'tblProduct.prdId';
		}

		if(isset($this->request->get['order']))
		{
		   $order = $this->request->get['order'];
		}
		else
		{
			$order = 'desc';
		}

		if(isset($this->request->get['product_id'])) {
			$id = $this->request->get['product_id'];
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
		if(isset($this->request->get['product_id'])) {
			$url .= '&product_id=' .$this->request->get['product_id'];
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

		$this->db->where('prdId',$id);
		$this->db->delete('tblProduct');
		$this->session->set_flashdata('message','<strong>Product Deleted Successfully</strong>');
		redirect('product/manageProduct','refresh');
	}


	public function deadlockProduct(){
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
			$sort = 'tblProduct.prdId';
		}

		if(isset($this->request->get['order']))
		{
		   $order = $this->request->get['order'];
		}
		else
		{
			$order = 'desc';
		}

		if(isset($this->request->get['product_id'])) {
			$id = $this->request->get['product_id'];
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
		if(isset($this->request->get['product_id'])) {
			$url .= '&product_id=' .$this->request->get['product_id'];
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
                            'prdIsDeadStock' => -1
                          );

		$this->db->where('prdId',$id);
		$this->db->update('tblProduct',$dataArray);
		$this->session->set_flashdata('message','<strong>Product Deadlocked Successfully</strong>');
		redirect('product/manageProduct','refresh');
	}

	public function getMemberByAjax($id=0){
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

		$json = array('results' => $this->product_model->getUserWithAgCodeForSelect2($term,$id));

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
