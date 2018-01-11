<?php
    class Order_model extends CI_Model
    {
        public function __construct()
        {
//            $this->load->database();
        }

        public function get_orders($cond = "ALL") //
        {
          if($cond == "ALL")
          {
			  //InId,
            $this->db->select('OmId, OmCompanyName, OmCreatedOn, OmLpo, InId, OmStatus, OmStore1, OmStore2, OmPrinted, OmCreatedBy');
            $yesterday = date("Y-m-d",strtotime("-2 day"));
            $whereCondition = "OmCreatedOn > '".$yesterday."' OR OmPrinted = 0";
            $this->db->where($whereCondition);
            $query = $this->db->order_by('OmId','DESC')->get('ordermaster_user');
            return $query->result_array();
          }
          else
          {
            $query = $this->db->get_where('ordermaster_user', array('OmId'=>$cond));
            $result = $query->row_array();
            if(isset($result))
            {
              return $result;
            }
            else{
              return $this->db->error();
            }
          }

        }
        public function get_order($omid) //should have been get_order_items
        {
            $query = $this->db->get_where('orderitems', array('OiOmId'=>$omid));
            return $query->result_array();
        }
        public function post_order($userid)
        {

			// Array for ordermaster
	        $order = array(
	            'OmCompanyCode' => $this->input->post('code'),
                'OmCompanyName' => $this->input->post('name'),
	            'OmCreatedOn' => $this->input->post('date'),
	            'OmLpo' => $this->input->post('lpo'),
                'OmPayTime' => $this->input->post('paytime'),
                'OmAdd' => $this->input->post('address'),
                'OmTel1' => $this->input->post('tel1'),
                'OmTel2' => $this->input->post('tel2'),
                'OmDiscount' => $this->input->post('discount'),
				'OmCreatedBy' => $userid
	        );
			// Array for orderitems
	        $orderdata = $this->input->post('orderdata');
			// Saving process begins
            $this->db->trans_begin();
            $this->db->insert('ordermaster',$order);
            $insert_id = $this->db->insert_id();
			// $json = json_encode($orderdata);
			// // $file = "./datas.txt";
			// //using the FILE_APPEND flag to append the content.
			// file_put_contents ($file, $json, FILE_APPEND);

            for($i=0;$i<count($orderdata);$i++)
            {
                $insertdata = array(
                    'OiOmId' => $insert_id,
                    'OiPartNo' => $orderdata[$i][0],
                    'OiSupplierNo' => $orderdata[$i][1],
                    'OiDescription' => $orderdata[$i][2],
                    'OiRightQty' => $orderdata[$i][3],
                    'OiLeftQty' => $orderdata[$i][4],
                    'OiTotalQty' => $orderdata[$i][5],
                    'OiPrice' => $orderdata[$i][6]
                );
                $this->db->insert('orderitems',$insertdata);
            }
            if($this->db->trans_status() === FALSE)
            {
                $errormsg =  $this->db->_error_message();
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
        public function make_invoice()
        {
            $order_id = $this->input->post('order_id');
            $vat_percent = $this->input->post('vat_percent');
            $due_date =  $this->input->post('due_date');
            $username =  $this->input->post('username');
            $this->load->model('user_model');
            // get the userid from username
            $usrid = $this->user_model->get_userid($username);

            $query = $this->db->query('insert into invoicemaster( `InOmId`, `InOmCompanyCode`, `InOmCompanyName`, `InOmCreatedOn`, `InOmLpo`, `inDueDate`, `InDiscount`, `InVatPercent`, `InOmAdd`, `InOmTel1`, `InOmTel2`, `InCreatedBy`, `InViewCount`) SELECT `OmId`, `OmCompanyCode`, `OmCompanyName`, `OmCreatedOn`, `OmLpo`, "'.$due_date.'", `OmDiscount`, '.$vat_percent.', `OmAdd`, `OmTel1`, `OmTel2`, '.$usrid['UsrId'].', 1 FROM `ordermaster` WHERE OmId = '.$order_id);
            if($query==1)
            {
                $query = $this->db->query('select InId from invoicemaster where InOmId = '.$order_id);
                $row = $query->row();
                $invoice_id = $row->InId;
                $query = $this->db->query(
                'insert into `invoiceitems`(`IiInId`, `IiOiPartNo`, `IiOiSupplierNo`, `IiOiDescription`, `IiOiLeftQty`, `IiOiRightQty`, `IiOiTotalQty`, `IiOiPrice`, `IiOiAmount`, `OiCreatedOn`) select '.$invoice_id.', `OiPartNo`, `OiSupplierNo`, `OiDescription`, `OiLeftQty`, `OiRightQty`, `OiTotalQty`, `OiPrice`, `OiAmount`, `OiCreatedOn` FROM `orderitems` where OiOmId = '.$order_id.' and  `OiStatus` !=2');
                if($query==1)
                {
                    return $invoice_id;
                }
            }
            else
            {
                return $due_date;
            }
        }
// Delete Order
		public function delete_order()
		{
			// Need to get OmId for Ordermaster table.
			// Also i should probably check user level but maybe later.
			$OmId = $this->input->post('omid');
			$this->db->set('OmIsDeleted', 1);
			$this->db->where('Omid', $OmId);
			$result = $this->db->update('ordermaster');
			return $result;
		}
// /Delete Order
        public function order_item_state($state)
        {
            // To update record set OiStatus with $state['OiStatus']
            $this->db->set('OiStatus', $state['OiStatus']);
            // With Following Conditions
            if(isset($state['OiTotalQty']))
            {
                $this->db->set('OiTotalQty', $state['OiTotalQty']);
                $this->db->set('OiLeftQty', $state['OiLeftQty']);
                $this->db->set('OiRightQty', $state['OiRightQty']);
            }
            $this->db->where('OiId',$state['OiId']);
            $this->db->where('OiOmId',$state['OiOmId']);
            // Return the result of the query.
            return $this->db->update('orderitems');
        }
		public function set_store_state()
		{
			// fetch post data into aray
			$data = array(
				'OmId' => $this->input->post('orderid'),
				'OmStore' => $this->input->post('storename'),
				'OmStoreState' => $this->input->post('status')
			);
			// set db Conditions
			$this->db->set($data['OmStore'],$data['OmStoreState']);
			$this->db->where('OmId',$data['OmId']);
			// Return the result of the query
			return $this->db->update('ordermaster');
		}
		public function set_print_state($orderid)
		{
			// Fetch post data into array
			$data = array(
				// 'OmId' => $this->input->post('orderid'),
				'OmId' => $orderid,
				'OmPrinted' => $this->input->post('status')
			);
			// Set db Conditions
			$this->db->set('OmPrinted',$data['OmPrinted']);
			$this->db->where('OmId',$data['OmId']);
			// Return the result of the query
			return $this->db->update('ordermaster');
		}
        public function get_invoices($cond = "ALL") //
        {
            if($cond == "adsfALL")
            {
                // $this->db->select('OmId, OmCompanyName, OmCreatedOn, OmLpo, OmStatus, OmStore1, OmStore2, OmPrinted, OmCreatedBy');
                // $yesterday = date("Y-m-d",strtotime("-2 day"));
                // $whereCondition = "OmCreatedOn > '".$yesterday."' OR OmPrinted = 0";
                // $this->db->where($whereCondition);
                // $query = $this->db->order_by('OmId','DESC')->get('ordermaster_user');
                // return $query->result_array();
            }
            else
            {
                $query = $this->db->get_where('invoicemaster_user_client', array('InId'=>$cond));
                $result = $query->row_array();
                if(isset($result))
                {
                    return $result;
                }
                else{
                    return $this->db->error();
                }
            }

        }
        public function get_invoice_items($inid) //should have been get_order_items
        {
            $query = $this->db->get_where('invoiceitems', array('IiInId'=>$inid));
            return $query->result_array();
        }
    }
