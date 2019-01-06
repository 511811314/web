<!--管理员|添加学生用户（注册）-->
<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

?>

<!DOCTYPE html>

<html lang='en'>

	<meta charset="UTF-8">

	<title>学生管理 | 添加用户</title>

<head>

</head>

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

<body>

<div id="notice"  style="background-color:yellow;">

	<?php	
		
		if(has_notice()) 
		{ 

	      echo get_notice();

	      clean_notice();
	  	} 
	?>

</div>

<a href="new.php">添加学生用户</a>

<a href="../course_manage/new.php">添加课程</a>

<a href="../course_manage/show.php?page=1">选课情况</a>

<a href="../../sessions/delete.php">退出登录</a>

<h1>请填写学生信息</h1>

<?php

	$sql = "SELECT * FROM sdept";
	
	$query = $db->prepare($sql);
	
	$query->execute();

?>

<form action=save.php method='post'>

	学生学号：<input type="text" required="required" name="sno"><br><br>
	
	学生姓名：<input type="text" required="required" name="sname"><br><br>
	
	性别：<input type="radio" required="required" name="sex" value="女">女
		 
		 <input type="radio" required="required" name="sex" value="男">男<br><br>
	
	学院：<select name="dept" required="required">
		
		<option valeu="" required="required">选择学生所在院系</option>
		
		<?php
			
			while($post = $query->fetchObject()){
		
		?>
			<option value="<?php echo $post->sid;?>"><?php echo $post->sname;?></option>
		<?php	}	?>
	
	</select><br><br>
	
	密码：<input type="password" required="required" name="pina"><br><br>
	
	确认密码：<input type="password" required="required" name="pinb"><br><br>
	
	<input type="submit" name="submit" value="注册">

</form>

</body>

</html>


