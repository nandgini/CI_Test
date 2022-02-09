<?php 

class Products extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('products_model');
        $this->load->library('session');
    }

    // function for to show products list
    public function index(){
        $data['products_list'] = $this->products_model->products();
        $this->load->view('layouts/header.php');
        $this->load->view('layouts/sidebar.php');
        $this->load->view('members/products.php', $data);
        $this->load->view('layouts/footer.php');
    }

    //function for add product and price by user
    public function user_products(){
        $userMail = $this->session->userdata('userEmail'); 
        $userData = $this->products_model->get_user_data($userMail);  
        $user_id = $userData[0]['id'];
        $user_product = array(
            'quantity' =>$this->input->post('quantity'),
            'price' =>$this->input->post('price'),
            'product_id' =>$this->input->post('product_id'),
            'user_id' =>$user_id
         );
        if($user_product){
            $this->products_model->insert_user_product($user_product);
            $this->session->set_flashdata('success_msg', 'You have attached product Successfully.');
            redirect('products/index');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Error occured, Try again.');
            redirect('products/index');
        }
    }
}