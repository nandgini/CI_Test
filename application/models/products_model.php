<?php
    class Products_model extends CI_model{
        //get all products
        public function products(){
            $this->db->select('*');
            $this->db->from('products');
            if($query=$this->db->get()){
                return $query->result_array();
            } else {
                return false;
            }
        }

        //insert user product in database
        public function insert_user_product($user){
            $this->db->insert('user_products', $user);
        }

        public function get_user_data($userMail){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email', $userMail);
            if($query = $this->db->get()){
                return $query->result_array();
            } else {
                return false;
            }
        }

        // get active and attached product
        public function active_and_attached_product(){
            $this->db->select('*')
            ->from('user_products')->join('users','users.id = user_products.user_id')->join('products','products.id = user_products.product_id')
            ->where('products.status', '1')
            ->where('users.status','active');
            if($query = $this->db->get()){
                return $query->num_rows();
            } else {
                return false;
            }
        }

        // get all active product
        // status 1 = active status 2 =  deactive
        public function active_product(){
            $this->db->select('*')
            ->from('products')
            ->where('status', '1');
            if($query = $this->db->get()){
                return $query->num_rows();
            } else {
                return false;
            }
        }

        // get product those not attached with user
        public function get_product_not_attached_with_user(){
            $sql = "SELECT * from products where id NOT IN ( SELECT product_id FROM `products` JOIN `user_products` ON `user_products`.`product_id` = `products`.`id`)"; 
            $query = $this->db->query($sql);
            if($query){
                return $query->num_rows();
            } else {
                return false;
            }
        }

        // get amount of all active attached product by user
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

        // get price of all active and attached product
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

        // get price of product according to user
        public function per_user_summarised_price_of_active_products(){
            $this->db->select('*','user_products.price');
            $this->db->from('users')->join('user_products','user_products.user_id = users.id');
            $this->db->where('users.status', 'active');
            $this->db->group_by('user_products.user_id');
            $this->db->select_sum('user_products.price');
            if($query = $this->db->get()){
                return $query->result_array();
            } else {
                return false;
            }
        }
    }
?>