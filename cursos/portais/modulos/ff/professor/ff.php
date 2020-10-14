<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$FolhaFrequencia = new FolhaFrequencia();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();

$idPlanoAcaoGrupo = $_GET['id'];
$idProfessor = $_SESSION['idProfessor_SS'];
$NDados = $_GET['Ndados'];
$Professor = new Professor();

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);

$valor = $PlanoAcaoGrupo->getPAG_total($idGrupo);

$valorIds = "";

foreach ($valor as $valor2) {

$valorIds .= $valor2['idPlanoAcaoGrupo'].", ";	
	
}

$valorIds .= "0"; 

$add = "WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorIds.") ORDER BY idFolhaFrequencia DESC";


?>
	<fieldset>
		<legend>
			Folhas de frequência
		</legend>
      <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
      <p>Professor: <strong><?php echo $Professor->getNome($idProfessor)?></strong></p>    

		<div class="lista">
			<table id="tb_lista_FolhaFrequencia" class="registros">
				<thead>
					<tr>
				<!--		<th></th>
					-->	<th>Período</th>
						<th>Finalizada</th>
						<th>Finalizada [financeiro]</th>
					</tr>
				</thead>
				<tbody>
					<?php
$caminhoAbrir = "modulos/ff/professor/folhaFrequencia_abas.php";
$caminhoAtualizar = "modulos/ff/professor/ff.php?id=".$idPlanoAcaoGrupo;
$ondeAtualiza = "";

echo $FolhaFrequencia->selectFolhaFrequenciaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $idPlanoAcaoGrupo, $idProfessor,$add, $Ndados,1)
					?>
				</tbody>
			</table>
            <div style="width: 100%;;overflow: hidden;">
                <a onclick="eventRolarParaTopo();" class="button gray" style="float: right; display: block;margin-right:40px">Topo</a>
            </div>
		</div>
	</fieldset>
<script>//tabelaDataTable('tb_lista_FolhaFrequencia', 'ordenaColuna');</script>