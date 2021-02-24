<?php

class Sql extends PDO {

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0", "sa", "root");
    }

    private function setParams($statement, $parameters = array())
    {            
        foreach($parameters as $key => $value) {

            $this->setParam($key, $value);
        }

    }

    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key,$value);
    }

    public function myQuery($rawQuery, $params = array()) //já faz o bind, prepare e execute
    {

        $stmt = $this->conn->prepare($rawQuery);
        //var_dump($stmt); //a titulo de curiosidade
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->myQuery($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

//Ex.: fazer um UPDATE:
/*
stmt = $conn->prepare("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID");

$login = "maria";
$password = "qwert";
$id = 3;

$stmt->bindParam(":LOGIN", $login);
$stmt->bindParam(":PASSWORD", $password);
$stmt->bindParam(":ID", $id);

$stmt->execute();

echo "Alteração feita OK.<br/>"
*/


?>