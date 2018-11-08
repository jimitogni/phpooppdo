<?php
#diretórios raizes
/*
#arquivo de configurações
if(is_dir('/php/phpoopdo/')){
  $PastaInterna="php/phpoopdo";
}elseif(is_dir('php/phpooppdo/')){
  $PastaInterna="php/phpooppdo";
}elseif(is_dir('phpooppdo/')){
  $PastaInterna="phpooppdo";
}elseif(is_dir('/phpoopdo/')){
  $PastaInterna="phpooppdo";
}
else {
  $PastaInterna="phpooppdo";
}*/

$PastaInterna="phpooppdo";

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
