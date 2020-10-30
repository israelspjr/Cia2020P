<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$AcompanhamentoCurso = new AcompanhamentoCurso();	

$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
  <legend>Acompanhamento</legend>
  <div class="lista">
    <table id="tb_lista_acompanhamento" class="registros">
      <thead>
        <tr>
          <th>Período</th>
          <th>Professor</th>          
          <th>Finalizada [profesor]</th>
          <th>Finalizada [adm]</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
		$caminhoAbrir = CAMINHO_REL."grupo/include/resourceHTML/itemAcompanhamento.php";
		$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/acompanhamento.php?id=".$idPlanoAcaoGrupo;
		$ondeAtualiza = "#div_acompanhamento_grupo";
		$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
		
		//lista deacordo os perioso
		echo $AcompanhamentoCurso->selectAcompanhamentoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPlanoAcaoGrupo, true);
		?>
        
      </tbody>
      <tfoot>
        <tr>
          <th>Período</th>
          <th>Professor</th>          
          <th>Finalizada [profesor]</th>
          <th>Finalizada [adm]</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_acompanhamento');
</script>