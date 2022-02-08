<?php 
class Products_model extends CI_model{


    public function products(){

        $this->db->select('*');
        $this->db->from('products');
       // $this->db->where('email', $email);
        if($query=$this->db->get()){
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function insert_user_product($user){
        $this->db->insert('user_products', $user);
    }

    public function get_user_data($userMail){

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $userMail);
       // $this->db->where('email', $email);
        if($query=$this->db->get()){
            return $query->result_array();
        } else {

            return false;
        }
    }

}
?>