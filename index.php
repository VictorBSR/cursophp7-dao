<?php

require_once("config.php");
$sql = new Sql();

//não necessario, já temos classe Usuario
//$usuarios = $sql->myQuery("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES ('zeta', 'senha123')");
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

/*Opções:
 Sql::myQuery($rawQuery, $params = array())
 Sql::select($rawQuery, $params = array())
*/

//Carrega um usuário 
/*
$root=new Usuario();
$root->loadById(2);
echo $root; //como é um OBJETO, irá invocar o __toString dentro da classe Ususario
*/

//Carrega tdoos os usuários
/*
$lista = Usuario::getList();
echo json_encode($lista);
*/

//Carrega uma lista de usuários buscando-se pelo login
//$search = Usuario::search("b");
//echo json_encode($search);

//Carrega infos de um usuário após login
/*
$usr=new Usuario();
$usr->login("bar","br34");
echo $usr; //como é um OBJETO, irá invocar o __toString dentro da classe Ususario
*/

//Insere um usuário novo
/*
$aluno = new Usuario('acer','pcdell');

$aluno->insert();
echo $aluno;
*/

//Atualiza infos (login/senha) //não funciona
/*
$usr = new Usuario();
$usr->loadById(6);
$usr->update("professor", "Rec@342");
echo $usr;
*/

?>