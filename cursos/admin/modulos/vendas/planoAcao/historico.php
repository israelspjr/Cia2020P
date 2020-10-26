<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Planos de ação excluídos</legend>
  </fieldset>
  <div class="lista">
    <table id="tb_lista_PlanoAcao_hist" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Id</th>
          <th>Idioma</th>
          <th>PJ</th>
        </tr>
      </thead>
      <tbody>
        <?php 			
			echo $PlanoAcao->selectPlanoAcaoTr_hist();?>
      </tbody>
      <tfoot>
        <tr>
        	<th></th>
          <th>Id</th>
          <th>Idioma</th>
          <th>PJ</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<script>
	tabelaDataTable('tb_lista_PlanoAcao_hist', 'ordenaColuna');
</script> 
