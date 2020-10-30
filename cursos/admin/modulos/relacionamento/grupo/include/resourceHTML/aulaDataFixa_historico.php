<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaDataFixa.class.php");

	
$AulaDataFixa = new AulaDataFixa();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Historico de dias de aula fixa</legend>
    <div class="lista">
      <table id="tb_lista_AulaDataFixa_historico" class="registros">
        <thead>
          <tr>
            <th>Dia</th>
            <th>Dia</th>
            <th>Hora Incio</th>
            <th>Hora Fim</th>
            <th>Histórico professor</th>
          </tr>
        </thead>
        <tbody>
        <?php 
		echo $AulaDataFixa->selectAulaDataFixaTr_historico("AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo)?>
        </tbody>
        <tfoot>
          <tr>
            	<th>Dia</th>
            	<th>Dia</th>
             <th>Hora Incio</th>
            <th>Hora Fim</th>
            <th>Histórico professor</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
</div>
<script>
tabelaDataTable('tb_lista_AulaDataFixa_historico', 'ordenaColuna');
</script>