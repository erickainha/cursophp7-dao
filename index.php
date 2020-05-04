<?php 

require_once("config.php");
//$sql = new Sql();

//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);
//carrega um ususario
//$root = new usuario();
//$root->loadbyId(2);
///echo $root;


//carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//CARREGA UMA  LISTA DE USUARIOS BUSCANDO PELO LOGIN
//$search = Usuario::search("ro");
//echo json_encode($search);

//carrega usuario usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("root", "123456");
//echo $usuario;

//CRIANDO UM NOVO USUARIO
//$aluno = new Usuario("aluno", "0225");
//$aluno->insert();
//echo $aluno;

$usuario = new Usuario();
$usuario->loadbyId(6);
$usuario->update("professor", "jdjnmr");

echo $usuario;

 ?>