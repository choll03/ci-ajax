<div class="container text-center">
    <div class="my-4">
        <h1>Manage Users</h1>
    </div>
    <?php if(isset($_SESSION['message'])){ ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="my-3 text-right">
                    <?php echo anchor('user/create','Create',['class'=>'btn btn-success']); ?>
                </div>
                <table class="table table-bordered table-striped table-bordered" id="table_user">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user){ ?>
                            <tr>
                                <td><?php echo $user->name ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->address ?></td>
                                <td>
                                    <?php echo anchor('user/edit/'.$user->id, '<i class="fa fa-edit"></i>',['class'=>'btn btn-primary btn-sm']); ?>
                                    <?php echo anchor('user/delete/'.$user->id, '<i class="fa fa-trash"></i>',['class'=>'btn btn-danger btn-sm']); ?>
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table_user').DataTable({
            "columnDefs": [{
                "targets": [3],
                "orderable": false,
            }]
        });
            
    })
</script>



</body>
</html>