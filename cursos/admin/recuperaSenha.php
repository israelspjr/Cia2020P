<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
error_reporting(E_ALL);
$msg = 0;
if(isset($_POST)){
    $doc = $_POST['documentoUnico'];
    $nasc = $_POST['nasc'];
    $senha = $_POST['password'];

    if (isset($doc) AND isset($nasc) AND isset($senha)){
        $data = Uteis::gravarData($nasc);
        $senhaAcesso = EncryptSenha::B64_Encode($senha);

        $Funcionario = new Funcionario();
        $rs = $Funcionario->selectFuncionario(" WHERE documentoUnico = '".$doc."' AND dataNascimento='".$data."'");
        if($rs){
            $idFuncionario = $rs[0]["idFuncionario"];
            $nome = $rs[0]["nome"];
            $Funcionario->setIdFuncionario($idFuncionario);
            $Funcionario->updateFieldFuncionario("SenhaAcesso", $senhaAcesso);
            //$emails = $ClientePf->getEmail($idClientePf, 1);
            $msg = 1;
        }
 //       var_dump($rs);
    }
	$arrayRetorno['mensagem'] = "Senha alterada com sucesso! Clique voltar para fazer o login";
}
//$reditectUrl = ($msg==1)? 'login.php?msg=1' : 'recuperaSenhaForm.php?msg=1';
//header('location: '.$reditectUrl);
echo json_encode($arrayRetorno);