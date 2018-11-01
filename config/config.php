<?php
#diretórios raizes
<<<<<<< HEAD
$PastaInterna="/php/phpoopdo";

define ('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$PastaInterna}");

if (substr($_SERVER['DOCUMENT_ROOT'],-1)=='/'){
	define ('DIRROOT', "{$_SERVER['DOCUMENT_ROOT']}{$PastaInterna}");
}else{
	define ('DIRROOT', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}");
}

define ('DIRADMIN', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/admin/");

define ('DIRCLASS', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/classes/");

define ('DIRNAV', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/menu/");

define ('DIRIMG', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/img/");

define ('DIRCSS', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/css/");

define ('DIRJS', "{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}/js/");


#dados do banco de dados
define('HOST', "localhost");
define('DB', "phpoo");
define('USER', "root");
define('PASS', "");

?>
