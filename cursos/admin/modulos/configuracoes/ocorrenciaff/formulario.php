<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");


$OcorrenciaFF = new OcorrenciaFF();
		
$idOcorrenciaFF = $_REQUEST['id'];

if($idOcorrenciaFF != '' && $idOcorrenciaFF  > 0){

	$valor = $OcorrenciaFF->selectOcorrenciaFF('WHERE idOcorrenciaFF='.$idOcorrenciaFF);
	
	//$idOcorrenciaFF = $valor[0]['idOcorrenciaFF'];
	 $sigla = $valor[0]['sigla'];
	 $decricaoSigla = $valor[0]['decricaoSigla'];
	 $obs = $valor[0]['obs'];
	 $inativa = $valor[0]['inativa'];
	 $pagarProfessor = $valor[0]['pagarProfessor'];
	 $reporAula = $valor[0]['reporAula'];
	 $professorVe = $valor[0]['professorVe'];
	 $adminVe = $valor[0]['adminVe'];
     $expira = $valor[0]['expira'];
     $pagarReposicao = $valor[0]['pagarReposicao'];  
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Ocorrência F.F.</legend>
    <form id="form_OcorrenciaFF" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idOcorrenciaFF ?>" />
      <p>
        <label for="inativa">Inativa</label>
        <input type="checkbox" name="inativa" id="inativa" value="1" <?php if($inativa != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="pagarProfessor">Pagar Professor</label>
        <input type="checkbox" name="pagarProfessor" id="pagarProfessor" value="1" <?php if($pagarProfessor != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="reporAula">Repor Aula</label>
        <input onchange="Trocar();" type="checkbox" name="reporAula" id="reporAula" value="1" <?php if($reporAula != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="pagarReposicao">Pagar Reposição</label>
        <input type="checkbox" name="pagarReposicao" id="pagarReposicao" value="1" <?php if($pagarReposicao != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="professorVe">Professor Ve.</label>
        <input type="checkbox" name="professorVe" id="professorVe" value="1" <?php if($professorVe != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="adminVe">Admin Ve.</label>
        <input type="checkbox" name="adminVe" id="adminVe" value="1" <?php if($adminVe != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="expira">Reposição Expira</label>
        <input type="checkbox" name="expira" id="expira" value="1" <?php if($expira != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Sigla:</label>
        <input type="text" name="sigla" id="sigla" class="required" value="<?php echo $sigla?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Decrição Sigla:</label>
        <input type="text" name="decricaoSigla" id="decricaoSigla" class="" value="<?php echo $decricaoSigla?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" class="" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_OcorrenciaFF', '<?php echo CAMINHO_MODULO?>configuracoes/ocorrenciaff/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>
/*function Trocar(){    
    function(){
        $("#expira:checkbox").attr("checked",true);
    },
    function(){
        $("#expira:checkbox").attr("checked",false);
    }
}*/
ativarForm();
</script> 
