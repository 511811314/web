<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

?>

<!doctype html> 

<html>

<head>

<meta charset="utf-8">

<title>选课</title>

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

<a href="show_course.php">查看已选课程</a>

<a href="new.php?page=1">选课</a>

<a href="show_comments.php">我的评论</a>

<a href="../sessions/delete.php">退出登录</a><br><br>

<h3>课程分类</h3>

<?php
	
	$page = $_GET["page"];

	$sno = $_SESSION["userid"];

	$sqla = "SELECT * FROM sdept WHERE 1";
	
	$querya = $db->prepare($sqla);
	
	$querya->execute();
	
	while($posta = $querya->fetchObject())
	
	{

?>
		<a href="new.php?page=1&sdept=<?php print $posta->sid; ?>"><?php echo $posta->sname; ?></a>&nbsp;

<?php	}	?>

		<a href="new.php?page=1"><?php echo"全部"; ?></a>

<?php
	
	if(isset($_GET['sdept'])){
		
		$sdept = $_GET['sdept'];
		
		$queryp = pager_query('select * from course where sdept = :sdept',$nav_html,$sdept,$page);
		
	}
	else
	{
		$queryp = pager_query('select * from course where 1',$nav_html,0,$page);
	}
?>

	<table border=1; align=center> 
      
      <caption><h1>课程信息展示</h1></caption> 
      
      <thead> 
      
        <tr> 
      
          <th>课程代码</th>
      
          <th>课程名称</th> 
      
          <th>开课教师</th> 
      
          <th>学分</th> 
      
          <th>上课时间</th>
      
          <th>总量</th>
      
          <th>已选</th>
      
          <th>余量</th>
      
          <th>选课</th>      
      
        </tr> 
     
     </thead> 
    
    <tbody> 
	
	<form action="save.php" method="post">
		
		<?php

			while($post = $queryp->fetchObject()){
				
				$sqla = "SELECT count(*) AS amount FROM sc WHERE cno = :cno";
				
				$querya = $db->prepare($sqla);
				
				$querya->bindValue(':cno',$post->cno,PDO::PARAM_STR);
				
				$querya->execute();
				
				$posta = $querya->fetchObject();
				
				$select_count = $posta->amount;
				
				$lleft = $post->num-$select_count;
		?>
		
		<tr> 
	      
	      <td><a href="../courses/show.php?cno=<?php print $post->cno; ?>"><?php echo $post->cno; ?></a></td>
		  
		  <td><a href="../courses/show.php?cno=<?php print $post->cno; ?>"><?php echo $post->cname; ?></a></td>
	      
	      <td><?php echo $post->teacher; ?></td>
	      
	      <td><?php echo $post->credit; ?></td>
	      
	      <td><?php echo $post->ttime; ?></td>
	      
	      <td><?php echo $post->num; ?></td>
	      
	      <td><?php echo $select_count; ?></td>
	      
	      <td><?php echo $lleft; ?></td>
	      
	      <td><input type="radio" name="seclass" value= "<?php echo $post->cno?>"  /></td>
	    
	    </tr>
	<?php	}	?>
	
	</tbody>
	
	</table><br>

<?php echo $nav_html; ?> 

<br>

	<input type="submit" value="选课">
	
	</form><br>


</body>

</html>
