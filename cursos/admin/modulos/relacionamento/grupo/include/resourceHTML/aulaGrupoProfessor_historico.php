<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$AulaGrupoProfessor = new AulaGrupoProfessor();	

$idAulaDataFixa = $_GET['idAulaDataFixa'];
$idAulaPermanenteGrupo = $_GET['idAulaPermanenteGrupo'];

if($idAulaDataFixa) $where = " AND aulaDataFixa_idAulaDataFixa = ".$idAulaDataFixa;

if($idAulaPermanenteGrupo) $where = " AND aulaPermanenteGrupo_idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo;

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Historico de professores do dia</legend>
    <div class="lista">
      <table id="tb_lista_AulaGrupoProfessor_historico" class="registros">
        <thead>
          <tr>
            <th>Professor</th>
            <th>Incio</th>
            <th>Saida</th>
            <th>Motivo</th>
            <th>Sub-Motivo</th>
            <th>Valor hora</th>
          </tr>
        </thead>
        <tbody>
        <?php 
		echo $AulaGrupoProfessor->selectAulaGrupoProfessorTr_historico($where)?>
        </tbody>
        <tfoot>
          <tr>
            <th>Professor</th>
            <th>Incio</th>
            <th>Saida</th>
           <th>Motivo</th>
           <th>Sub-Motivo</th>
           <th>Valor hora</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
</div>
<script>
tabelaDataTable('tb_lista_AulaGrupoProfessor_historico');
</script>