<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Telefone = new Telefone();
$DecricaoTelefone = new DescricaoTelefone();

$idTelefone = $_GET['id'];	
$clientePfIdClientePf = $_GET['idClientePf'];

if($idTelefone!='' && $idTelefone>0){
	
	$valorTelefone = $Telefone->selectTelefone('WHERE idTelefone='.$idTelefone);
	
	$clientePfIdClientePf = $valorTelefone[0]['clientePf_idClientePf'];
	$ddd = $valorTelefone[0]['ddd'];
	$numero = $valorTelefone[0]['numero'];
	$operadoraCelularIdOperadoraCelular = $valorTelefone[0]['operadoraCelular_idOperadoraCelular'];		
	$descricaoTelefoneIdDescricaoTelefone = $valorTelefone[0]['descricaoTelefone_idDescricaoTelefone'];
	$obs = $valorTelefone[0]['obs'];		
}
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
   -->
   <fieldset>
    <legend>Telefone</legend>
    <form id="form_telefone" class="validate" method="post" action="" onsubmit="return false" >
    
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
         
      <div class="esquerda">         
        <p>
          <label>Descrição:</label>
       
        <?php echo $DecricaoTelefone->selectDescricaotelefoneSelect("required", $descricaoTelefoneIdDescricaoTelefone);?><span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoTelefone-->
        </p>
        
        <p>
          <label>DDD:</label>
          <input type="text" name="ddd" id="ddd" maxlength="2" class="required numeric" onsubmit="return false" value="<?php echo $ddd?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>      
        <p>
          <label>Número do telefone:</label>
          <input type="text" name="numero" id="numero" class="required fone" value="<?php echo $numero?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
          </div>
      <div class="direita">
        
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_telefone', 'modulos/cadastro/telefoneAcao.php?id=<?php echo $idTelefone?>');">Salvar</button>
        <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/mobile/aluno/modulos/cadastro/telefone.php', '#centro');">Fechar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>//ativarForm();</script> 