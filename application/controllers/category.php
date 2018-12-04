<?php


class Category extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_category');
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('category/index');
	}

	public function fetch_category(){
		$draw = intval($this->input->post("draw"));

		$categories = $this->model_category->get_categories();

		$data = array();

		foreach ($categories->result() as $category) {
			$data[] = array(
				$category->name,
				$category->status,
				$category->image?'<img src="'.base_url('assets/images/category_images/'.$category->image).'" alt="'.$category->slug.'" class="img-responsive" width="70">':'no-photo',
				'<a href="javascript:void(0)" onclick="edit('.$category->id.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void(0)" onclick="delete_category('.$category->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
			);
		}


		$output = array(
			"draw" => $draw,
			"recordsTotal" =>$this->model_category->count_all(),
			"recordsFiltered" => $this->model_category->count_filtered(),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

	public function store(){
		$this->_validate();

		$data = array(
			'name'=> $this->input->post('name'),
			'slug'=> url_title($this->input->post('name'), 'dash', true),
			'status'=>$this->input->post('status')
		);

		if(!empty($_FILES['photo']['name'])){
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }

		$this->db->insert('categories', $data);

		echo json_encode(array("status" => TRUE));
	}

	public function edit($id) {
		$output = $this->model_category->get_by_id($id)->row();
		echo json_encode($output);
	}

	public function update(){
		$this->_validate();

		$data = array(
			'name'=> $this->input->post('name'),
			'slug'=> url_title($this->input->post('name'), 'dash', true),
			'status'=>$this->input->post('status')
		);

		if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
             
            $category = $this->model_category->get_by_id($this->input->post('id'))->row();
            if(file_exists('assets/images/category_images/'.$category->image) && $category->image)
                unlink('assets/images/category_images/'.$category->image);
 
            $data['image'] = $upload;
        }

		$this->db->where('id',$this->input->post('id'));
		$this->db->update('categories',$data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($id){
		$category = $this->model_category->get_by_id($id)->row();

        if(file_exists('assets/images/category_images/'.$category->image) && $category->image)
            unlink('assets/images/category_images/'.$category->image);

        $this->db->where('id', $category->id);
		$this->db->delete('categories');
		echo json_encode(["message"=>"berhasil"]);
	}

	 private function _do_upload(){
        $config['upload_path']          = 'assets/images/category_images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1000; 
        $config['max_height']           = 1000; 
        $config['file_name']            = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('photo')) {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
            $data['status'] = FALSE;
            exit();
        }

        return $this->upload->data('file_name');
    }

    private function create_slug($string){
	    $slug = trim($string);
	    $slug = strtolower($slug);
	    $slug = str_replace(' ', '-', $slug);

	    return $slug;
	}

	private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == ''){
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is Required';
            $data['status'] = FALSE;
        }

        if($this->input->post('status') == ''){
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is Required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }

    }

}
