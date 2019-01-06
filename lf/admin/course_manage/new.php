<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	if(!is_login())
	{
	  	authenticate_user();
	}

?>

<!doctype html> 

<html> 

<head> 

   <meta charset="UTF-8"> 

   <title>管理员|添加课程</title>

   <style>
	
	body{
	    
	    text-align:center;
	    
	    color:black;
	    
	    background-image: url(../../inc/picture/picture3.jpg);
	    
	    background-size: 100%;
	    
	    background-position: center;
	    
	    background-repeat: no-repeat;
	    
	    padding: 30px;
	}

	</style> 

</head> 

<body> 

<a href="../stu_manage/new.php">添加学生用户</a>

<a href="new.php">添加课程</a>

<a href="show.php?page=1">选课情况</a>

<a href="../../sessions/delete.php">退出登录</a>

<?php

	$sql = 'SELECT * FROM sdept';

	$query = $db->prepare($sql);

	$query->execute();
?>
	
<br><br>
<form action="save.php" method="post">

请输入以下信息：<br><br>

课程代码：<input required="required" name="cno"><br><br>

课程名称：<input required="required" name="cname"><br><br>

教师姓名：<input required="required" name="teacher"><br><br>

学分：<input required="required" name="credit"><br><br>

上课时间：<input required="required" name="time"><br><br>

学生人数：<input required="required" name="num"><br><br>

标签：<input required="required" name="tages"><br><br>

课程类型：<select name="sdept">

		<option valeu="" required="required">选择学生所在院系</option>

<?php

	while($post = $query->fetchObject()){

?>
	
	<option value="<?php echo $post->sid;?>"><?php echo $post->sname;?></option>

<?php	}	?>

</select><br><br>

<input type="submit" value="添加课程">

</form>

</body>

</html>