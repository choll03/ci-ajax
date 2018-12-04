<div class="container">
    <div class="my-4 text-center">
        <h1>Edit User</h1>
    </div>
    <div class="col-md-8 offset-md-2">
        <div class="my-4 p-3 bg-white rounded shadow-sm">
            <?php echo form_open('user/update') ?>
                <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $user->name ?>">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                </div>
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user->email ?>">
                </div>
                <div class="form-group">
                    <label >Phone</label>
                    <input type="number" class="form-control" name="phone" value="<?php echo $user->phone ?>">
                </div>
                <div class="form-group">
                    <label >Address</label>
                    <textarea name="address" rows="3" class="form-control"><?php echo $user->address ?></textarea>
                </div>
                <input type="submit" value="Edit" class="btn btn-primary">
            <?php echo form_close() ?>
        </div>
    </div>
</div>