<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BancoHoras = new BancoHoras();

$arrayRetorno = array();
$idBancoHoras = $_REQUEST['id'];
$arr_ids = explode(',', $idBancoHoras);
foreach($arr_ids as $id){
    $BancoHoras -> setIdBancoHoras($id);

    if ($_POST['acao'] == "deletar") {

        /*$BancoHoras -> setIdBancoHoras($idBancoHoras);
         $BancoHoras -> deleteBancoHoras();
         $arrayRetorno['mensagem'] = MSG_CADDEL;*/

    } else {

        if ($id) {

            $BancoHoras -> updateFieldBancoHoras("dataExpira", Uteis::gravarData($_POST['dataExpira']));
            $arrayRetorno['mensagem'] = MSG_CADATU;
            $arrayRetorno['fecharNivel'] = true;

        } else {

            $arrayRetorno['mensagem'] = "Não foi possível alterar a validade.";

        }

    }
}
echo json_encode($arrayRetorno);