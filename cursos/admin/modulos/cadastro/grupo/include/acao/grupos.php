<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Grupo = new Grupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$IntegranteGrupo = new IntegranteGrupo();
$GrupoPj = new GrupoClientePj();
$ClientePf = new ClientePf();

$arrayRetorno = array();
$acao = $_POST['acao'];
if($acao == "mudarNome"){
$idGrupo = $_POST['idGrupo'];
$nome = $_POST['nome'];
$rsNome = $Grupo->selectGrupo("WHERE nome ='".$nome."'");
    if($rsNome[0]['nome']==""){    
        $Grupo->setIdGrupo($idGrupo);
        $Grupo->updateFieldGrupo('nome', $nome);
        $arrayRetorno['mensagem'] = MSG_CADATU;
        $arrayRetorno['fecharNivel'] = true;
    }else{
        $arrayRetorno['mensagem'] = "Nome Indisponivel";
    }    
}else{
  $idGrupo = $_POST['idGrupo'];
  $idProposta = $_POST['idProposta'];
  $idClientePj_atual = $_POST['idClientePj_atual'];
  $idClientePj = $_POST['clientePj_idClientePj'];
  $idPlanoAcaoGrupo = $_POST['idPlanoAcaoGrupo'];
  $gp = $GrupoPj->selectGrupoClientePj("WHERE grupo_idGrupo = ".$idGrupo);
  if($gp[0]['idGrupoClientePj']!=""){
      
      $GrupoPj->setIdGrupoClientePj($gp[0]['idGrupoClientePj']);
      $GrupoPj->updateFieldGrupoClientePj("clientePj_idClientePj", $idClientePj);
      
      $Proposta->setIdProposta($idProposta);
      $Proposta->updateFieldProposta("clientePj_idClientePj", $idClientePj);
      
      $rsInteg = $IntegranteGrupo->selectIntegranteGrupo("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
      if(count($rsInteg) > 0){
        for($i=0;$i<count($rsInteg);$i++){
            $ClientePf->setIdClientePf($rsInteg[$i]['clientePf_idClientePf']);
            $ClientePf->updateFieldClientepf("clientePj_idClientePj",$idClientePj);
        }
      }
        $arrayRetorno['mensagem'] = "Troca Efetuada com sucesso";
        $arrayRetorno['fecharNivel'] = true;
  }else{
      $arrayRetorno['mensagem'] = "Erro de Processamento";
  }
}

echo json_encode($arrayRetorno);

?>