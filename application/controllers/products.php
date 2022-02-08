<?php 

class Products extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('products_model');
        $this->load->library('session');
    }

     public function index(){
         $data['products_list'] = $this->products_model->products();
         $this->load->view('layouts/header.php');
         $this->load->view('layouts/sidebar.php');
         $this->load->view('members/products.php', $data);
         $this->load->view('layouts/footer.php');
     }

}