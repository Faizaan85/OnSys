<?php
class Item_model extends CI_Model
{
  private function checkDbError($Ar)
  {
    if(array_key_exists('code',$Ar))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public function get_items($params)
  {

    if($params['count']!=NULL)
    {
      $this->db->limit($params['count']);
    }
    $query = $this->db->get('item');
    return $query->result_array();
  }
  public function get_partno_details($partno)//input partno and get details of it.
  {
    $query = $this->db->get_where('item', array('PART_NO'=>$partno));
    return $query->row_array();
  }
  public function get_last_price()
  {
    $partno = $this->input->get('partno');
    $ccode = $this->input->get('ccode');
  }
  public function search_api($params)
  {
    //params = field, value & count.
    if($params['count'] != NULL)
    {
      $limitString = 'limit '.$params['count'];
    }
    else
    {
      $limitString = '';
    }
    if($params['wildcard'] == NULL)
    {
        $wildString = ' = "'.$params['value'].'"';
    }
    else {
      $wildString = ' LIKE "%'.$params['value'] .'%" ';
    }
    if($params['field'] == NULL)
    {
      $query = $this->db->query(' Select * from item where PART_NO '.$wildString.' OR SSNO '.$wildString.'  OR `DESC`  '.$wildString.'  OR CO_NAME  '.$wildString.'  OR REMARK  '.$wildString.'  order by PART_NO ASC '.$limitString);
      return $query->result_array();
    }
    else
    {
      $query = $this->db->query(' Select * from item where '. $params['field'].' '.$wildString.'  order by PART_NO ASC '.$limitString);
      return $query->result_array();
    }
  }
  public function search($value="")
  {
    if($value==="")
    {
      //lets search all items in all category
      $this->db->select('PART_NO, SSNO, CO_NAME, EQUIPMENT, `DESC`, SALES_PRIC, QTY_HAND, QTY_ORDER, UNIT_COST');
      $this->db->from('item');
      $this->db->like('PART_NO', $value);
      $this->db->or_like('SSNO', $value);
      $this->db->or_like('`DESC`', $value);
      $this->db->or_like('CO_NAME', $value);
      $this->db->or_like('REMARK',$value);
      $this->db->order_by('PART_NO','ASC');
      $query = $this->db->get();
      return $query->result_array();
    }
    else
    {
      $query = $this->db->query(' Select PART_NO, SSNO, CO_NAME, EQUIPMENT, `DESC`, SALES_PRIC, QTY_HAND, QTY_ORDER, UNIT_COST from item where PART_NO LIKE "%'.$value .'%" OR SSNO LIKE "%'.$value .'%" OR `DESC` LIKE "%'.$value .'%" OR CO_NAME LIKE "%'.$value .'%" OR REMARK LIKE "%'.$value .'%" order by PART_NO ASC');
      return $query->result_array();
    }
  }
  public function history($value="")
  {
    $query = $this->db->get_where('item_sales', array('Part_No' => $value));
    $data['is'] = $query->result_array();
    $query = $this->db->get_where('item_returns', array('Part_No' => $value));
    $data['ir'] = $query->result_array();
    return $data;
  }
  public function insert_item($data)
  {
    // $part_details = $this->get_partno_details($data['PART_NO']);

    // if($this->checkDbError($part_details) == false) //No error -> item exists with part no -> Cannot create same item.
    // {
    //   die("error");
    // }
    unset($data['valid']);
    $this->db->insert('item',$data);
    $affected = $this->db->affected_rows();
    if($affected>0){
      $part_details = $this->get_partno_details($data['PART_NO']);
      return $part_details;
    }
    else {
      $error = $this->db->error(); // Has keys 'code' and 'message'
    }

  }
  public function edit_item($data)
  {

  }

}
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
