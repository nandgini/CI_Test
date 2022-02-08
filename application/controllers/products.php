<?php 

class Products extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->library('session');
    }

     public function index(){
        $this->load->view('layouts/header.php');
        $this->load->view('layouts/sidebar.php');
         $this->load->view('members/products.php');
         $this->load->view('layouts/footer.php');
     }

}