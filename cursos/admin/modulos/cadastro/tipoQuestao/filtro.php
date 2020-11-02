<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Funcionario.class.php");

$TipoQuestao = new TipoQuestao();
//FILTROS
//$status =  $_POST['status'];
//if( $status != '' ) $where .= "AND inativo = 0 ";
$caminhoAbrir = CAMINHO_CAD."tipoQuestao/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."tipoQuestao/filtro.php";

?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Novo Módulo" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."tipoQuestao/formulario.php".$param?>', '<?php echo CAMINHO_CAD."tipoQuestao/filtro.php"?>', '#centro')" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
           <th>Nome</th>
           <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $TipoQuestao->selectTipoQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "");?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
