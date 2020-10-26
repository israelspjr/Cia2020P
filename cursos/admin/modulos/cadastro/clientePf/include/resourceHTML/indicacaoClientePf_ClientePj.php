<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IndicacaoClientePf.class.php");

	$Indicacaoclientepj = new IndicacaoClientePf();
	
	$idClientePf = $_GET['id'];
?>
<fieldset>
  <legend>Cliente pessoa jurídica indicadas</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/include/form/indicacaoClientePf.php?id=".$idClientePf?>&clientePjIdClientePjIndicado=1', '<?php echo CAMINHO_CAD."clientePf/include/resourceHTML/indicacaoClientePf_ClientePj.php?id=".$idClientePf?>', '#div_indicacaoClientePf_ClientePj');" /> </div>
 
 <table id="tb_lista_indicacaoClientePj" class="registros">
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
    <?php echo $Indicacaoclientepj->selectIndicacaoclientepfTr(CAMINHO_CAD."clientePf/include/resourceHTML/indicacaoClientePf_ClientePj.php?id=".$idClientePf, "#div_indicacaoClientePf_ClientePj", "WHERE clientePj_idClientePjIndicado IS NOT NULL AND clientePf_idClientePf = ".$idClientePf);?>
  </tbody>
  <tfoot>
    <tr>
       <th>Nome</th>
       <th>Produto</th>
       <th>Interno</th>
       <th>Externo</th>
            <th>Potencial</th>
       <th>Influência</th>
 
       <th></th>
    </tr>
  </tfoot>
</table>
</fieldset>
<script> tabelaDataTable('tb_lista_indicacaoClientePj');</script> 