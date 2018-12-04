<?php


class Model_user extends CI_Model {

    public function get_users(){
        $user = $this->db->get('users');
        return($user);
    }

    public function get_user($id){
        $user = $this->db->get_where('users',['id'=>$id]);
        return $user;
    }
}