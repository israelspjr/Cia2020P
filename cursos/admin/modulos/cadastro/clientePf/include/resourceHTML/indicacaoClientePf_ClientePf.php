<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	$IndicacaoClientePf = new IndicacaoClientePf();
	
	$idClientePf = $_GET['id'];
?>
<fieldset>
  <legend>Cliente pessoa física indicados</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/form/indicacaoClientePf.php?id=".$idClientePf?>&clientePfIdClientePfIndicado=1', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/indicacaoClientePf_ClientePf.php?id=".$idClientePf?>', '#div_indicacaoClientePf_ClientePf');" /> </div>
 
 <table id="tb_lista_indicacaoClientePf" class="registros">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Produto</th>
       <th>Interno</th>
       <th>Externo</th>
       <th>Potencial</th>
       <th>influência</th>
       <th></th>
 
    </tr>
  </thead>
  <tbody>
    <?php echo $IndicacaoClientePf->selectIndicacaoclientepfTr(CAMINHO_CAD."clientePf/include/resourceHTML/indicacaoClientePf_ClientePf.php?id=".$idClientePf, "#div_indicacaoClientePf_ClientePf", "WHERE clientePf_idClientePfIndicado IS NOT NULL AND  clientePf_idClientePf = ".$idClientePf);?>
  </tbody>
  <tfoot>
    <tr>
       <th>Nome</th>
       <th>Produto</th>
       <th>Interno</th>
       <th>Externo</th>
       <th>Potencial</th>
       <th>influência</th>
       <th></th>
    </tr>
  </tfoot>
</table>
</fieldset>
<script> tabelaDataTable('tb_lista_indicacaoClientePf');</script> 