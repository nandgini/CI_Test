<?php 

class User extends CI_Controller{
   public function __construct(){
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('user_model');
      $this->load->model('products_model');
      $this->load->library('session');
      $this->load->library('email');
   }

   // function for show registration page
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
         redirect('user/index');
      } 
      // if email exist, then send email confirmation link to user on his/her reg email
   }

   // function show login page after registration
   public function login(){
      $this->load->view('layouts/header.php');
      $this->load->view('members/login.php');
      $this->load->view('layouts/footer.php');
   }

   // function show data on dashboard
   public function login_user(){
      $email = $this->input->post('email'); 
      if($email){
         $this->user_model->set_user_in_session($email); 
      }
      $data['activeAndVerifiedUserCount'] = $this->user_model->active_user();
      $data['activeAndVerifiedUserCountWithActiveProduct'] = $this->products_model->active_and_attached_product(); 
      $data['activeProduct'] = $this->products_model->active_product(); 
      $data['getProductNotAssociatedWithUser'] = $this->products_model->get_product_not_attached_with_user(); 
      $data['getProductAmountOfActiveProduct'] = $this->products_model->get_amount_of_all_active_attached_products(); 
      $data['getProductPriceOfActiveProduct'] = $this->products_model->get_price_of_all_active_attached_products(); 
      $data['getProductPriceOfActiveProductForUser'] = $this->products_model->per_user_summarised_price_of_active_products(); 
      $this->load->view('layouts/header.php');
      $this->load->view('layouts/sidebar.php');
      $this->session->flashdata('message_name');
      $this->session->set_flashdata('success_msg', 'Welcome to Dashboard, You are Logged in now. ');
      $this->load->view('members/user_profile.php', $data);
      $this->load->view('layouts/footer.php');
   }

   public function user_logout(){
      $this->session->sess_destroy();
      redirect('user/login', 'refresh');
   }
 
}