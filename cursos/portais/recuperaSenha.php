<?php
$pgaluno = true;
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$msg = 0;
if(isset($_POST)){
    $doc = mysqli_real_escape_string($_POST['documentoUnico']);
    $nasc = mysqli_real_escape_string($_POST['nasc']);
    $senha = mysqli_real_escape_string($_POST['password']);

    if (isset($doc) AND isset($nasc) AND isset($senha)){
        $data = Uteis::gravarData($nasc);
        $senhaAcesso = EncryptSenha::B64_Encode($senha);

        $ClientePf = new ClientePf();
        $rs = $ClientePf->selectClientepf(" WHERE documentoUnico = '".$doc."' AND dataNascimento='".$data."'");
        if($rs){
            $idClientePf = $rs[0]["idClientePf"];
            $nome = $rs[0]["nome"];
            $ClientePf->setIdClientePf($idClientePf);
            $ClientePf->updateFieldClientepf("SenhaAcesso", $senhaAcesso);
            //$emails = $ClientePf->getEmail($idClientePf, 1);
            $msg = 1;
        }
     //   var_dump($rs);
    }
}
$reditectUrl = ($msg==1)? 'login.php?msg=1' : 'recuperaSenhaForm.php?msg=1';
header('location: '.$reditectUrl);