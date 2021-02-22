<div class="row">
	<h1 class="text-center"><?php echo $title; ?></h1>
	<div align="center">
		<?php foreach($results as $result){ ?>
		<div class="col-md-4" style="margin-top: 20px">
			<img src="<?php echo base_url(); ?>assets/images/profile/<?php echo $result->profile_image; ?>" style="height: 250; width: 250; border-radius: 50%">
		</div>
		<div class="col-md-8"><table style="height: 260px; /*width: 850px;*/ font-size: 20px">
			    <tr><h4><td style="width: 150px">Name</td><td>: <?php echo ucwords($result->name); ?></td></h4></tr>
			    <tr><h4><td style="width: 150px">Username</td><td>: <?php echo $result->username; ?></td></h4></tr>
			    <tr><h4><td style="width: 150px">Email</td><td>: <?php echo $result->email; ?></td></h4></tr>
			    <tr><h4><td style="width: 150px">Age</td><td>: <?php if (empty($result->age)): echo '--'; else: echo $result->age; ?><?php endif; ?></td></h4></tr>
			    <tr><h4><td style="width: 150px">Address</td><td>: <?php if (empty($result->address)): echo '--'; else: echo $result->address; ?><?php endif; ?></td></h4></tr>
			    <tr><h4><td style="width: 150px">Phone Number</td><td>: <?php if (empty($result->phone)): echo '--'; else: echo substr_replace($result->phone, " - ", 3, 0); ?><?php endif; ?></td></h4></tr>
			<?php }?></table><br><br>
		</div>
	</div>
	<div class="col-md-12" align="center">
	<?php echo form_open('/users/edit/'); ?>  
		<input type="submit" class="btn btn-primary" value="Edit"></input>
	<?php echo form_close(); ?>
	</div>
</div>
