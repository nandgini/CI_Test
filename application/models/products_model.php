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


}
?>