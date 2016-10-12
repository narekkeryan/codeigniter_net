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

	.self {
		background-color: #e6e4cf;
		text-align: right;
	}

	.side {
		width: 50%;
		max-height: 250px;
		min-width: 620px;
		overflow-y: auto;
		padding: 15px;
	}

	.side>div {
		padding: 5px;
		border: 1px solid;
		border-radius: 15px;
		margin: 10px 10px 10px 0;
		display: inline-block;
		width: 540px;
	}
	</style>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.x-git.min.js"></script>

	<script type="text/javascript">
		$(function() {
			var x = setInterval(function() {
				var element = document.getElementById("sc");
				element.scrollTop = element.scrollHeight;
			}, 100);

			$("#sc").on('scroll', function(){
			    clearInterval(x);
			});

			$('#textarea').keydown(function(e) {
				if(e.keyCode === 13 && e.ctrlKey) {
					$(this.form).submit();
				}
			});
		});
	</script>
</head>
<body>

	<div id="container">
		<h1>Welcome <?php echo $this->session->userdata('fname') . ' ' .  $this->session->userdata('lname'); ?></h1>

		<div id="body">
			<p><?php echo $this->session->userdata('username') . '&nbsp&nbsp ===>>> &nbsp&nbsp' . $other_username; ?></p>

			<div class="side" id="sc">
				<?php
				if(count($messages)) {
					foreach($messages as $message) {
						if($message->from_id == $this->session->userdata('user_id')) {
						?>
							<div class="self"><?php echo $message->message; ?></div><a href="<?php echo base_url('index.php/messages/delete/' . $message->id . '/' . $other_username); ?>">Delete</a>
						<?php
						} else {
						?>
							<div class="other_user"><?php echo $message->message; ?></div><a href="<?php echo base_url('index.php/messages/delete/' . $message->id . '/' . $other_username); ?>">Delete</a>
						<?php
						}
					}
				}
				?>	
			</div>


			<div class="side">
				<?php echo $this->session->flashdata('msg'); ?>
				<form method="post" action="<?php echo base_url('index.php/messages/sent/' . $other_username); ?>" id="form">
					<div class="form-group">
						<textarea class="form-control" name="message" id="textarea"></textarea>
					</div>
				</form>
			</div>
		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>	