<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$grupo = $PlanoAcaoGrupo -> getNomeGrupo($idPlanoAcaoGrupo);
?>
<div id="div_lista_psa" class="lista">
<!--<div id="div_lista_psa" class="lista">
<div class="conteudo_nivel" style="z-index:2002;">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  -->
  <fieldset>
    <legend>Pesquisas de satisfação</legend>
    <p>Grupo: <strong><?php echo $grupo?></strong></p>
    <div id="lista_psa" class="lista">
      <table id="tb_psa" class="registros">
        <thead>
        <!--  <th></th>-->
							<th>Data de referencia</th>
							<th>Descrição</th>
							<th>Finalizado</th>
							<th>Respostas</th>
        </thead>
 
        <tbody>
        <?php
				$caminhoAbrir =  "modulos/psa/perguntasPsa.php";
				$caminhoAtualizar =  "modulos/psa/psa.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo";
				$ondeAtualiza = "";

	//	$sql = "SELECT idIntegranteGrupo, dataEntrada, envioPsa FROM integranteGrupo WHERE clientePf_idClientePf = ". $_SESSION['idClientePf_SS']. " AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
	//	$rs = Uteis::executarQuery($sql);
	//	$idIntegranteGrupo = $rs[0]['idIntegranteGrupo'];
	echo $PsaIntegranteGrupo -> selectPsaIntegranteAlunoTr("", 1,1, $_SESSION['idClientePf_SS']);
//selectPsaIntegranteGrupoTr
	?>
        </tbody>
      </table>
    </div>
  </fieldset>
</div>
<!--</div>
</div>-->
<script>//tabelaDataTable('tb_psa');</script> 
