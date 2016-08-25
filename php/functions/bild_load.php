<?php
 require('sql.php');
 $id=$_GET['id'];
/* $sql="SELECT imgdata,imgtype FROM images WHERE imgid=$id";
 $result=mysqli_query($con,$sql);
 $row=mysqli_fetch_assoc($result);*/
 
 $row = $sql->select('imgdata, imgtype','images','id=?', [$id]);

 header("Content-type: ".$row[0]['imgtype']);
 
 echo $row[0]['imgdata'];

?>
