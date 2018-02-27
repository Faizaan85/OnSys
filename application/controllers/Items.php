<?php

class Items extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('item_model');
  }
  private function checkDbError($Ar)
	{
		if(array_key_exists('code',$Ar))
		{
			return true; //has error
		}
		else
		{
			return false;
		}
	}

  public function index()
  {
    $data['title'] = "Items";
    $jslist = array("vue.js","vue-resource.js","vuetify.js","custom_functions.js","v_items.js");
    $data['jslist'] = $jslist;
    $data['autorefresh'] = FALSE;

    $this->load->view('templates/header', $data);
    $this->load->view('items/v_items.php');
    $this->load->view('templates/footer');
  }
  public function get_items()
  {
    $data['count'] = $this->input->get('count');
    $result = $this->item_model->get_items($data);
    echo json_encode($result);
  }
  public function get_part_details($partno)
  {

    $data['part'] = $this->item_model->get_partno_details($partno);
    if(empty($data['part']))
    {
      header('HTTP/1.1 404 Item Not Found');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 404)));
    }
    else
    {
      header('Content-Type: application/json');
      echo json_encode($data['part']);
    }
  }
  public function get_last_price()
  {

    $data['part'] = $this->item_model->get_last_price();
    if(empty($data['part']))
    {
      header('HTTP/1.1 404 Item Not Found');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'ERROR', 'code' => 404)));
    }
    else
    {
      header('Content-Type: application/json');
      echo json_encode($data['part']);
    }
  }
  public function item_search()
  {

    $value = $this->input->get('search');
    $data['value'] = $value;
    $value = str_replace("+", "%", $value);
    $data['searchresults'] = $this->item_model->search($value);

    $data['title'] = "Item Search";
    $data['js'] = '';
    //$data['clients'] =
    $data['autorefresh']=FALSE;
    $this->load->view('templates/header',$data);
    $this->load->view('pages/item_search');
    $this->load->view('templates/footer');
  }

  public function search_api()
  {
    $field = $this->input->get('field');
    $value = $this->input->get('value');
    $count = $this->input->get('count');
    $wildcard = $this->input->get('wc');

    if($value == NULL)
    {
      die(json_encode(array('message' => 'null value', 'code' => 505)));
    }
    else {
      $data['value'] = $value;
    }
    $data['field'] = $field;
    $data['count'] = $count;
    $data['wildcard'] = $wildcard;

    $data['searchresults'] = $this->item_model->search_api($data);
    if(empty($data['searchresults']))
    {
      header('HTTP/1.1 404 Item Not Found');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => 'Nothing found', 'code' => 500)));
    }
    else
    {
      header('Content-Type: application/json');
      echo json_encode($data['searchresults']);
    }
  }

  public function item_history()
  {
    $value = $this->input->get('item');
    $historyresult = $this->item_model->history($value);
    // echo("is:{$value} <br>");
    // print_r($historyresult);
    $data['item_sales'] = $historyresult['is'];
    $data['item_returns'] = $historyresult['ir'];
    $data['title'] = "Item History";
    $jslist =array("item_history.js");
    $data['jslist'] = $jslist;
    $data['autorefresh']=FALSE;

    $this->load->view('templates/header',$data);
    $this->load->view('pages/item_history');
    $this->load->view('templates/footer');

    // $data['searchresult'] = $this->item_model
  }
  public function post_item()
  {
    $data = $this->input->post('item');
    $result = $this->item_model->insert_item($data);
    if($this->checkDbError($result))
    {
      header('HTTP/1.1 404 Item Not Found');
      header('Content-Type: application/json; charset=UTF-8');
      die(json_encode(array('message' => $result['message'], 'code' => $result['code'])));
    }
    else {
      header('Content-Type: application/json');
      echo json_encode($result);
    }


    //
    //
    // $state = $this->input->post('state');
    //
    // $data['part_no'] = $this->input->post('part_no');//done
    // $data['equipment'] = $this->input->post('equipment');//done
    // $data['co_name'] = $this->input->post('co_name');//done
    // $data['desc'] = $this->input->post('desc');//done
    // $data['remark'] = $this->input->post('remark');//done
    // $data['bin'] = $this->input->post('bin');//done
    // $data['unit'] = $this->input->post('unit');//done
    // $data['pkg_qty'] = $this->input->post('pkg_qty');//done
    // $data['wt'] = $this->input->post('wt');//done
    // $data['unit_cost'] = $this->input->post('unit_cost');//done
    // $data['sales_pric'] = $this->input->post('sales_pric');//done
    // $data['qty_hand'] = $this->input->post('qty_hand');//done
    // $data['max_level'] = $this->input->post('max_level');//done
    // $data['min_level'] = $this->input->post('min_level');//done
    // $data['re_level'] = $this->input->post('re_level');
    // $data['qty_order'] = $this->input->post('qty_order');//done
    // $data['last_issue'] = $this->input->post('last_issue');
    // $data['op_stock'] = $this->input->post('op_stock');//done
    // $data['qty_res'] = $this->input->post('qty_res');//done
    // $data['ssno'] = $this->input->post('ssno');//done
    // $data['frrate'] = $this->input->post('frrate');//done
    // $data['op_rate'] = $this->input->post('op_rate');
    // $data['calc_avg'] = $this->input->post('calc_avg');
    // if($state == "new")
    // {
    //   $this->item_model->insert_item($data);
    // }
    // elseif ($state == 'edit')
    // {
    //   $this->item_model->edit_item($data);
    // }
  }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
