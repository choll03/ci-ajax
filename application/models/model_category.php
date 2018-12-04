<?php

class Model_category extends CI_Model
{
	var $table = 'categories';
    var $column_order = array('name', 'status');
    var $column_search = array('name','status');
    var $order = array('id' => 'asc');

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query(){
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item){
            if($_POST['search']['value'])
            {
                 
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	public function get_categories(){
		$this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$categories = $this->db->get();
		return $categories;
	}


	public function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	public function get_by_id($id){
		$categories = $this->db->get_where($this->table,array('id'=>$id));
		return $categories;
	}
}