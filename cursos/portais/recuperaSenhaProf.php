<?php
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$arrayRetorno = array();
if (isset($_POST)){
    $doc = mysql_real_escape_string($_POST['documentoUnico']);
    $nasc = mysql_real_escape_string($_POST['nasc']);
    $senha = mysql_real_escape_string($_POST['password']);

    if (isset($doc) AND isset($nasc) AND isset($senha)){
        $data = Uteis::gravarData($nasc);
        $senhaAcesso = EncryptSenha::B64_Encode($senha);

        $Professor = new Professor();
        $rs = $Professor->selectProfessor(" WHERE documentoUnico = '".$doc."' AND dataNascimento='".$data."'");
//		Uteis::pr($rs);

        if($rs){
            $idProfessor = $rs[0]["idProfessor"];
            $nome = $rs[0]["nome"];
            $Professor->setIdProfessor($idProfessor);
            $Professor->updateFieldProfessor("senha", $senhaAcesso);
            //$emails = $Professor->getEmail($idProfessor, 1);
            $msg = 1;
        }
    }
		$arrayRetorno['mensagem'] = "Senha alterada com sucesso!";
}

$arrayRetorno['ondeAtualizar'] = "#centro";
$arrayRetorno['pagina'] = "login.php?app=2";	
echo json_encode($arrayRetorno);

//$redirectUrl = "login.php?app=2";
//$reditectUrl = ($msg==1)? 'login.php?msg=1' : 'recuperaSenhaForm.php?msg=1';
//header('location: '.$reditectUrl);
