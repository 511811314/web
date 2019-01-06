<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	if(!is_login())
	{
	  	authenticate_user();
	}

	$sno = $_SESSION["userid"];

	$cno = $_POST["cno"];

	$query = $db->prepare('DELETE FROM sc WHERE sno = :sno AND cno = :cno');
	
	$query->bindValue(':cno',$cno,PDO::PARAM_STR);

	$query->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	if(!$query->execute())
	{
		print_r($query->errorInfo());
	}
	else
	{
		redirect_to("show_course.php");
	}

?>
