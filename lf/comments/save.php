<?php 

	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	$sno = $_SESSION["userid"];

	if(!is_login())
	{
	  		authenticate_user();
	}

	$cno = $_POST["cno"];
	
	$title = $_POST["title"];
	
	$comm = htmlentities($_POST["content"]);
	
	$created_at = date('Y-m-d H:i:s');  //CURRENT_TIMESTAMP
	
	$pic = $_FILES["p"];

	$dest_path = "/comments/uploads/comments-".rand().".jpg";
	
	$dest = $_SERVER["DOCUMENT_ROOT"].$dest_path;
	
	var_export($dest);
	
	if(move_uploaded_file($_FILES["p"]["tmp_name"], $dest))
	{	
		$dest_show = "../".$dest_path;
		
		$sql = "INSERT INTO comments(ccno,ttitle,ccreated_at,ccomm,ssno,pic) VALUES (:cno,:title,:created_at,:comm,:sno,:pic)";
	
		$query = $db->prepare($sql);

		$query->bindValue(':pic',$dest_show,PDO::PARAM_STR);
	}

	else 
	{
		$sql = "INSERT INTO comments(ccno,ttitle,ccreated_at,ccomm,ssno) VALUES (:cno,:title,:created_at,:comm,:sno)";
	
		$query = $db->prepare($sql);
	}
		
	$query->bindValue(':cno',$cno,PDO::PARAM_STR);
	
	$query->bindValue(':title',$title,PDO::PARAM_STR);
	
	$query->bindValue(':created_at',$created_at,PDO::PARAM_STR);
	
	$query->bindValue(':comm',$comm,PDO::PARAM_STR);
	
	$query->bindValue(':sno',$sno,PDO::PARAM_STR);
	
	if(!$query->execute())
	{
	    printf_r($query->errorInfo());
	}    
	else
	{
	  redirect_to("../courses/show.php?cno={$cno}");
	}



?>