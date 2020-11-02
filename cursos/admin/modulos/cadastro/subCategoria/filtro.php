<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$SubCategoria = new SubCategoria();

//echo $where;
$caminhoAbrir = CAMINHO_CAD."subCategoria/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."subCategoria/filtro.php";

?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Questão" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."subCategoria/formulario.php".$param?>', '<?php echo CAMINHO_CAD."subCategoria/filtro.php"?>', '#centro')" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Descrição</th>
         <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $SubCategoria->selectSubCategoriaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "");?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
         <th>Categoria</th>
         <th>Descrição</th>
        <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
