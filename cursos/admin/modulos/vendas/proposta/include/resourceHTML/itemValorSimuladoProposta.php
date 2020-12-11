<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItemValorSimuladoProposta.class.php");

	$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
	
	$valorSimuladoProposta_idValorSimuladoProposta = $_GET['id'];
?>

<fieldset>
  <legend>Valores simulados </legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/include/form/itemValorSimuladoProposta_abas.php";?>?idValorSimuladoProposta=<?php echo $valorSimuladoProposta_idValorSimuladoProposta?>', '<?php echo CAMINHO_VENDAS."proposta/include/resourceHTML/itemValorSimuladoProposta.php?id=".$valorSimuladoProposta_idValorSimuladoProposta?>', '#div_lista_itemValorSimuladoProposta');" /> </div>
  <div class="lista">
    <table id="tb_lista_ItemValorSimuladoProposta" class="registros">
      <thead>
        <tr>
          <th>Valor</th>
          <th>Horas</th>
          <th>Frequencia semanal</th>
          <th>Adicionais (por hora)</th>
          <th>Tipo</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ItemValorSimuladoProposta->selectItemValorSimuladoPropostaTr(" WHERE valorSimuladoProposta_idValorSimuladoProposta = ".$valorSimuladoProposta_idValorSimuladoProposta);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Valor</th>
          <th>Horas</th>
          <th>Frequencia semanal</th>
          <th>Adicionais (por hora) </th>
          <th>Tipo</th>
          <th>Total</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_ItemValorSimuladoProposta');</script> 
