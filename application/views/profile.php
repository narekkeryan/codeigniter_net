<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	/* my styles */
	.profile_picture {
		position: relative;
		display: inline-block;
		vertical-align: top;
		width: 256px;
		height: 256px;
		background-color: #e4e4e4;
	}

	form {
		display: inline-block;
		vertical-align: top;
	}

	input[type=file]::-webkit-file-upload-button {
		visibility: hidden;
	}
	
	input[type=file] {
		position: absolute;
		bottom: 0;
 		background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
		border: 1px solid #999;
		border-radius: 3px;
		padding: 5px 0;
		outline: none;
		white-space: nowrap;
		-webkit-user-select: none;
		cursor: pointer;
		text-shadow: 1px 1px #fff;
		font-weight: 700;
		font-size: 8pt;
	}

	input[type=submit] {
		position: absolute;
		bottom: 0;
		right: 0;
		padding: 5px;
		border: 1px solid #999;
		border-radius: 3px;
	}

	.personal_info {
		position: relative;
		display: inline-block;
		vertical-align: top;
		top: -20px;
		left: 10px;
	}
	</style>
</head>
<body>

	<div id="container">
		<h1>Welcome <?php echo $this->session->userdata('fname') . ' ' .  $this->session->userdata('lname'); ?></h1>

		<div id="body">
			<p><?php echo $this->session->flashdata('msg'); ?></p>

			<form action="<?php echo base_url(); ?>index.php/upload/upload_profile_picture/" method="post" enctype="multipart/form-data">
				<div class="profile_picture">
					<?php
					if($this->session->userdata('profile_picture')) {
					?>
					<img src="<?php echo base_url() . $this->session->userdata('profile_picture'); ?>" width="256px" height="256px" /> 
					<?php
					}
					?>
					<input type="file" name="file" />
					<input type="submit" name="Submit" />
				</div>
			</form>

			<div class="personal_info">
				<h2><?php echo $this->session->userdata('fname') . ' ' .  $this->session->userdata('lname'); ?></h2>

				<div><a href="<?php echo base_url(); ?>index.php/profile/albums/<?php echo $this->session->userdata('username'); ?>/">Albums</a></div>
				<div><a href="<?php echo base_url('index.php/messages/'); ?>">Messages <?php // echo '(' . $unseenCount . ')' ?></a></div>
				<div><a href="<?php echo base_url(); ?>index.php/profiles">Profiles</a></div>
				<div><a href="<?php echo base_url(); ?>index.php/logout">Logout</a></div>
			</div>		
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>	