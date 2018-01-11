<?php
class Customers extends CI_Controller
{
    public function client_search()
    {
        $this->load->model('client_model');
        $result = $this->client_model->get_clients_json();
        echo json_encode($result);
    }
}


 ?>
