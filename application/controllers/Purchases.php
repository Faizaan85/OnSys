<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeignite : Write Less Do More
    $this->load->model(array('purchase_model'));
  }

  public function index()
  {
      //list all purchases.
  }
  public function new_purchase()
  {
      $user_level = $this->session->level;

      if($user_level < 8)
      {
          die(show_error('You are not Authorized to access this page.', 404, 'Unauthorized'));
      }

      $data['title'] = 'New Purchase';
      $data['mode'] = 'New';
      $data['jslist']  = array('vue.js','custom_functions.js','new_purchase.js','v_new_purchase.js');
      $this->load->view('templates/header', $data);
      $this->load->view('purchase/v_new_purchase');
      $this->load->view('templates/footer');

  }

}
