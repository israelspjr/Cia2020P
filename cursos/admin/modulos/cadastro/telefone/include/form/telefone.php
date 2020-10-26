<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Telefone.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DescricaoTelefone.class.php");
	
$Telefone = new Telefone();
$DecricaoTelefone = new DescricaoTelefone(); 

$idTelefone = $_GET['id'];	

//CHAVES ESTRANGEIRAS
$clientePfIdClientePf = $_GET['idClientePf'];
$clientePjIdClientePj = $_GET['idClientePj'];		
$funcionarioIdFuncionario = $_GET['idFuncionario'];
$professorIdProfessor = $_GET['idProfessor'];
$contatoAdicionalIdContatoAdicional = $_GET['idContatoAdicional'];

if($idTelefone!='' && $idTelefone>0){
	
	$valorTelefone = $Telefone->selectTelefone('WHERE idTelefone='.$idTelefone);
	
	$idTelefone = $valorTelefone[0]['idTelefone'];
	//CHAVES ESTRANGEIRAS
	$clientePfIdClientePf = $valorTelefone[0]['clientePf_idClientePf'];
	$clientePjIdClientePj = $valorTelefone[0]['clientePj_idClientePj'];		
	$funcionarioIdFuncionario = $valorTelefone[0]['funcionario_idFuncionario'];
	$professorIdProfessor = $valorTelefone[0]['professor_idProfessor'];
	$contatoAdicionalIdContatoAdicional = $valorTelefone[0]['contatoAdicional_idContatoAdicional'];
	//
	$ddd = $valorTelefone[0]['ddd'];
	$numero = $valorTelefone[0]['numero'];
	$operadoraCelularIdOperadoraCelular = $valorTelefone[0]['operadoraCelular_idOperadoraCelular'];		
	$descricaoTelefoneIdDescricaoTelefone = $valorTelefone[0]['descricaoTelefone_idDescricaoTelefone'];
	$obs = $valorTelefone[0]['obs'];		
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Telefone</legend>
    <form id="form_telefone" class="validate" method="post" action="" onsubmit="return false" >
    
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
      <input name="clientePj_idClientePj" type="hidden" value="<?php echo $clientePjIdClientePj?>" />
      <input name="funcionario_idFuncionario" type="hidden" value="<?php echo $funcionarioIdFuncionario?>" />
      <input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
      <input name="ContatoAdicional_idContatoAdicional" type="hidden" value="<?php echo $contatoAdicionalIdContatoAdicional?>" />
      
      <div class="esquerda">                 
        <p>
          <label>Descrição:</label>          
        <?php echo $DecricaoTelefone->selectDescricaotelefoneSelect("required", $descricaoTelefoneIdDescricaoTelefone);?><span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoTelefone-->
        </p>
        
        <p>
          <label>DDD:</label>
          <input type="text" name="ddd" id="ddd" maxlength="3" class="required numeric" onsubmit="return false" value="<?php echo $ddd?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>      
        <p>
          <label>Número do telefone:</label>
          <input type="text" name="numero" id="numero" class="required" value="<?php echo $numero?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
          </div>
      <div class="direita">
        
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <p>
        <button class="button blue" onclick="postForm('form_telefone', '<?php echo CAMINHO_CAD?>telefone/include/acao/telefone.php?id=<?php echo $idTelefone?>')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 