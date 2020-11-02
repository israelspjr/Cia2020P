<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Questao = new Questao();
$NivelEstudoIdioma = new NivelEstudoIdioma();
$ProvaOnQuestoes = new ProvaOnQuestoes();

//FILTROS

$idProva = $_REQUEST['idProva'];
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

$idFocoCurso = $_POST['idFocoCurso'];
if ($idFocoCurso != '') {
	$where .= " AND idFocoCurso =  ".$idFocoCurso. "";
}

$idKitMaterial = $_POST['idKitMaterial'];
if ($idKitMaterial != '') {
	$where .= " AND idKitMaterial =  ".$idKitMaterial. "";
}


$dependentes = ( $_REQUEST['dependentes'] == "1" ? 1 : 0);

if ($dependentes != 1) {
	$where .= " AND questao_IdQuestao is null";
}

$valorQuestoes = $ProvaOnQuestoes->selectProvaOnQuestoes(" WHERE provaOn_idProvaOn =".$idProva ." AND excluido = 0 AND inativo = 0");

$ids ="";
foreach ($valorQuestoes as $valor) {
	$ids .= $valor['questao_idQuestao'].",";
	
}
$ids .="0";

$where .= " AND idQuestao NOT IN (".$ids.")";

//echo $where;
$caminhoAbrir = CAMINHO_CAD."questoes/formulario.php";
$ondeAtualiza = "#centro";
$caminhoAtualizar = CAMINHO_CAD."questoes/filtro.php";

?>
<div style="width:100%">
<button onclick="selecionarQuestoes()" class="blue button" value="Gravar">Selecionar todas</button>

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
      <!--    <td>Ação</td>-->
        </tr>
      </thead>
      <tbody>
        <?php echo $Questao->selectQuestaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, "",1, 1);?>
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
<!--          <td>Ação</td>-->
        </tr>
      </tfoot>
    </table>
  </div>
  </div>
  <button onclick="gravarQuestoes()" class="blue button" value="Gravar">Gravar questões</button>
  
<script>
	tabelaDataTable('tb_lista_funcionario');
	
	function selecionarQuestoes() {
		$("input[type=checkbox][name='questoes[]']").each(
        function() {
            if ($(this).prop("checked")) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        
    });
}
	
	function gravarQuestoes() {
		var y  = confirm("Deseja cadastrar essas questões? ");
			
			if	(y == true) {
				
				var idProva = '<?php echo $idProva?>';
				
			camposMarcados = new Array();
				$("input[type=checkbox][name='questoes[]']:checked").each(function(){
    			camposMarcados.push($(this).val());
			});
			
			alert(camposMarcados);
				
			//	  showLoad();
                $.post( '<?php echo CAMINHO_REL?>provas/gravaQuestoes.php',
                    {
                        idQuestao: camposMarcados,
						idProva: idProva
						
                    }, function(e){
              //      fecharNivel_load();
                    acaoJson(e);
			//		carregarModulo('/cursos/admin/modulos/cadastro/questoes/filtro.php', '#centro');
                });
		}
		
		
	}
	
</script> 
