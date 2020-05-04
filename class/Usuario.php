<?php 

class Usuario{
	private $idusuarios;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;


	public function getIdusuario(){
		return $this->idusuarios;
	}

	public function setIdusuario($value){
		$this->idusuarios = $value;
	}

public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}


	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadByid($id){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuarios = :ID", array(":ID"=>$id));

		if(count($results) > 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuarios']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

			}
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($Login){
		
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$Login."%"
		));

	}

	public function login($Login, $password){
		
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$Login,
					":PASSWORD"=>$password));

		if(count($results) > 0){

			$row = $results[0];

			$this->setIdusuario($row['idusuarios']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
		else {
			throw new Exception("Login e/ou senha invalidos.");
			
		}
	}
	public function __toString(){

		return json_encode(array(
			"idusuarios"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()
		));
	}

}


 ?>