<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
	
	require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

	require_once $_SERVER['DOCUMENT_ROOT'].'./inc/pager.php';

	if(!is_login())
	{
	  	authenticate_user();
	}

	$cno = $_POST["cno"];

	$cname = $_POST["cname"];
	
	$teacher = $_POST["teacher"];
	
	$credit = $_POST["credit"];
	
	$time = $_POST["time"];
	
	$num = $_POST["num"];
			
	$sdept = $_POST["sdept"];
	
	$tname = $_POST["tages"];

	$sqltage = "SELECT * FROM tages WHERE tname = :tname";
	
	$querytage = $db->prepare($sqltage);
	
	$querytage->bindValue(':tname',$tname,PDO::PARAM_STR);

	$querytage->execute();
		
	if (!$posttage = $querytage->fetchObject()){
		
		echo "string";

		$tagesave = "INSERT INTO tages(tname)VALUES(:tname)";
		
		$query_t = $db->prepare($tagesave);
		
		$query_t->bindValue(':tname',$tname,PDO::PARAM_STR);
		
		if (!$query_t->execute()) 
		{
			print_r($query->errorInfo());

			exit(0);
		}
	}

	$sqltagea = "SELECT * FROM tages WHERE tname = :tname";

	$querytagea = $db->prepare($sqltagea);

	$querytagea->bindValue(':tname',$tname,PDO::PARAM_STR);

	$querytagea->execute();

	$posttagea = $querytagea->fetchObject();

	$tno = $posttagea->tno;

	$ctinsert = "INSERT INTO ct(cno,tno)VALUES(:cno,:tno)";

	$query_ct = $db->prepare($ctinsert);

	$query_ct->bindValue(':cno',$cno,PDO::PARAM_STR);

	$query_ct->bindValue(':tno',$tno,PDO::PARAM_INT);

	if (!$query_ct->execute()) 
	{
		print_r($query_ct->errorInfo());

		exit(0);
	}

	$sql = "INSERT INTO course(cno,cname,teacher,credit,ttime,num,sdept) VALUES (:cno,:cname,:teacher,:credit,:ttime,:num,:sdept)";

	$query = $db->prepare($sql);
	
	$query->bindValue(':cno',$cno,PDO::PARAM_STR);
	
	$query->bindValue(':cname',$cname,PDO::PARAM_STR);
	
	$query->bindValue(':teacher',$teacher,PDO::PARAM_STR);
	
	$query->bindValue(':credit',$credit,PDO::PARAM_INT);
	
	$query->bindValue(':ttime',$time,PDO::PARAM_STR);
	
	$query->bindValue(':num',$num,PDO::PARAM_INT);
	
	$query->bindValue(':sdept',$sdept,PDO::PARAM_INT);
	
	if (!$query->execute()) 
	{
	  	print_r($query->errorInfo());

	  	execute();
	}
	else
	{
	  	set_notice('添加课程成功！');	

	  	redirect_to("show.php?page=1");
	}
?>
