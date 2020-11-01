<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Questao = new Questao();
$NivelEstudoIdioma = new NivelEstudoIdioma();

$idQuestao = $_GET['id'];	

if ($idQuestao > 0 ) {
	$where = " WHERE questao_IdQuestao = ".$idQuestao;
}
	

//echo $where;
$caminhoAbrir = CAMINHO_CAD."questoes/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."questoes/index.php";

?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Questão" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."questoes/formulario2.php".$param?>', '<?php echo CAMINHO_CAD."questoes/filtro.php"?>', '#centro')" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
        <th>ID</th>
        <th>Tipo</th>
          <th>Titulo</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Questao->selectQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, 1, 1, 1);?>
      </tbody>
      <tfoot>
        <tr>
       <th>ID</th>
        <th>Tipo</th>
           <th>Titulo</th>
         <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
