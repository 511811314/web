<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$sno = $_SESSION["userid"];

	if(!is_login())
	{
	  	authenticate_user();
	}

	$cno = $_POST["id"];
	
	$queryb = $db->prepare('DELETE FROM course WHERE cno = :cno');
	
	$queryb->bindValue(':cno',$cno,PDO::PARAM_STR);
	
	if(!$queryb->execute())
	{
		print_r($queryb->errorInfo());
	}
	else
	{
		redirect_to("show.php?page=1");
	}

?>
