<!doctype html>

<html>

<head>

  <meta charset="UTF-8">

  <title>学生 | 退课</title>

</head>

<body>

<?php
	
	$cno = $_GET["cno"];
	
	echo "确定退选id为".$cno."这门课？";

?>

<form action="destroy.php" method="post">

<input type="hidden" name="cno" value="<?php echo $cno; ?>">	

<input type="submit" value="确定">

</form>

</body>

</html>