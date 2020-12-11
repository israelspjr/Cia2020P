<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteProposta.class.php");

	$IntegranteProposta = new IntegranteProposta();
	
	$proposta_idProposta = $_GET['id'];
?>

<fieldset>
  <legend>Integrantes da proposta</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."proposta/include/form/integranteProposta.php";?>?idProposta=<?php echo $proposta_idProposta?>', '<?php echo CAMINHO_VENDAS."proposta/include/resourceHTML/integranteProposta.php?id=".$proposta_idProposta?>', '#div_lista_integranteProposta');" /> </div>
  <div class="lista">
    <table id="tb_lista_IntegranteProposta" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $IntegranteProposta->selectIntegrantePropostaTr(" WHERE proposta_idProposta = ".$proposta_idProposta);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_IntegranteProposta', 'simples');</script> 
