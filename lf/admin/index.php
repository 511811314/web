<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	if(!is_login())
	{
	  	authenticate_user();
	}

	$ano = $_SESSION["userid"];

?>


<!doctype html> 

<html> 

<head> 

   <meta charset="UTF-8"> 

   <title>管理员中心</title> 

   <style>

	body{
	    
	    text-align:center;
	    
	    color:black;
	    
	    background-image: url(../inc/picture/picture3.jpg);
	    
	    background-size: 100%;
	    
	    background-position: center;
	    
	    background-repeat: no-repeat;
	    
	    padding: 15px;
	}

	</style>

</head> 

<body>

<div id="notice"  style="background-color:yellow;">

<?php

if(has_notice()) 
	{ 
      echo get_notice();

      clean_notice();
  	}

  	if(!is_login())
  	{
  		authenticate_user();
  	}

?> 

</div>

<?php

	$query = $db->prepare('SELECT * FROM admin WHERE ano = :ano');
	
	$query->bindValue(':ano',$ano,PDO::PARAM_STR);
  
  	$query->execute();
  
  	$post = $query->fetchObject();
		
?>

<a href="stu_manage/new.php">添加学生用户</a><br><br>

<a href="course_manage/new.php">添加课程</a><br><br>

<a href="course_manage/show.php?page=1">选课情况</a><br><br>

<a href="../sessions/delete.php">退出登录</a><br><br>

</body>

</html>