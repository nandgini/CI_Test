<?php 
class User_model extends CI_model{

    // server side validation to check email exist or not

    public function email_check($email){

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query =     $this->db->get();
        if($query->num_rows()>0){

            return false;
        } else {

            return true;
        }
    }

    public function login_user(){

        $this->db->select('*');
        $this->db->from('users');
       // $this->db->where('email', $email);
        if($query=$this->db->get()){
            return $query->result_array();
        } else {

            return false;
        }
    }

// save user data in users table

    public function register_user($user){
        $this->db->insert('users', $user);
    }

}
?>