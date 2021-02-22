<div class="row">
	<div class="col-md-4 col-md-offset-4" >
		<h1 class="text-center"><?php echo $title; ?></h1>
		<?php echo form_open_multipart('users/update');?>
		<?php foreach($results as $result){ ?>
		<input type="hidden" name="user_id" value="<?php echo $result->user_id; ?>">
		<div class="form-group">
			<?php echo form_error('name'); ?>
			<label>Name</label>
			<input type="text" class="form-control" name="name" placeholder	="Name" value="<?php echo $result->name; ?>">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $result->email; ?>" disabled>
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $result->username; ?>" disabled>
		</div>
		<div class="form-group">
			<?php echo form_error('age'); ?>
			<label>Age</label>
			<input type="text" class="form-control" name="age" placeholder="Age" value="<?php echo $result->age; ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('address'); ?>
			<label>Address</label>
			<input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $result->address; ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('phone'); ?>
			<label>Phone Number</label>
			<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $result->phone; ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('userfile'); ?>
			<label>Upload Profile Image</label>
			<input type="file" name="userfile" size="20" style="color: white;">
		</div>
		<?php }?>
	<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</div>
</div>
<?php echo form_close();?>