<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Prova = new Prova();	

$idPlanoAcaoGrupo = $_GET['id'];
$data = $_GET['data'];
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  --><fieldset>
    <legend>Provas</legend>
    <div class="lista">
      <table id="tb_lista_prova" class="registros">
        <thead>
          <tr>
            <th>Nome</th>
            <th> Nível</th>
            <th>Data prevista</th>
            <th>Data aplicada</th>
           <th>Data validação</th> 
            <th>Notas</th>
          </tr>
        </thead>
        <tbody>
        <?php 		
		echo $Prova->selectProvaTr_grupo("modulos/provas/", "modulos/provas/provasProf.php?id=".$idPlanoAcaoGrupo."&data=".$data, "#provasF", " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo,"", $idPlanoAcaoGrupo,1); // array('data'=>$data));
		?>
        </tbody>
    
      </table>
    </div>
  </fieldset>
</div>
<div id="provasF">
</div>
<script>
//tabelaDataTable('tb_lista_prova','simples');
function zerarProva() {
$('#provasF').html('');	
}
</script>