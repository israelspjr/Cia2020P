<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$MedicaoResultado = new MedicaoResultado(); 
$PlanoAcao = new PlanoAcao(); 
$PlanoAcaoMedicaoResultado = new PlanoAcaoMedicaoResultado(); 
	
$idPlanoAcaoMedicaoResultado = $_REQUEST['id'];
$planoAcao_idPlanoAcao = $_REQUEST['idPlanoAcao'];
						
$idNivelEstudo = " SELECT DISTINCT(N.IdNivelEstudo) FROM planoAcao AS PA ";		
$idNivelEstudo .= " INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo ";
$idNivelEstudo .= " WHERE PA.idPlanoAcao = ".$planoAcao_idPlanoAcao;

$idFocoCurso = " SELECT DISTINCT(F.idFocoCurso) FROM planoAcao AS PA ";		
$idFocoCurso .= " INNER JOIN focoCurso AS F ON F.idFocoCurso = PA.focoCurso_idFocoCurso ";
$idFocoCurso .= " WHERE PA.idPlanoAcao = ".$planoAcao_idPlanoAcao;
//	

if($idPlanoAcaoMedicaoResultado != '' && is_numeric($idPlanoAcaoMedicaoResultado)){

	$valor = $PlanoAcaoMedicaoResultado->selectPlanoAcaoMedicaoResultado(" WHERE idPlanoAcaoMedicaoResultado = ".$idPlanoAcaoMedicaoResultado);

	$planoAcao_idPlanoAcao = $valor[0]['planoAcao_idPlanoAcao'];
	$medicaoResultado_idMedicaoResultado= $valor[0]['medicaoResultado_idMedicaoResultado'];		
	$quantidade= $valor[0]['quantidade'];		
		
}

//fks
$idIdioma =  $PlanoAcao->getIdIdioma($planoAcao_idPlanoAcao);

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Medição de resultado</legend>
    <form id="form_PlanoAcaoMedicaoResultado" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="planoAcao_idPlanoAcao" id="planoAcao_idPlanoAcao" class="required" onsubmit="return false" value="<?php echo $planoAcao_idPlanoAcao?>" />
      
      <p>
        <label>Medição de resultados:</label>
        
		<?php
		if($idPlanoAcaoMedicaoResultado != '' && $idPlanoAcaoMedicaoResultado  > 0){
			
			$valorMedicaoResultado = $MedicaoResultado->selectMedicaoResultado(" WHERE idMedicaoResultado = ".$medicaoResultado_idMedicaoResultado);
			echo "<strong>".$valorMedicaoResultado[0]['medicao']."</strong>";
			echo "<input type=\"hidden\" name=\"idMedicaoResultado\" id=\"idMedicaoResultado\" value=\"".$medicaoResultado_idMedicaoResultado."\" />";
			
		}else{?>
        
			
        
			<?php 
            
			$subQuery = " SELECT medicaoResultado_idMedicaoResultado FROM planoAcaoMedicaoResultado WHERE planoAcao_idPlanoAcao = ".$planoAcao_idPlanoAcao;
			$not = " AND idMedicaoResultado NOT IN (".$subQuery.")";
			
            $addQuery = " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma IN(".$idIdioma.")";
            $addQuery .= "	AND INF.nivelEstudo_IdNivelEstudo IN(".$idNivelEstudo.") AND INF.focoCurso_idFocoCurso IN(".$idFocoCurso.")";
            $addQuery .= " INNER JOIN medicaoResultadoINF AS MRINF ON MRINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF ";
            $addQuery .= " 	AND medicaoResultado_idMedicaoResultado = M.idMedicaoResultado ";
                
            echo $MedicaoResultado->selectMedicaoResultadoSelect("required", $idMedicaoResultado, $addQuery, $not);?>
            <span class="placeholder">Campo obrigatório</span>
		
		<?php }?>
        </p>
      
      <p><label>Quantidade por nível:</label>
      <input type="text" name="quantidade" id="quantidade" value="<?php echo $quantidade?>" class="required numeric" maxlength="1"  />
      <span class="placeholder">Campo obrigatório</span> </p>  
      <p>
        <button class="button blue" onclick="postForm('form_PlanoAcaoMedicaoResultado', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/medicaoResultado.php?id=".$idPlanoAcaoMedicaoResultado?>');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script> 


function atualizarQuantidade(){
	
	var idIdioma = '<?php echo $idIdioma?>';
	var idNivelEstudo = '<?php echo $idNivelEstudo?>';
	var idFocoCurso = '<?php echo $idFocoCurso?>';
	var idMedicaoResultado = $('#idMedicaoResultado').val();	

	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/medicaoResultado.php',{acao:"atualizarQuantidade", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso, idMedicaoResultado:idMedicaoResultado}, function(e){	
		$('#quantidade').val(e);
	});
}

$('#form_PlanoAcaoMedicaoResultado #idMedicaoResultado').attr('onchange', 'atualizarQuantidade();');

ativarForm(); 
</script>