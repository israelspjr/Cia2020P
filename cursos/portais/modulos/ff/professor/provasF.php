<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

	
$Prova = new Prova();	

//$idPlanoAcaoGrupo = $_GET['id'];
//echo $idFolhaFrequencia;

?>

<fieldset>
  <legend>Avaliações</legend>
  
    <div class="menu_interno">
    
  <div class="lista">
    <table id="tb_lista_prova2" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Nível</th>
          <th>Data prevista</th>
          <th>Data aplicada</th>
          <th>Data validação</th>
          <th>Notas</th>
          
        </tr>
      </thead>
      <tbody>
        <?php 		
		echo $Prova->selectProvaTr_grupo("modulos/provas/", "modulos/ff/form/folhaFrequencia_abas.php?idFolhaFrequencia=".$idFolhaFrequencia, "#centro", " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo, false,"",1,$idFolhaFrequencia);
		?>        
      </tbody>
    </table>
  </div>
</fieldset>

<script>
//tabelaDataTable('tb_lista_prova2');
</script>