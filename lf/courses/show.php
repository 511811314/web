<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$sno = $_SESSION["userid"];

?>

<!doctype html> 

<html>

<head>

<meta charset="utf-8">

<title>课程信息</title>

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

<table border=1> 

	<caption><h1>课程信息</h1></caption> 

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

		<th>标签</th>

		</tr> 
    
    </thead> 
    
    <tbody>

		<?php
			$cno = $_GET['cno'];

			$sqla = "SELECT * FROM ct WHERE cno = :cno";
			
			$querya = $db->prepare($sqla);
			
			$querya->bindValue(':cno',$cno,PDO::PARAM_STR);
			
			$querya->execute();
			
			$posta = $querya->fetchObject();

			$sql = "SELECT * FROM course WHERE cno = :cno";
			
			$query = $db->prepare($sql);
			
			$query->bindValue(':cno',$cno,PDO::PARAM_STR);
			
			$query->execute();
			
			while($post = $query->fetchObject())
			{
				$sqlb = "SELECT * FROM tages WHERE tno = :tno";
				
				$queryb = $db->prepare($sqlb);
				
				$queryb->bindValue(':tno',$posta->tno,PDO::PARAM_INT);
				
				$queryb->execute();
				
				$postb = $queryb->fetchObject();

				$sqlc = "SELECT count(*) AS amount FROM sc WHERE cno = :cno";
				
				$queryc = $db->prepare($sqlc);
				
				$queryc->bindValue(':cno',$cno,PDO::PARAM_STR);
				
				$queryc->execute();
				
				$postc = $queryc->fetchObject();

				$select_count = $postc->amount;
				
				$lleft = $post->num-$select_count;
		?>

			<tr> 
				
				<td><a href="show.php?cno=<?php print $cno; ?>"><?php echo $post->cno; ?></a></td>  
			    
			    <td><a href="show.php?cno=<?php print $cno; ?>"><?php echo $post->cname; ?></a></td>
			    
			    <td><?php echo $post->teacher; ?></td>
			    
			    <td><?php echo $post->credit; ?></td>
			    
			    <td><?php echo $post->ttime; ?></td>
			    
			     <td><?php echo $post->num; ?></td>
	      
	     		 <td><?php echo $select_count; ?></td>
	      
	      		<td><?php echo $lleft; ?></td>       
			    
			    <td><?php echo $postb->tname;?></td>
	<?php 	}	 ?>
	
	</tbody> 
	
</table>

<h1>评论列表</h1>

<?php

    $querya = $db->prepare('SELECT * FROM comments WHERE ccno = :cno');
    
    $querya->bindValue(':cno',$cno,PDO::PARAM_STR);
    
    $querya->execute();
    
    while($comment = $querya->fetchObject())
    {
      ?>
        <li>
        
        <h4><?php echo $comment->ttitle; ?></h4>
        
        <span><?php echo date('Y-m-d',strtotime($comment->ccreated_at));?></span>
        
        <p><?php echo $comment->ccomm; ?></p> 
           
        <?php
            
            if($comment->pic){//判断学生评论时是否上传了图片
        
        ?>   
            	<img src="<?php echo $comment->pic; ?>" alt="图片" width="250" height="300">         
        
        <?php    	}	?>
          
        </li> 

<?php  }	?><br>

<h1>我要评论</h1><br>

<form action="../comments/save.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name='cno' value='<?php echo $cno; ?>'/>
    
    <label for="title">标题 </label>
    <input type="text" name="title" value="" /><br><br>

    <label for="content">内容</label>
    <textarea name="content"></textarea><br><br>

    <label for="p">插入图片</label>
	<input type="file" name="p" value=""><br><br>

    <input type="submit" value="提交" />

</form>


</body>

</html>