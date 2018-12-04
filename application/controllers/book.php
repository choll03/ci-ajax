<?php


class Book extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_book');
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('book/index');
	}

	public function fetch_book(){
		$draw = intval($this->input->post("draw"));

		$books = $this->model_book->get_books();

		$data = array();

		foreach ($books->result() as $book) {
			$data[] = array(
				$book->cover?'<img src="'.base_url('assets/images/book-covers/'.$book->cover).'" alt="'.$book->slug.'" class="img-responsive" width="70">':'no-photo',
				$book->title,
				$book->author,
				$book->publisher,
				$book->price,
				$book->stock,
				'<a href="javascript:void(0)" onclick="edit('.$book->id.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
				<a href="javascript:void(0)" onclick="delete_book('.$book->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
			);
		}


		$output = array(
			"draw" => $draw,
			"recordsTotal" =>$this->model_book->count_all(),
			"recordsFiltered" => $this->model_book->count_filtered(),
			"data" => $data
		);

		echo json_encode($output);
		exit();
	}

	public function store(){

	}

	public function edit($id){

	}

	public function update(){

	}

	public function delete($id){

	}

}
