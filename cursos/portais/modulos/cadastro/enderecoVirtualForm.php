<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$EnderecoVirtual = new EnderecoVirtual();

$clientePfIdClientePf = $_GET['idClientePf'];
$contatoAdicionalIdContatoAdicional = $_GET['idContatoAdicional'];		
$funcionarioIdFuncionario = $_GET['idFuncionario'];
$professorIdProfessor = $_GET['idProfessor'];

$idEnderecoVirtual = $_GET['id'];	

if($idEnderecoVirtual!=''){
	
	$valorEnderecoVirtual = $EnderecoVirtual->selectEnderecovirtual("WHERE idEnderecoVirtual=".$idEnderecoVirtual);
		
	$clientePfIdClientePf = $valorEnderecoVirtual[0]['clientePf_idClientePf'];		
	$tipoEnderecoVirtual_idTipoEnderecoVirtual = $valorEnderecoVirtual[0]['tipoEnderecoVirtual_idTipoEnderecoVirtual'];
	$valor = $valorEnderecoVirtual[0]['valor'];		
	$eprin = $valorEnderecoVirtual[0]['ePrinc'];		
}
	
?>  

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
   --> <fieldset>
    <legend>Endereços Virtuais</legend>
    <form id="form_enderecoVirtual" class="validate" method="post" onsubmit="return false" >
    
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
    
      <p> 
        <label>Tipo do endereço virtual:</label>
        <?php echo $TipoEnderecoVirtual->selectTipoenderecovirtualSelect("required", $tipoEnderecoVirtual_idTipoEnderecoVirtual);?> 
        <!--funcao retorna tipoEnderecoVirtual_idTipoEnderecoVirtual--> 
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Endereco:</label>
        <input type="text" name="valor" id="valor" class="required" value="<?php echo $valor?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <label>Email Principal </label>
      <input type="checkbox" id="principal" name="principal" value="1" <?php if ($eprin == 1) { echo "checked=\"checked\""; } ?> />
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_enderecoVirtual', '/cursos/portais/modulos/cadastro/enderecoVirtualAcao.php?id=<?php echo $idEnderecoVirtual?>');">Salvar</button>
        
         <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/enderecoVirtual.php', '#centro');">Fechar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>

var $idTipo = $('#form_enderecoVirtual #idTipo');

function verificaEmail(){	
	
	var $valor = $('#form_enderecoVirtual #valor');
	
	if( $idTipo.val()==1) $valor.addClass('email');
	else $valor.removeClass('email');
		
}

$idTipo.attr('onchange','verificaEmail()');

ativarForm();

</script> 