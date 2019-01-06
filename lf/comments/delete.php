<!doctype html>

<html>

<head>

  <meta charset="UTF-8">

  <title>学生 | 删除评论</title>

</head>

<body>

<?php
	
	$id = $_GET["id"];
	
	echo "确定删除id为".$id."的评论？";

?>

<form action="destroy.php" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>">	

<input type="submit" value="确定">

</form>

<a href="show1.php?sno=<?php echo $cno; ?>"></a>

</body>

</html>