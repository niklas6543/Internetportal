<?php

function redirect()
{
   $host  = $_SERVER['HTTP_HOST'];
   $uri   = $_SERVER['REQUEST_URI'];
   header("Location: http://$host$uri");
   exit;
}



?>
