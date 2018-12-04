<div class="container">
    <div class="my-4 text-center">
        <h1>Manage Book</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="my-3 text-right">
                    <button class="btn btn-success" onclick="add_book()"><i class="fa fa-plus"></i> Add</button>
                </div>
                <table class="table table-bordered table-striped table-bordered" id="table_book">
                    <thead>
                        <tr>
                        	<th>Cover</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<script>
var save_method;
var table;
$(document).ready(function() {
	table = $('#table_book').DataTable({
		"processing": true,
		"serverSide": true,
		"order":[],
		
		ajax:{
			url: "<?php echo site_url("book/fetch_book"); ?>",
			type: 'POST',
		},
		"columnDefs": [
			{"targets": [-1], "orderable": false},
			{"targets": [1], "width": "20%"},
		],
	});
})

function add_book(){
	save_method = "add";
	$('#form')[0].reset();
	$('.form-control').removeClass('is-invalid');
    $('#modal_form').modal('show');
    $('.modal-title').text('Add book');

    $('#photo-preview').hide();
}

function save(){
	var site_url;
	if(save_method == "add"){
		site_url = "<?php echo site_url('book/store'); ?>"
	}else{
		site_url = "<?php echo site_url('book/update'); ?>"
	}

	var formData = new FormData($('#form')[0]);

	$.ajax({
		url: site_url,
		type: "POST",
		data: formData,
		contentType: false,
        processData: false,
		dataType: "JSON",
		success: function(data){
			if(data.status){
                $('#modal_form').modal('hide');
                swal("Berhasil!", "Data Berhasil di Simpan", "success");
                reload_table();
            }else{
            	for (var i = 0; i < data.inputerror.length; i++){
            		$('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
            	}
            	
            }
		},
		error: function(err){
            swal("Gagal!", "Ada Kesalahan", "error");
		}
	});
}

function edit(id){
	save_method = "update";
	$('#form')[0].reset();
	$('.form-control').removeClass('is-invalid');
	$('#photo-preview').show();
	$('#label-photo').text('Change photo');

	$.ajax({
		url: "<?php echo site_url('book/edit/') ?>"+ id,
		type: 'GET',
		dataType: "JSON",
		success : function(data){
			$('[name="id"]').val(data.id);
			$('[name="name"]').val(data.name);
			$('[name="status"]').val(data.status);
			$('#modal_form').modal('show');
			$('.modal-title').text('Edit book');
			if(data.image){
				$('#photo-preview div').html('<img src="'+"<?php echo base_url() ?>"+'assets/images/book_images/'+data.image+'" class="img-fluid img-thumbnail">');
			}else{
				$('#photo-preview div').text('(No photo)');
			}
		}

	});
}
function reload_table(){
    table.ajax.reload(null,false);
}

function delete_book(id){
	if(confirm("Yakin ingin menghapus?")){
		$.ajax({
			url: "<?php echo site_url('book/delete/') ?>"+id,
			type: 'POST',
			dataType: 'JSON',
			success: function(data){
				reload_table();
				swal("Berhasil!", "Data Berhasil di Hapus", "success");
			},
			error: function(err){
				swal("Gagal!", "Ada Kesalahan", "error");
			}

		});
	}
}

</script>
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input type="hidden" name="id">
						<input type="text" name="title" class="form-control">
						<div class="invalid-feedback">
					        Please provide a valid Name.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Description</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="3"></textarea>
						<div class="invalid-feedback">
					        Please provide a valid Description.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Author</label>
					<div class="col-sm-10">
						<input type="text" name="author" class="form-control">
						<div class="invalid-feedback">
					        Please provide a valid Author.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Publisher</label>
					<div class="col-sm-10">
						<input type="text" name="publisher" class="form-control">
						<div class="invalid-feedback">
					        Please provide a valid Publisher.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Price</label>
					<div class="col-sm-10">
						<input type="number" name="price" class="form-control">
						<div class="invalid-feedback">
					        Please provide a valid Price.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Weight</label>
					<div class="col-sm-10">
						<input type="number" name="weight" class="form-control">
						<div class="invalid-feedback">
					        Please provide a valid Weight.
					    </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-10">
						<select class="form-control" name="status">
							<option value="PUBLISH">PUBLISH</option>
							<option value="DRAFT">DRAFT</option>
						</select>
						<div class="invalid-feedback">
					        Please provide a valid Status.
					    </div>
					</div>
				</div>
				<div class="form-group row" id="photo-preview">
                    <label class="col-sm-2 col-form-label">Photo</label>
                     <div class="col-sm-10">(No photo)</div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="label-photo">Upload Photo </label>
                    <div class="col-sm-10">
                    	<input name="photo" type="file" class="form-control">
                	</div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="save()">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>


</body>
</html>