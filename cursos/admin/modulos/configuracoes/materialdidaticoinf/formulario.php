<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidaticoINF.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MaterialDidatico.class.php");
	
	
	$MaterialDidaticoINF = new MaterialDidaticoINF();
	$MaterialDidatico = new MaterialDidatico();
	$RelacionamentoINF = new RelacionamentoINF();
		
$idMaterialDidaticoINF = $_REQUEST['id'];

if($idMaterialDidaticoINF != '' && $idMaterialDidaticoINF  > 0){

	$valor = $MaterialDidaticoINF->selectMaterialDidaticoINF('WHERE idMaterialDidaticoINF='.$idMaterialDidaticoINF);
	
	$idMaterialDidaticoINF = $valor[0]['idMaterialDidaticoINF'];
		 $relacionamentoINF_idRelacionamentoINF = $valor[0]['relacionamentoINF_idRelacionamentoINF'];
		 $materialDidatico_idMaterialDidatico = $valor[0]['materialDidatico_idMaterialDidatico'];
		 $unidadeInicial = $valor[0]['unidadeInicial'];
		 $unidadeFinal = $valor[0]['unidadeFinal'];
		 $inativo = $valor[0]['inativo'];
		 $obs = $valor[0]['obs'];
		 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Material Didático I.N.F.</legend>
    <form id="form_MaterialDidaticoINF" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idMaterialDidaticoINF ?>" />
				<p>
				<label>Relacionamento I.N.F.:</label>
                <?php echo $RelacionamentoINF->selectRelacionamentoINFSelect("required", $relacionamentoINF_idRelacionamentoINF, " WHERE R.inativo = 0 AND R.excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Material Didático:</label>
                <?php echo $MaterialDidatico->selectMaterialDidaticoSelect("required", $materialDidatico_idMaterialDidatico, " WHERE M.inativo = 0 AND M.excluido = 0"); ?>

				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Unidade Inicial:</label>
				<input type="text" name="unidadeInicial" id="unidadeInicial" class="required" value="<?php echo $unidadeInicial?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Unidade Final:</label>
				<input type="text" name="unidadeFinal" id="unidadeFinal" class="required" value="<?php echo $unidadeFinal?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
	  
        <button class="button blue" onclick="postForm('form_MaterialDidaticoINF', '<?php echo CAMINHO_MODULO?>configuracoes/materialdidaticoinf/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

