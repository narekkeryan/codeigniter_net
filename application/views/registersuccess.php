<html>
<head>
	<title>My Form</title>
</head>
<body>

	<h3><?php echo $this->session->flashdata('msg'); ?></h3>

	<p><?php echo anchor('', 'Try it again!'); ?></p>

</body>
</html>