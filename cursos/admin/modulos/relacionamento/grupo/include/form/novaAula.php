<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
    
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$idPlanoAcaoGrupo = $_REQUEST['id'];    
$tipoAula = $_REQUEST['tipoAula'];
$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$atualizar = $_REQUEST['atualizar'];

if ($atualizar == 1) {
$rs = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);
$diaSemana = $rs[0]['diaSemana'];
$horaInicio = Uteis::exibirHoras($rs[0]['horaInicio']);
$horaFim = Uteis::exibirhoras($rs[0]['horaFim']);
$obs = $rs[0]['obs'];
$dataInicio = Uteis::exibirData($rs[0]['dataInicio']);
$dataFim = Uteis::exibirData($rs[0]['dataFim']);
$idLocalAula = $rs[0]['localAula_idLocalAula'];
$idEndereco = $rs[0]['endereco_idEndereco'];	
	
	
}

?>
<div id="cadastro_Grupo" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    
    <div id="aba_div_AP" divExibir="div_AP" class="aba_interna <?php echo ($tipoAula == "AP") ? "ativa" : ""?>">Aulas permanentes</div>
    <div id="aba_div_AF" divExibir="div_AF" class="aba_interna <?php echo ($tipoAula == "AF") ? "ativa" : ""?>">Aulas fixas</div>
    
  </div>
  <div id="modulos_Grupo" class="conteudo_nivel">
    <div id="div_AP" class="div_aba_interna" <?php echo $tipoAula == "AF" ? "style=\"display:none;\"" : ""?> >
      <?php require_once "aulaPermanenteGrupo.php" ?>
    </div>
    <div id="div_AF" class="div_aba_interna" <?php echo $tipoAula == "AP" ? "style=\"display:none;\"" : ""?> >
      <?php require_once "aulaDataFixa.php" ?>
    </div>
  </div>
</div>
