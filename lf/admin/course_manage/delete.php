<!doctype html>

<html>

<head>

  <meta charset="UTF-8">

  <title>管理员 | 删除课程</title>

</head>

<body>

<?php
	
	$id = $_GET["cno"];
	
	echo "确定删除id为".$id."的课程？";

?>

<form action="destroy.php" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>">	

<input type="submit" value="确定">

</form>

<a href="show.php?page=1">返回</a>

</body>

</html>