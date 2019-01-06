<?php 
  
  require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
  
  require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

  if(!is_login())
  {
      authenticate_user();
  }
  
  $cno = $_POST["cno"]; 
      
	$sqla = "SELECT * FROM sc WHERE cno = :cno";

  $querya = $db->prepare($sqla);

  $querya->bindValue(':cno',$cno,PDO::PARAM_STR);

  $querya->execute();

  while ($post = $querya->fetchObject())      //从数据库关系表中读取所有选择该课程的学生
  {
      
      $sno = $post->sno;
      
      $grade = $_POST["{$sno}"];
      
      $sqla = "UPDATE sc SET grade = :grade WHERE sno = :sno AND cno = :cno";
      
      $query = $db->prepare($sqla);
      
      $query->bindValue(':grade',$grade,PDO::PARAM_STR);
      
      $query->bindValue(':cno',$cno,PDO::PARAM_STR);
      
      $query->bindValue(':sno',$sno,PDO::PARAM_STR);
      
      if(!$query->execute()){

        print_r($query->errorInfo());

        exit(0);

      }

  }	

  set_notice('更新学生成绩成功！');

  redirect_back();

?>   
