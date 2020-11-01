<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Questao = new Questao();
$NivelEstudoIdioma = new NivelEstudoIdioma();

//FILTROS
$status =  $_POST['status'];
$where = " WHERE 1 ";
if( $status != '' ) $where .= " AND inativo = 0 ";

$idTipoQuestao = $_POST['idTipoQuestao'];
if ($idTipoQuestao != '') {
	if ($idTipoQuestao != '-') {
		$where .= " AND tipoQuestao_idTipoQuestao = ".$idTipoQuestao;
	}
}

$idIdioma = $_POST['idIdioma'];
if ($idIdioma != '') {
	if ($idIdioma != '-') {

	$where .= " AND idioma_idIdioma = ".$idIdioma;
		
	}
}

$IdNivelEstudo = $_POST['IdNivelEstudo'];
if ($IdNivelEstudo != '') {
//	if ($IdNivelEstudo != '-') {
//		$niveis = implode(",",$IdNivelEstudo);

	$where .= " AND nivelEstudo_idNivelEstudo in ( ".$IdNivelEstudo. ")";
		
//	}
}

$dependentes = ( $_REQUEST['dependentes'] == "1" ? 1 : 0);

if ($dependentes != 1) {
	$where .= " AND questao_IdQuestao is null";
}

$idFocoCurso = $_REQUEST['idFocoCurso'];
if ($idFocoCurso != '-') {
	if ($idFocoCurso != '') {
			$where .= " AND idFocoCurso =".$idFocoCurso;
	}
}

$idKitMaterial = $_REQUEST['idKitMaterial'];
 if ($idKitMaterial != '') {
	 if ($idKitMaterial != '-') {
		 $where .= " AND idKitMaterial = ".$idKitMaterial;
	 }
 }


//echo $where;
$caminhoAbrir = CAMINHO_CAD."questoes/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."questoes/filtro.php";

?>

  <div id="lista_funcionario" class="lista">
    <table id="tb_lista_funcionario" class="registros">
      <thead>
        <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Idioma</th>
          <th>Nível</th>
          <th>Titulo</th>
          <th>Enunciado</th>
          <th>Imagem</th>
          <th>Áudio</th>
          <th>Categoria</th>
          <th>Sub-Categoria</th>
          <th>Tempo</th>
          <th>Data de Cadastro</th>
          <th>Questão-Pai</th>
          <th>Status</th>
          <th></th>
          <td>Ação</td>
        </tr>
      </thead>
      <tbody>
        <?php echo $Questao->selectQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, '', 0);?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
           <th>Idioma</th>
          <th>Nível</th>
          <th>Titulo</th>
          <th>Enunciado</th>
          <th>Imagem</th>
          <th>Áudio</th>
          <th>Categoria</th>
          <th>Sub-Categoria</th>
          <th>Tempo</th>
          <th>Data de Cadastro</th>
          <th>Questão-Pai</th>
          <th>Status</th>
          <th></th>
          <td>Ação</td>
        </tr>
      </tfoot>
    </table>
  </div>
<script>
	tabelaDataTable('tb_lista_funcionario');
	
	function copiarRegistro(x) {
		var y  = confirm("Deseja copiar essa questão? ");
			
			if	(y == true) {
			//	  showLoad();
                $.post( '<?php echo CAMINHO_CAD?>questoes/copiarQuestao.php',
                    {
                        idQuestao: x
						
                    }, function(e){
              //      fecharNivel_load();
                    acaoJson(e);
					carregarModulo('/cursos/admin/modulos/cadastro/questoes/filtro.php', '#centro');
                });
		}
		
		
	}
	
</script> 
