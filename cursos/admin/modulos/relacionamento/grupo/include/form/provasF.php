<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
$Prova = new Prova();	

//$idPlanoAcaoGrupo = $_GET['id'];

?>

<fieldset>
  <legend>Provas</legend>
  
 <!--   <div class="menu_interno">
    <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar Prova" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/provas.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/provas.php?id=$idPlanoAcaoGrupo"?>', '#div_provas_grupo');" /></div>-->
    
  <div class="lista">
    <table id="tb_lista_prova2a" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Nível</th>
          <th>Data prevista</th>
          <th>Data aplicada</th>
          <th>Data validação</th>
          <th>Notas</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 		
		echo $Prova->selectProvaTr_grupo(CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/form/provasF.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo, "#div_provas_grupo2a", " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo, true, $idPlanoAcaoGrupo);
		?>        
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Nível</th>
          <th>Data prevista</th>
          <th>Data aplicada</th>
          <th>Data validação</th>
          <th>Notas</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
 </div>
</fieldset>

<script>
tabelaDataTable('tb_lista_prova2a', 'simples');
</script>