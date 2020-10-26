<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ContatoAdicional = new ContatoAdicional();

$clientePfIdClientePf = $_GET['idClientePf'];
$clientePjIdClientePj = $_GET['idClientePj'];		
$funcionarioIdFuncionario = $_GET['idFuncionario'];
$professorIdProfessor = $_GET['idProfessor'];
$propostaIdProposta = $_GET['idProposta'];

$idContatoAdicional = $_GET['id'];	

if($idContatoAdicional!=''){
	
	$valorContatoAdicional = $ContatoAdicional->selectContatoAdicional(" AND idContatoAdicional=".$idContatoAdicional);
		
	$idContatoAdicional = $valorContatoAdicional[0]['idContatoAdicional'];
	
	//CHAVES ESTRANGEIRAS
	$clientePfIdClientePf = $valorContatoAdicional[0]['clientePf_idClientePf'];
	$clientePjIdClientePj = $valorContatoAdicional[0]['clientePj_idClientePj'];		
	$funcionarioIdFuncionario = $valorContatoAdicional[0]['funcionario_idFuncionario'];
	$professorIdProfessor = $valorContatoAdicional[0]['professor_idProfessor'];
  $propostaIdProposta = $valorContatoAdicional[0]['proposta_idProposta'];
	//		
	$nome = $valorContatoAdicional[0]['nome'];
	$obs = $valorContatoAdicional[0]['obs'];	
	$contatoCobranca = $valorContatoAdicional[0]['contatoCobranca'];
	$contatoRH = $valorContatoAdicional[0]['contatoRH'];
  $contatoOutro = $valorContatoAdicional[0]['contatoOutro'];
  $contatoObs = $valorContatoAdicional[0]['contatoObs'];
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Contato adicional</legend>
    <form id="form_ContatoAdicional" class="validate" method="post" action="" onsubmit="return false" >
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
      <input name="clientePj_idClientePj" type="hidden" value="<?php echo $clientePjIdClientePj?>" />
      <input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
      <input name="funcionario_idFuncionario" type="hidden" value="<?php echo $funcionarioIdFuncionario?>" />
      <input name="proposta_idProposta" type="hidden" value="<?php echo $propostaIdProposta?>" />
      <p>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <?php if(($clientePjIdClientePj!='')or($propostaIdProposta!='')){?>
      <p>
        <label for="contatoCobranca">
        <input type="checkbox" name="contatoCobranca" id="contatoCobranca" class="" value="1" <?php echo $contatoCobranca ? "checked" : "" ?> />Contato de cobrança:</label>
	
        <label for="contatoRH">
        <input type="checkbox" name="contatoRH" id="contatoRH" class="" value="1" <?php echo $contatoRH ? "checked" : "" ?> />Contato RH:</label>
        
        <label for="contatoOutro">
        <input type="checkbox" name="contatoOutro" id="contatoOutro" class="" value="1" <?php echo $contatoOutro ? "checked" : "" ?> onclick="outro(this)" />Contato outro:</label>
        <label for="contatoObs" id="contatoObs1" <?php echo $contatoOutro ? "" : "style='display: none;'" ?> >Especifique:(Secretaria, Pai, Mãe, etc):<br />
        <input type="text" name="contatoObs" id="contatoObs" class="" value="<?php echo $contatoObs?>" /></label>
      </p>
      <?php }?>
      <p>
        <button class="button blue" onclick="postForm('form_ContatoAdicional', '<?php echo CAMINHO_CAD?>contatoAdicional/include/acao/contatoAdicional.php?id=<?php echo $idContatoAdicional?>')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
  <?php if($idContatoAdicional!=''){?>
  <div class="esquerda">
    <div id="div_lista_telefone_contatoAdicional">
      <?php require_once '../resourceHTML/telefone.php';?>
    </div>
  </div>
  <div class="direita">
    <div id="div_lista_enderecoVirtual_contatoAdicional">
      <?php require_once '../resourceHTML/enderecoVirtual.php';?>
    </div>
  </div>
  <?php }?>
</div>
<script>
ativarForm();
function outro(e){
  if( $(e).is(':checked') ){
    $('#contatoObs1').show();
  }else{
    $('#contatoObs1').hide();
  }
}
</script>