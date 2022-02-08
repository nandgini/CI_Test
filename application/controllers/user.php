<?php 

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->library('session', 'email');
    }
     public function index(){
        $this->load->view('layouts/header.php');
         $this->load->view('members/register.php');
         $this->load->view('layouts/footer.php');
     }

     // function for register sellers (users)
     // require email verification, 
     public function register_user(){
         $user = array(

            'name' =>$this->input->post('name'),
            'email' =>$this->input->post('email'),
            'password' =>$this->input->post('password'),
            'role' =>$this->input->post('role')
         );
         $email =$this->input->post('email'); 

         $email_check = $this->user_model->email_check($user['email']);
         if($email_check){
            $this->user_model->register_user($user);
            $this->session->set_flashdata('success_msg', 'You have Register Successfully.Please Login');
            redirect('user/login');
         }
         else{
            $this->session->set_flashdata('error_msg', 'Error occured, Try again.');
            redirect('user/login');
         }
         
         // if email exist, then send email confirmation link to user on his/her reg email

         //
     }

     // after reg redirect to login page
     public function login(){
        $this->load->view('layouts/header.php');
        $this->load->view('members/login.php');
        $this->load->view('layouts/footer.php');
     }

     public function login_user(){
         $data['activeAndVerifiedUserCount'] = $this->user_model->active_user();
         $data['activeAndVerifiedUserCountWithActiveProduct'] = $this->user_model->active_and_attached_product(); 
         $data['activeProduct'] = $this->user_model->active_product(); 
         $data['getProductNotAssociatedWithUser'] = $this->user_model->get_product_not_attached_with_user(); 
         $data['getProductAmountOfActiveProduct'] = $this->user_model->get_amount_of_all_active_attached_products(); 
         $data['getProductPriceOfActiveProduct'] = $this->user_model->get_price_of_all_active_attached_products(); 
         $this->load->view('layouts/header.php');
         $this->load->view('layouts/sidebar.php');
         $this->session->flashdata('message_name');
         $this->session->set_flashdata('success_msg', 'Welcome to Dashboard, You are Logged in now. ');
         $this->load->view('members/user_profile.php', $data);
         $this->load->view('layouts/footer.php');
     }
 
}