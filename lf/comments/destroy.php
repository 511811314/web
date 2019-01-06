<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$sno = $_SESSION["userid"];

	if(!is_login())
	{
	  	authenticate_user();
	}

	$comment_no = $_POST["id"];

	$sqla = "SELECT * FROM comments WHERE id = :id";
	
	$querya = $db->prepare($sqla);
	
	$querya->bindValue(':id',$comment_no,PDO::PARAM_INT);
	
	$querya->execute();
	
	$posta = $querya->fetchObject();
	
	if($posta->pic)
	{
		unlink($posta->pic);	//删除文件夹uploas中存储的图片
	}
	
	$queryb = $db->prepare('DELETE FROM comments WHERE id = :comment_no');
	
	$queryb->bindValue(':comment_no',$comment_no,PDO::PARAM_INT);
	
	if(!$queryb->execute())
	{
		print_r($queryb->errorInfo());
	}
	else
	{
		redirect_to("../students/show_comments.php");
	}

?>
