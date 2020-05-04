<?php 

class Usuario{
	private $idusuarios;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;


	public function getIdusuarios(){
		return $this->idusuarios;
	}

	public function setIdusuarios($value){
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

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuarios = :ID", array(" :ID"=>$id));

		if(count($results) > 0){

			$this->setData($results[0]);
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

			$this->setData($results[0]);
		}
		else {
			throw new Exception("Login e/ou senha invalidos.");
			
		}
	}

	public function setData($data)
	{
			$this->setIdusuarios($data['idusuarios']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}
	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_ususarios_insert( :LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}

	}

	public function update($Login, $password){

		$this->setDeslogin($Login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha= :PASSWORD WHERE idusuarios = :ID", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuarios()
		));
	}

	public function __construct($Login = "", $password = ""){

		$this->setDeslogin($Login);
		$this->setDessenha($password);
	}

	public function __toString(){

		return json_encode(array(
			"idusuarios"=>$this->getIdusuarios(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()
		));
	}

}


 ?>