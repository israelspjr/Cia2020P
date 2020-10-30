<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$AulaPermanenteGrupo = new AulaPermanenteGrupo();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
  <legend>Dias de aula permanente</legend>
  <div style="font-weight:bold;font-weight: bold;
    width: 91%;
    float: left;">Para alterar um dia e horas de aula clique acima do DIA, se precisar remover o professor faça isso na coluna professor e se precisar alterar os dois itens, melhor excluir esse registro na última coluna X e incluir uma nova data.</div><div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/novaAula.php";?>?tipoAula=AP&id=<?php echo $idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/diasDeAula_planoAcaoGrupo.php?id=".$idPlanoAcaoGrupo?>', '#diasDeAula_planoAcaoGrupo');" /> <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="HISTÓRICO DE DIAS" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/aulaPermanenteGrupo_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/aulaPermanenteGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_aulaPermanenteGrupo');" /> </div>
  <div class="lista">
    <table id="tb_lista_AulaPermanenteGrupo" class="registros">
      <?php 
		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
		" AND (dataFim > CURDATE() OR dataFim IS NULL OR dataFim = '') ";		
		
		echo $AulaPermanenteGrupo->selectAulaPermanenteGrupoTr($where)?>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_AulaPermanenteGrupo', 'simples');
</script>