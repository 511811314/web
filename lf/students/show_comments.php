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

   <title>我的评论</title>

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

<table border=1; align=center>

	<caption><h1>我的评论</h1></caption> 

	<thead> 

	<tr> 
	    <th>id</th>	

	    <th>课程代码</th>

	    <th>评论时间</th> 
	
	    <th>评论标题</th> 
	
	    <th>评论内容</th>
	
	    <th>评论图片</th>
	
	    <th>删除</th>          
	
	</tr> 
	
	</thead> 
	
	<tbody>

<?php
	
	$query = $db->prepare('SELECT * FROM comments WHERE ssno = :sno');
	
	$query->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	$query->execute();
	
	while($post = $query->fetchObject()){
?>

	<tr>
	
	<td><?php echo $post->id ; ?></a></td> 
	
	<td><a href="../courses/show.php?cno=<?php print $post->ccno; ?>"><?php echo $post->ccno; ?></a></td>
    
    <td><?php echo $post->ccreated_at; ?></a></td>
	
	<td><?php echo $post->ttitle; ?></td>
	
	<td><?php echo $post->ccomm; ?></td>
	
	<td>
		
		<?php if($post->pic){ ?>
		
			<img src="<?php echo $post->pic; ?>" width="120" height="160">
		
		<?php } ?>

	</td>   

	<td><a href="../comments/delete.php?id=<?php echo $post->id; ?>">删除</a></td>

	</tr>

<?php	}	?>
		
	</tbody>

</table>

</body>

</html>