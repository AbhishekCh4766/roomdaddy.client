<?php
////// setting server path
$serverpath		=	"leasing/";
if(!defined("SERVER_PATH"))
define("SERVER_PATH",$serverpath);

$serverpath_admin	=	"leasing/admin/";

if(!defined("SERVER_PATH_ADMIN")) define("SERVER_PATH_ADMIN",$serverpath_admin);

$dbprefix			=	"tbl_";
if(!defined("DB_PREFIX")) define("DB_PREFIX", $dbprefix);

$sitename			=	"Enron FZE";
if(!defined("SITE_NAME")) define("SITE_NAME",$sitename);

// ************ Variable Settings **************
if(!defined("ADMIN_SESSION_NAME")) define("ADMIN_SESSION_NAME", "Enron FZE");

$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
?>