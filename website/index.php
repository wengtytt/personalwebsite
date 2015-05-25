<?php 
	include("engine.php");
	$eng = new Engine();
?>
<!DOCTYPE HTML>
<html>
<head>
<?php include("head.html"); ?>
</head>
<body class="<?php echo $eng -> pageName() ?>">
<?php 
	include("nav.html"); 
	include("js.html"); 
?>
</body>
</html>
