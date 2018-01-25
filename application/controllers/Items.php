<?php

class Items extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('item_model');
    }
    public function index()
    {
        // No idea what to do here.
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

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
