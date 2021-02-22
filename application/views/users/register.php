<div class="row">
	<div class="col-md-4 col-md-offset-4" >
		<h1 class="text-center"><?php echo $title; ?></h1>
		<?php echo form_open('users/register');?>
		<div class="form-group">
			<?php echo form_error('name'); ?>
			<label>Name</label>
			<input type="text" class="form-control" name="name" placeholder	="Name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('email'); ?>
			<label>Email</label>
			<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('username'); ?>
			<label>Username</label>
			<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
		</div>
		<div class="form-group">
			<?php echo form_error('password'); ?>
			<label>Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<?php echo form_error('password2'); ?>
			<label>Confirm Password</label>
			<input type="password" class="form-control" name="password2" placeholder="Confirm Password">
		</div>
	<button type="submit" class="btn btn-primary btn-block">Submit</button>
	</div>
</div>
<?php echo form_close();?>