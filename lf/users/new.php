<?php 

require_once '../inc/session.php';

?>

<!doctype html>

<html lang="en"><!--如果不删除（lang="en"）,用谷歌浏览器打开，网页会被提示自动翻译-->

<head>

	<meta charset="UTF-8"><!--设置编码为utf-8-->

	<title>登录</title>

</head>

<body>   	

	<h1> 用户登录 </h1>

	<div id="notice"  style="background-color:red;">

	<?php	
		
		if(has_notice()) 
		{ 

	      echo get_notice();

	      clean_notice();
	  	} 
	?>

	</div>

	<form action="save.php" method="post">
	
	<label for="role">请选择您的身份</label><br/>
	
	<input type="radio" required ="required" name="role" value= "student"/>我是学生<br/>
	
	<input type="radio" required="required" name="role" value= "admin"/>我是管理员<br/><br/>
	
	账号：<input type="text" required="required" name="no"><br/><br/>
	
	密码: <input type="password" required="required" name="pin"><br/><br/>

	
	
	<img src="image_captcha.php" onclick="this.src='image_captcha.php?'+new Date().getTime();" width="200" height="150"><br/>
	
	<input type="text" required ="required" name="captcha" placeholder="请输入图片中的验证码"><br/>
	
	<input type="submit" value="进入个人中心"><br/><br/>
	</form>

</body>

</html>