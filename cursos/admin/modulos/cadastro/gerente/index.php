<?php  
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Gerente.class.php");

	$Gerente = new Gerente();

?>
<fieldset>
  <legend>Cadastro de responsável por gerenciamento de grupo</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gerente/cadastro.php";?>', '<?php echo CAMINHO_CAD."gerente/index.php";?>', '#centro');" /> </div>
  <div id="div_lista_gerente" class="lista">
    <table id="tb_lista_gerente" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cor</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Gerente->selectGerenteTr();?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Cor</th>
          <th>Status</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
	tabelaDataTable('tb_lista_gerente');
</script> 
