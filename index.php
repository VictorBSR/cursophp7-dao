<?php

require_once("config.php");
$sql = new Sql();

$usuarios = $sql->myQuery("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES ('vbarros', '0192837465')");
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);


?>