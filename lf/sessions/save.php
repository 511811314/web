<?php

require_once '../inc/session.php';

require_once '../inc/common.php';
	
	if($_POST['role']=='student')
	{
		if( login_student($_POST['no'] , $_POST['pin']) )
		{
			
			$sno = $_POST['no'];

			redirect_to("../students/index.php");	

		}
		else{		

			redirect_back();	

		}
	}
	else if($_POST['role']=='admin')
	{
		if( login_admin($_POST['no'] , $_POST['pin']) )
		{

			$ano = $_POST['no'];
			
			redirect_to('../admin/index.php');	

		}
		else{		
			
			redirect_back();	

		}
	}

	$captcha = $_POST["captcha"];//1. 获取到用户提交的验证码
	
	if(strtolower($_SESSION["captchaimg"]) == strtolower($captcha))//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
	{
		
		$_SESSION["captcha"] = "";
	}
	else
	{
		
		set_notice("图片验证码提交不正确!");
		
		redirect_back();
	}

?> 