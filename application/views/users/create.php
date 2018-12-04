<div class="container">
    <div class="my-4 text-center">
        <h1>Create User</h1>
    </div>
    <div class="col-md-8 offset-md-2">
        <div class="my-4 p-3 bg-white rounded shadow-sm">
            <?php echo form_open('user/store') ?>
                <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label >Phone</label>
                    <input type="number" class="form-control" name="phone">
                </div>
                <div class="form-group">
                    <label >Address</label>
                    <textarea name="address" rows="3" class="form-control"></textarea>
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
            <?php echo form_close() ?>
        </div>
    </div>
</div>