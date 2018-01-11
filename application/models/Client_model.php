<?php
    class Client_model extends CI_Model
    {
        public function __construct()
        {

        }
        //below function can get ALL or 1 client.
        public function get_clients($cond="ALL")
        {
            if($cond == "ALL")
            {
                $query = $this->db->order_by('CLCODE','ASC')->get('cl001');
                return $query->result_array();
            }
            else
            {
                $query = $this->db->get_where('cl001', array('CLCODE'=>$cond));
                return $query->row_array();
            }
        }
        public function get_clients_json()
        {
            $value = $this->input->get('term');
            if($value == "ALL")
            {
                $query = $this->db->order_by('CLCODE','ASC')->get('cl001');
                return $query->result_array();
            }
            else {
                //$query = $this->db->query('Select concat(CLCODE, CLCONAME) as `label`, CLCODE as `value` from cl001 where CLCODE LIKE "%'.$value.'%" OR CLCONAME LIKE "%'.$value.'%" order by CLCONAME ASC');
                 $query = $this->db->query('Select concat(CLCODE," ", CLCONAME) as `label`, CLCODE as `value`, CLCONAME as `clconame`, CLADD1 as `cladd1`, CLTEL1 as `cltel1`, CLTEL2 as `cltel2`, CLPYTIME as `clpytime`, CLCUBAL as `clcubal`, CLCUDRCR as `clcudrcr`, CLCRAVL as `clcravl`, CLVATNO as `clvatno` from cl001 where CLCODE LIKE "%'.$value.'%" OR CLCONAME LIKE "%'.$value.'%" order by CLCONAME ASC');
                return $query->result_array();
            }
        }

    }

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
