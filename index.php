<?php

require_once("config.php");
//$sql = new Sql();

//n necessario, já temos classe Usuario
//$usuarios = $sql->myQuery("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES ('vbarros', '0192837465')");
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

/*Opções:
 Sql::myQuery($rawQuery, $params = array())
 Sql::select($rawQuery, $params = array())
 Usuario::loadById($id)
*/
$root=new Usuario();
$root->loadById(2);

echo $root; //como é um OBJETO, irá invocar o __toString dentro da classe Ususario


?>