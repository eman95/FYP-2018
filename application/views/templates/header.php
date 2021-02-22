<html>
<head>
	<title>Carbon Footprint Application</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/3/darkly/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
				<a class="navbar-brand" href="<?php echo base_url(); ?>" style="color: white;"><b>Carbon Footprint Application</b></a>
			<div id="navbar">
				<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><a href="<?php echo base_url(); ?>about">About</a></li>
						<?php if($this->session->userdata('logged_in')): ?>
							<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Carbon Footprint <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>calculates/calculate">Calculate Carbon Footprint</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url(); ?>results/index">Result</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url(); ?>results/suggest">Ways to reduce Carbon Footprint</a></li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if(!$this->session->userdata('logged_in')): ?>
						<li><a href="<?php echo base_url();?>users/login">Log In</a></li>
						<li><a href="<?php echo base_url();?>users/register">Register</a></li>
					<?php endif; ?>
					<?php if($this->session->userdata('logged_in')): ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="position: relative; padding-left: 50px">
								<img src="<?php echo base_url(); ?>assets/images/profile/<?php echo $this->session->userdata('image') ?>" style="width: 32px; height: 32px; position: absolute; top: 12px; left: 10px; border-radius: 50%;">
								<?php echo $this->session->userdata('username')?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>users/profile">Profile</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>users/logout">Logout</a></li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<?php if($this->session->flashdata('user_registered')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('login_failed')): ?>
			<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('user_loggedin')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('user_loggedout')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('calculated')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('calculated').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('update_profile')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('update_profile').'</p>'; ?>
		<?php endif; ?>