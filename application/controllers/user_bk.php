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

                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_port' => 587,
                    'smtp_user' => 'nandmaithani@gmail.com',
                    'smtp_pass' => 'nand@123#',
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1',
                    'mail_encryption' => 'tls',
                );
                $this->load->library('email', $config);
               
                
                // Set to, from, message, etc.
                $from = 'nandmaithani@gmail.com';
                $to = 'nand1235@yopmail.com';
                $subject = "helllo";
                $message = "Thankoyou for registering with us. <a href='' >Please click here to verify your email.</a> ";
        
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
               if($result = $this->email->send())
               {
                $this->session->set_flashdata('success_msg', 'we have sent email . You have Register Successfully.Please Login'); die; 
               }

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
        // $user_login = array(
        //     'email' =>$this->input->post('email'),
        //     'password' =>$this->input->post('password')

        // );
        // $data['users'] = $this->user_model->login_user();
        // if($data){

            // $this->session->set_userdata('id', $data['users'][0]['id']);
            // $this->session->set_userdata('email', $data['users'][0]['email']);
            // $this->session->set_userdata('password', $data['users'][0]['password']);
            // $this->session->set_userdata('role', $data['users'][0]['role']);
            //   echo $this->session->set_userdata('id');
              $this->load->view('layouts/header.php');
              $this->load->view('layouts/sidebar.php');
              $this->session->flashdata('message_name');
              $this->session->set_flashdata('success_msg', 'Login ! please use application.');
              $this->load->view('members/user_profile.php');
             $this->load->view('layouts/footer.php');
        // }
        // else{
        //     $this->session->set_flashdata('error_msg', 'Error occured, Try again.');
        //     redirect('login');
        // }
     }
 
}