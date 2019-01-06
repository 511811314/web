<!--管理员|添加学生用户（注册保存）-->
<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	if(!is_login())
	{
	  	authenticate_user();
	}

	$sno = trim($_POST["sno"]);

	$sname =trim( $_POST["sname"]);

	$sex = $_POST["sex"];

	$dept = $_POST["dept"];

	$pina = trim($_POST["pina"]);

	$pinb = trim($_POST["pinb"]);

	if($pina == $pinb)
	{
		if(load_student($sno)){
			
			set_notice('此用户已存在！');

			redirect_back();
		}

		else{
			$pin = encrypt_password($pina);

			$sql = "INSERT INTO student(sno,sname,pin,sex,sdept) VALUES(:sno,:sname,:pin,:sex,:sdept)";
			
			$query = $db->prepare($sql);

			$query->bindValue(':sno',$sno,PDO::PARAM_STR);

			$query->bindValue(':sname',$sname,PDO::PARAM_STR);

			$query->bindValue(':pin',$pin,PDO::PARAM_STR);

			$query->bindValue(':sex',$sex,PDO::PARAM_STR);

			$query->bindValue(':sdept',$dept,PDO::PARAM_INT);

			if(!$query->execute()){
				
				print_r($query->errorInfo());
			}
			else{
				
				set_notice('添加账户成功！');
				
				redirect_back();
			}
		}

	}
	else
	{
		set_notice("两次密码不一致！");

		redirect_back();
	}

?>
