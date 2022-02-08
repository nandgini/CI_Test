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

    public function active_user(){

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('status', 'active');
        $this->db->where('is_email_verified', 1);
       // $this->db->where('email', $email);
        if($query=$this->db->get()){
            return $query->num_rows();
        } else {

            return false;
        }
    }

    public function active_and_attached_product(){

        $this->db->select('*')
        ->from('user_products')->join('users','users.id = user_products.user_id')->join('products','products.id = user_products.product_id')
        ->where('products.status', '1')
        ->where('users.status','active');
        if($query=$this->db->get()){
            return $query->num_rows();
        } else {

            return false;
        }
    }

    public function active_product(){
        $this->db->select('*')
        ->from('products')
        ->where('status', '1');
        if($query=$this->db->get()){
            return $query->num_rows();
        } else {

            return false;
        }
    }

    public function get_product_not_attached_with_user(){
        $sql = "SELECT * from products where id NOT IN ( SELECT product_id FROM `products` JOIN `user_products` ON `user_products`.`product_id` = `products`.`id`)"; 
        $query = $this->db->query($sql);
        if($query){
            return $query->num_rows();
        } else {

            return false;
        }
    }

    public function get_amount_of_all_active_attached_products(){
         $this->db->select('*')
        ->from('products')->join('user_products','products.id = user_products.product_id')
        ->where('products.status', '1');
        $this->db->select_sum('quantity');
        $query = $this->db->get();
        if($query){
            return $query->result_array();
        } else {

            return false;
        }
    }

    public function get_price_of_all_active_attached_products(){
        $this->db->select('*')
       ->from('products')->join('user_products','products.id = user_products.product_id')
       ->where('products.status', '1');
       $this->db->select_sum('price');
       $query = $this->db->get();
      
       if($query){
           return $query->result_array();
       } else {

           return false;
       }
   }

}
?>