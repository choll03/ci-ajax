<?php


class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_user');
	}

	public function index(){
		$data['users'] = $this->model_user->get_users()->result();
		$data['message'] = $this->session->flashdata('message');

		$this->load->view('layout/header');
		$this->load->view('users/index', $data);
	}

	public function create(){
		$this->load->view('layout/header');
		$this->load->view('users/create');
		$this->load->view('layout/footer');

	}

	public function store(){
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'roles' => '["CUSTOMER"]',
		);

		$this->db->insert('users', $data);
		$this->session->set_flashdata('message', 'Data berhasil di buat');
		redirect('user');
	}

	public function edit(){
		$id = $this->uri->segment(3);
		$data['user'] = $this->model_user->get_user($id)->row();

		$this->load->view('layout/header');
		$this->load->view('users/edit', $data);
		$this->load->view('layout/footer');
	}

	public function update(){
		$id = $this->input->post('id');
		$data = array(
			'name'=>$this->input->post('name'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'address'=>$this->input->post('address')
		);
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		$this->session->set_flashdata('message', 'Data berhasil di rubah');
		redirect('user');
	}

	public function delete(){
		$id = $this->uri->segment(3);
		$this->db->where('id', $id);
		$this->db->delete('users');
		$this->session->set_flashdata('message', 'Data berhasil di Hapus');
		redirect('user');
	}
}