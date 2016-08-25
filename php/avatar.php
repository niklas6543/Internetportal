<?php

	require('functions/auth.php');
	require('functions/sql.php');
	require('functions/func.php');

	$smarty= new Smarty;
	$id=$_SESSION['id'];
	
	$row = $sql->select('COUNT(userid) \'anz\'', 'images', 'userid=?', [$id]);
	$imganz = $row[0]['anz'];
	$smarty->assign("imganz",$imganz);
    
	$rows = $sql->select('id, userid', 'images', 'userid=?', [$id]);
	
	for ($i=0; $i<=$imganz-1; $i++)
	{
		$imgid[$i] = $rows[$i]['id'];
	}

	$smarty->assign("imgid",$imgid);

	if (isset($_POST['load']))
	{
		$imgfilename=$_FILES['img']['tmp_name'];
		$imgtype=$_FILES['img']['type'];
									
		if ($imgfilename)
		{
			list($orgwidth, $orgheight)=getimagesize($imgfilename);
			
			$maxwidth=64;
			$maxheight=64;
			
			$x_factor=$maxwidth/$orgwidth;
			$y_factor=$maxheight/$orgheight;
			
			$percent=min($x_factor,$y_factor);

			$new_width=(int)$orgwidth*$percent;
			$new_height=(int)$orgheight*$percent;


			$thumb = imagecreatetruecolor($new_width, $new_height);
		
			switch ($imgtype)
	        {
	            case 'image/jpeg':
					 $source = imagecreatefromjpeg($imgfilename);
	                 imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width,$new_height, $orgwidth, $orgheight);
					 ob_start(); 
					 imagejpeg($thumb);
					 break;
	            case 'image/gif':
					 $source = imagecreatefromgif($imgfilename);
	                 imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width,$new_height, $orgwidth, $orgheight);
					 ob_start(); 
					 imagegif($thumb);
					 break;
	            case 'image/png':
					 $source = imagecreatefrompng($imgfilename);
	                 imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width,$new_height, $orgwidth, $orgheight);
					 ob_start(); 
					 imagepng($thumb);
					 break;
	        }

			$imagedata = ob_get_clean(); 
	
			$sql->insert('images', ['userid' => $id, 'imgdata' => $imagedata, 'imgtype' => $imgtype]); 
			redirect();
		}
	}
	
	if ($_GET['delete'])
	{
		$sql->delete('images','id=? and userid=?', [$_GET['delete'], $id]);
		header("Location: index.php?modus=bild_laden");
	}

	$smarty->display("templates/avatar.tpl");
?>
