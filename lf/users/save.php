<?php
session_start();

require_once '../inc/session.php';

require_once '../inc/common.php';
	
	/*
	if($_POST['role']=='student')
	{
		if( login_student($_POST['no'] , $_POST['pin']) )
		{
			
			$sno = $_POST['no'];
			
			redirect_to('../students/index.php?sno={$sno}');	

		}
		else{		

			set_notice('用户名或密码错误！');

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

			set_notice('用户名或密码错误！');

			//echo get_notice();
			
			redirect_back();	

		}
	}
*/
	//接受用户登陆时提交的验证码
	//1. 获取到用户提交的验证码
	$captcha = $_POST["captcha"];
	//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
	if(strtolower($_SESSION["captchaimg"]) == strtolower($captcha))
	{
		
		$_SESSION["captcha"] = "";
	}
	else
	{
		clean_notice();
		set_notice("图片验证码提交不正确!");
		redirect_back();
	}

?> 