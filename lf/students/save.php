<?php

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$cno = $_POST["seclass"];

	$sno = $_SESSION["userid"];

	if(!is_login())
	{
	  	authenticate_user();
	}
	
	$query = $db->prepare('INSERT INTO sc (cno,sno) VALUES (:cno,:sno)');
	
	$query->bindValue(':cno',$cno,PDO::PARAM_STR);
	
	$query->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	if (!$query->execute()) 
	{
	  	print_r($query->errorInfo());
	}
	else
	{
	  	redirect_to("show_course.php");
	}
	
?>
</body>
</html>
