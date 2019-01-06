<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$sno = $_SESSION["userid"];

	if(!is_login())
	{
	  	authenticate_user();
	}

?>

<!doctype html> 

<html> 

<head> 

   <meta charset="UTF-8"> 

   <title>已选课程</title>

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

<a href="show_course.php">查看已选课程</a>

<a href="new.php?page=1">选课</a>

<a href="show_comments.php">我的评论</a>

<a href="../sessions/delete.php">退出登录</a><br><br>

<table border=1; align=center> 
      
      <caption><h1>课程信息展示</h1></caption> 
      
      <thead> 
      
        <tr> 
      
          <th>课程代码</th>
      
          <th>课程名称</th> 
      
          <th>开课教师</th> 
      
          <th>学分</th> 
      
          <th>上课时间</th>
      
          <th>退课</th>      
      
        </tr> 
     
     </thead> 
    
    <tbody>

<?php 

	$querya = $db->prepare('SELECT * FROM sc WHERE sno = :sno');
	
	$querya->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	$querya->execute();
		
	while($posta = $querya->fetchObject())
	{
		
		$queryb = $db->prepare('SELECT * FROM course WHERE cno = :cno');
			
		$queryb->bindValue(':cno',$posta->cno,PDO::PARAM_STR);
		
		$queryb->execute();
		
		if($postb = $queryb->fetchObject()){	
?>
		    <tr> 
		    
		    <td><a href="../courses/show.php?cno=<?php print $postb->cno; ?>"><?php echo $postb->cno; ?></a></td> 
		    
		    <td><a href="../courses/show.php?cno=<?php print $postb->cno; ?>"><?php echo $postb->cname; ?></a></td>
		    
		    <td><?php echo $postb->teacher; ?></td>
		    
		    <td><?php echo $postb->credit; ?></td>
		    
		    <td><?php echo $postb->ttime; ?></td>
		    
		    <td><a href="delete.php?cno=<?php print $postb->cno;?>" >退课</a></td>   
		    
		    </tr>
	
	<?php }	} ?>
			
	</tbody>

</table>

</body>

</html>