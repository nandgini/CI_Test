<?php 

    class User_model extends CI_model{
        // server side validation to check email exist or not
        public function email_check($email){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email', $email);
            $query = $this->db->get();
            return $query->num_rows() > 0;
        }

        public function is_verified($email){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email', $email);
            $query = $this->db->get();
            $user = $query->result_array();
            
            return $user[0]['is_email_verified'] == 1; //1 means user email is verified
        }

        public function update_is_email_verified($email, $value)
        {
            $update_rows = array(
                'is_email_verified' => 1
            );

            $this->db->where('email', $email );
            $result = $this->db->update('users', $update_rows);
            return $result;
        }

        public function login_user(){
            $this->db->select('*');
            $this->db->from('users');
            if($query = $this->db->get()){
                return $query->result_array();
            } else {
                return false;
            }
        }

        // save user data in users table
        public function register_user($user){
            $this->db->insert('users', $user);
        }

        // function for get active users
        public function active_user(){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('status', 'active');
            $this->db->where('is_email_verified', 1);
            if($query = $this->db->get()){
                return $query->num_rows();
            } else {
                return false;
            }
        }

        // set user data in session
        public function set_user_in_session($email){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email', $email);
            $query = $this->db->get();
            $user = $query->result_array();
            if(empty($user)){
                return false;
            }
            $this->session->set_userdata(array(
                'userId'  => $user[0]['id'],
                'userEmail'  => $user[0]['email'] 
            )); 
            return $user ? true : false;
        }
    }
?>