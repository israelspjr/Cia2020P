<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TemaRedacao = new TemaRedacao();
//$NivelEstudoIdioma = new NivelEstudoIdioma();

//FILTROS
$where = " WHERE 1";
$status =  $_POST['status'];
if( $status != '' ) $where .= " AND inativo = ".$status;

/*$idTipoQuestao = $_POST['idTipoQuestao'];
if ($idTipoQuestao != '') {
	if ($idTipoQuestao != '-') {
		$where .= " AND tipoQuestao_idTipoQuestao = ".$idTipoQuestao;
	}
}*/

$idIdioma = $_POST['idIdioma'];
if ($idIdioma != '') {
	if ($idIdioma != '-') {

	$where .= " AND idioma_idIdioma = ".$idIdioma;
		
	}
}
/*
$IdNivelEstudo = $_POST['IdNivelEstudo'];
if ($IdNivelEstudo != '') {
	if ($IdNivelEstudo != '-') {
		$niveis = implode(",",$IdNivelEstudo);

	$where .= " AND nivelEstudo_idNivelEstudo in ( ".$niveis. ")";
		
	}
}
*/
//echo $where;
$caminhoAbrir = CAMINHO_CAD."temaRedacao/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."temaRedacao/index.php";

?>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Novo Tema" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."temaRedacao/formulario.php".$param?>', '<?php echo CAMINHO_CAD."temaRedacao/filtro.php"?>', '#centro')" /> </div>
  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
        <th>ID</th>
        <th>Idioma</th>
        <th>Nivel</th>
          <th>Título</th>
          <th>Tema</th>
          <th>Data de Cadastro</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $TemaRedacao->selectTemaRedacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
      <th>ID</th>
        <th>Idioma</th>
          <th>Nivel</th>
          <th>Título</th>
          <th>Tema</th>
          <th>Data de Cadastro</th>
          <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
</script> 
