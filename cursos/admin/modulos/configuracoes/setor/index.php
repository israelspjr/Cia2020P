<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FuncionarioSetor = new FuncionarioSetor();

$caminhoModulo = CAMINHO_MODULO."configuracoes/setor/";
$caminhoAtualizar = CAMINHO_MODULO."configuracoes/setor/index.php";
$ondeAtualiza = "#centro";
$where = "";
?>

<fieldset>
  <legend>Atribuir funcionarios a setores (refere-se a avisos automaticos)</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo seetor" 
  onclick="abrirNivelPagina(this, '<?php echo $caminhoModulo."formulario2.php"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" 
  onclick="abrirNivelPagina(this, '<?php echo $caminhoModulo."formulario.php"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
          <th>Setor</th>
          <th>Funcionario</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $FuncionarioSetor->selectFuncionarioSetorTr($caminhoModulo, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Setor</th>
          <th>Funcionario</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
