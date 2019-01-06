<!--显示课程与学生关系-->
<?php

  require_once $_SERVER["DOCUMENT_ROOT"].'./inc/db.php';
  
  require_once $_SERVER["DOCUMENT_ROOT"].'./inc/session.php';

  $ano = $_SESSION["userid"];

  $cno = $_GET["cno"]; 
?>

<div id="notice"  style="background-color:red;">
<?php

  if(has_notice()) 
    { 

        echo get_notice();

        clean_notice();
    }

?>
</div>

<!doctype html> 

<html> 

<head> 

   <meta charset="UTF-8"> 

   <title>学生选课情况</title> 

</head> 

<body> 

课程代码：<?php echo $cno; ?><br>

<?php

  $query = $db->prepare('SELECT * FROM course WHERE cno = :cno');
  
  $query->bindValue(':cno',$cno,PDO::PARAM_STR);
  
  $query->execute();
  
  $posta = $query->fetchObject();

?>

课程名称：<?php echo $posta->cname; ?><br>

开课教师：<?php echo $posta->teacher; ?><br>

<table border=1> 
      
      <caption><h1>选课情况</h1></caption> 
      
      <thead> 
      
        <tr> 
      
          <th>序号</th>
      
          <th>学生学号</th> 
      
          <th>成绩</th>    
      
        </tr> 
      
      </thead> 
      
      <tbody> 
      
      <form action="update.php" method="post">

<?php
  
  $i = 1;
  
  $query = $db->prepare('SELECT * FROM sc WHERE cno = :cno');
  
  $query->bindValue(':cno',$cno,PDO::PARAM_STR);
  
  $query->execute();
  
  while ($post = $query->fetchObject()){
      
      $sno = $post->sno;
?>
    
      <tr>
      
        <td><?php echo $i; ?></td>  
        
        <td><?php echo $post->sno; ?></td>
        
        <td><input type="text" name="<?php echo $sno; ?>" value="<?php echo $post->grade; ?>"></td>
      
      </tr>
    
<?php    $i++;    }   ?>  

</tbody>

</table>

<br><br>

  <input type="hidden" name="cno" value = "<?php echo $cno; ?>"/>

  <input type="submit" value="更新学生成绩">

  </form><br><br>

  <a href="../index.php">返回主页</a>

</body>

</html>