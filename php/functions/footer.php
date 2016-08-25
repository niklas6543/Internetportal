<?php
	$smarty = new Smarty;
	$smarty->assign('date',date("D, j.M.o"));
	$smarty->display('footer.tpl');
?>
