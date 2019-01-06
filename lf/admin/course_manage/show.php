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

<div id="notice"  style="background-color:red;">

	<?php	
		
		if(has_notice()) 
		{ 

	      echo get_notice();

	      clean_notice();
	  	} 
	?>

</div>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>管理员 | 查看选课情况</title>

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

<h3>课程分类</h3>

<?php
	
	$page = $_GET["page"];

	$sqla = "SELECT * FROM sdept WHERE 1";

	$querya = $db->prepare($sqla);

	$querya->execute();

	while($posta = $querya->fetchObject()){

?>
		<a href="show.php?page=1&sdept=<?php print $posta->sid; ?>"><?php echo $posta->sname; ?></a>
		&nbsp;
<?php	}	?>

		<a href="show.php?page=1"><?php echo"全部"; ?></a>

<?php
	
	if(isset($_GET['sdept'])){
		
		$sdept = $_GET['sdept'];
		
		$queryp = pager_query('select * from course where sdept = :sdept',$nav_html,$sdept,$page);
	}
	else
	{
		$queryp = pager_query('select * from course ',$nav_html,0,$page);
		
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
          
          <th>查看学生名单</th>

          <th>删除课程</th>      
        
        </tr> 
     
     </thead> 
    
    <tbody> 
	
	<?php

		while($post = $queryp->fetchObject()){

			$sqla = "SELECT count(*) as amount FROM sc WHERE cno = :cno";
			
			$querya = $db->prepare($sqla);
			
			$querya->bindValue(':cno',$post->cno,PDO::PARAM_STR);
			
			$querya->execute();
			
			$posta = $querya->fetchObject();
			
			$select_count = $posta->amount;
			
			$lleft = $post->num-$select_count;
	
	?>
		
		<tr> 
	      
	      <td><a href="../../courses/show.php?cno=<?php print $post->cno; ?>"><?php echo $post->cno; ?></a></td>
		  
		  <td><a href="../../courses/show.php?cno=<?php print $post->cno; ?>"><?php echo $post->cname; ?></a></td>
	      
	      <td><?php echo $post->teacher; ?></td>
	      
	      <td><?php echo $post->credit; ?></td>
	      
	      <td><?php echo $post->ttime; ?></td>
	      
	      <td><?php echo $post->num; ?></td>
	      
	      <td><?php echo $select_count; ?></td>
	      
	      <td><?php echo $lleft; ?></td>
	      
	      <td><a href="edit.php?cno=<?php echo $post->cno;?>">查看学生名单（成绩录入）</a></td>

	      <td><a href="delete.php?cno=<?php echo $post->cno;?>">删除课程</a></td>
	    
	    </tr>

	<?php	}	?>
	
	</tbody>
	
	</table><br>

<?php echo $nav_html; ?> 

<br>

<a href="../index.php">返回主页</a>

</body>

</html>
