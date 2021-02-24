<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($value) {
        $this->idusuario=$value;
    }

    public function getDeslogin() {
        return $this->deslogin;
    }

    public function setDeslogin($value) {
        $this->deslogin=$value;
    }

    public function getDessenha() {
        return $this->dessenha;
    }

    public function setDessenha($value) {
        $this->dessenha=$value;
    }

    public function getDtcadastro() {
        return $this->dtcadastro;
    }

    public function setDtcadastro($value) {
        $this->dtcadastro=$value;
    }

    public function loadById($id)
    {
        $this->setIdusuario($id);   //corrige erro null no update

        $sql=new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        //se achar o ID, já faz atribuição dos params da classe
        if(count($result) > 0) {  //ou ifexists
            $this->setData($result[0]);
        } else echo "Usuário não encontrado.<br><br>";
    }

    public function update($login, $password) {
        //faz a alteração de usuario/senha
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID;", array( //problema desconhecido Warning: PDO::query(): SQLSTATE[00000]: No error: PDO constructor was not called in C:\ATDI\Projeto\php\dao\class\Usuario.php on line 66
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdusuario()
        ));
    }


    public function __construct($login = '', $password = '')
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format('d/m/Y H:i:s')
        ));
    }

    public static function getList() {  //pode ser estático por nao usar $this

        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login) {  

        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $password) {

        $sql=new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        //se achar o ID, já faz atribuição dos params da classe
        if(count($result) > 0) {  //ou ifexists
            $this->setData($result[0]);
        } else {
            
            throw new Exception("Login e/ou senha inválidos.");
        }
    }


    public function setData($data)
    {
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }
    
    public function insert() {

        $sql = new Sql();
        $result = $sql->select("EXEC sp_usuarios_insert :LOGIN, :PASSWORD;", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
          ));

        if (count($result) > 0) {
            $this->setData($result[0]);
        }
    }


}

?>