<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Latihan CRUD</title>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	</head>
    <body>
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
		
            <h5 class="my-0 mr-md-auto font-weight-normal">MyApp</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <?php echo anchor('welcome', 'Home',array('class' => 'p-2 text-dark')) ?>
                <?php echo anchor('user', 'Users',array('class' => 'p-2 text-dark')) ?>
                <?php echo anchor('category', 'Category',array('class' => 'p-2 text-dark')) ?>
                <?php echo anchor('book', 'Book',array('class' => 'p-2 text-dark')) ?>
            </nav>
		</div>