<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaDataFixa.class.php");

	
$AulaDataFixa = new AulaDataFixa();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
  <legend>Dias de aula Temporária</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/novaAula.php";?>?tipoAula=AF&id=<?php echo $idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/diasDeAula_planoAcaoGrupo.php?id=".$idPlanoAcaoGrupo?>', '#diasDeAula_planoAcaoGrupo');" /> <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="HISTÓRICO DE DIAS" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/aulaDataFixa_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/aulaDataFixa.php?id=".$idPlanoAcaoGrupo?>', '#div_aulaDataFixa');" /> </div>
  <div class="lista">
    <table id="tb_lista_AulaDataFixa" class="registros">
      <?php echo $AulaDataFixa->selectAulaDataFixaTr(" AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo)?>      
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_AulaDataFixa', 'ordenaColuna');
</script>