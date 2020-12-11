<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorSimuladoProposta.class.php");

	$ValorSimuladoProposta = new ValorSimuladoProposta();
	
	$proposta_idProposta = $_GET['id'];
?>

<fieldset>
  <legend>Valores simulados </legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/include/form/valorSimuladoProposta.php";?>?idProposta=<?php echo $proposta_idProposta?>', '<?php echo CAMINHO_VENDAS."proposta/include/resourceHTML/valorSimuladoProposta.php?id=".$proposta_idProposta?>', '#div_lista_ValorSimuladoProposta');" /> </div>
  <div class="lista">
    <table id="tb_lista_ValorSimuladoProposta" class="registros">
      <thead>
        <tr>
          <th>Opção escolhida</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $ValorSimuladoProposta->selectValorSimuladoPropostaTr(" WHERE proposta_idProposta = ".$proposta_idProposta);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Opção escolhida</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> 

function gravaOpcaoValorSimuladoProposta(){
	var idValorSimuladoProposta = $('input[name=radio_ValorSimuladoProposta]:checked').val();
	$.post('<?php echo CAMINHO_VENDAS?>proposta/include/acao/valorSimuladoProposta.php', { acao:"gravaOpcaoValorSimuladoProposta", id:idValorSimuladoProposta}, function(e){
		acaoJson(e);
	});
}

tabelaDataTable('tb_lista_ValorSimuladoProposta', 'simples');

</script> 
