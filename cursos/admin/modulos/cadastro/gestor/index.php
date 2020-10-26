<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Gestor.class.php");

	$Gestor = new Gestor();

?>

<fieldset>
  <legend>Cadastro de gestor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."gestor/cadastro.php";?>', '<?php echo CAMINHO_CAD."gestor/index.php";?>', '#centro');" /></div>
  <div id="lista_gestor" class="lista">
    <table id="tb_lista_gestor" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Ativo</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Gestor->selectGestorTr();?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Ativo</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
	tabelaDataTable('tb_lista_gestor');
</script> 
