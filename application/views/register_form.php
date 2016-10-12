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
	</style>
</head>
<body>

	<div id="container">
		<h1>Welcome to CodeIgniter Tutorial Register Form!</h1>

		<div id="body">
			<?php // echo form_open('register'); senc chi ashxatum ?>
			<form style="max-width: 215px;" action="#" method="post">
				<div class="form-group">
					<label>
						Username:
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('username'); ?></p>
				</div>

				<div class="form-group">
					<label>
						Password:
						<input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('password'); ?></p>
				</div>

				<div class="form-group">
					<label>
						Confirm Password:
						<input type="password" name="re_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('re_password'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('re_password'); ?></p>
				</div>

				<div class="form-group">
					<label>
						Email:
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('email'); ?></p>
				</div>

				<div class="form-group">
					<label>
						First name:
						<input type="text" name="fname" class="form-control" placeholder="First name" value="<?php echo set_value('fname'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('fname'); ?></p>
				</div>

				<div class="form-group">
					<label>
						Last name:
						<input type="text" name="lname" class="form-control" placeholder="Last name" value="<?php echo set_value('lname'); ?>" autocomplete="off" required />
					</label>
					<p><?php echo form_error('lname'); ?></p>
				</div>

				<input type="submit" name="submit" value="Sign in" class="btn btn-primary" />
				<a style="float:right;margin-top:8px;" href="/codeigniter/">Sign In</a>
			</form>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>