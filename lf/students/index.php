<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

?>

<!doctype html> 

<html> 

<head> 
   
   <meta charset="UTF-8"> 
  
   <title>学生个人中心</title>

   <style>
	
	body{
	    
	    text-align:center;
	    
	    color:black;
	    
	    background-image: url(../inc/picture/picture3.jpg);
	    
	    background-size: 100%;
	    
	    background-position: center;
	    
	    background-repeat: no-repeat;
	    
	    padding: 30px;
	}

	</style>
  
</head>

<body>

<h1>个人中心</h1>

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
	
	$sno = $_SESSION["userid"];
		
	$query = $db->prepare('SELECT * FROM student WHERE sno = :sno');
	
	$query->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	$query->execute();
	
	$post = $query->fetchObject();

?><br/>



<a href="show_course.php">查看已选课程</a>

<a href="new.php?page=1">选课</a>

<a href="show_comments.php">我的评论</a>

<a href="../sessions/delete.php">退出登录</a>

</body>

</html>