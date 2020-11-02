<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProvaINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");


$ProvaINF = new ProvaINF();
$Prova = new Prova();
$RelacionamentoINF = new RelacionamentoINF();
		
$idProvaINF = $_REQUEST['id'];

if($idProvaINF != '' && $idProvaINF  > 0){

	$valor = $ProvaINF->selectProvaINF('WHERE idProvaINF='.$idProvaINF);
	
	//$idProvaINF = $valor[0]['idProvaINF'];
	 $prova_idProva = $valor[0]['prova_idProva'];
	 $relacionamentoINF_idRelacionamentoINF = $valor[0]['relacionamentoINF_idRelacionamentoINF'];
	 $unidade = $valor[0]['unidade'];
	 $obs = $valor[0]['obs'];
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Prova I.N.F.</legend>
    <form id="form_ProvaINF" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idProvaINF ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label>Prova:</label>
        <?php echo $Prova->selectProvaSelect("required", $prova_idProva, " WHERE inativo = 0 AND excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Relacionamento I.N.F.:</label>
        <?php echo $RelacionamentoINF->selectRelacionamentoINFSelect("required", $relacionamentoINF_idRelacionamentoINF, " WHERE R.inativo = 0 AND R.excluido = 0"); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Unidade:</label>
        <input type="text" name="unidade" id="unidade" class="" value="<?php echo $unidade?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_ProvaINF', '<?php echo CAMINHO_MODULO?>configuracoes/provainf/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
