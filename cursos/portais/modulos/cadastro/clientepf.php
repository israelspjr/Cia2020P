<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePf = new ClientePf();
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$ClientePj = new ClientePj();
$Conheceu = new ComoConheceu();


if ($_SESSION['idClientePf_SS'] != 4) { 

	 $valorClientePF = $ClientePf->selectClientepf('WHERE idClientePf = '.$_SESSION['idClientePf_SS']);
     $nomeExibicao = $valorClientePF[0]['nomeExibicao']; 
	 $idClientePj = $valorClientePF[0]['clientePj_idClientePj'];
	

} else {
     $nomeExibicao = $_SESSION['nome_SS'];
	 $emailPj = $_SESSION['emailpf'];
	 $idPreClientePf = $_SESSION['idUsuario'];
	 $idClientePj = $_SESSION['clientePj'];
	 $idFuncionario = $_SESSION['funcionario'];
	 
}
	
$idClientePf = $_SESSION['idClientePf_SS'];	
$sexo = $valorClientePF[0]['sexo']; 
$dataNascimento = /*Uteis::exibirData(*/$valorClientePF[0]['dataNascimento']/*)*/;  
$idEstadoCivil = $valorClientePF[0]['estadoCivil_idEstadoCivil']; 
$idPais = $valorClientePF[0]['pais_idPais']; 
$foto = $valorClientePF[0]['foto']; 
$fotoThumb = "miniatura-".$valorClientePF[0]['foto']; 
$cargo = $valorClientePF[0]['cargo'];  
$idTipoDocumentoUnico = $valorClientePF[0]['tipoDocumentoUnico_idTipoDocumentoUnico']; 
$documentoUnico = $valorClientePF[0]['documentoUnico']; 
$senhaAcesso = EncryptSenha::B64_Decode($valorClientePF[0]['senhaAcesso']); 
$rg = $valorClientePF[0]['rg'];  
$rf = $valorClientePF[0]['rf'];
//	$subEmpresa = $valorClientePF[0]['subEmpresa'];
$cc = $valorClientePF[0]['cc'];
$politica = $valorClientePF[0]['politica'];
	$politicaA = $valorClientePF[0]['politicaA'];
	$dataPolitica = $valorClientePF[0]['dataPolitica'];
$idConheceu = $valorClientePF[0]['conheceu'];
?>

<fieldset>
  
  <form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD?>acao/clientepf.php" style="display:none;">
    <input type="hidden" id="acao" name="acao" value="foto" />
    <input type="file" id="add_foto" name="foto" />
  </form>
   
  <legend>Dados básicos</legend>
  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_clientePf', 'img_');" />
  
  <div id="div_form_clientePf">
    <form id="form_clientepf" class="validate" action="" method="post"  onsubmit="return false" >
    <input type="hidden" id="idPreClientePf" name="idPreClientePf" value="<?php echo $idPreClientePf ?>" />
    <input type="hidden" id="clientePj_idClientePj" name="clientePj_idClientePj" value="<?php echo  $idClientePj ?>" />
    <input type="hidden" id="idFuncionario" name="idFuncionario" value="<?php echo  $idFuncionario ?>" />

      <div class="direita">
     <?php  if ($_SESSION['idClientePf_SS'] != 4) { ?>
        <p>
          <label>Foto:</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
        <div id="visualizar">
          <?php if($foto != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/foto/clientePf/<?php echo $fotoThumb;?>" />
          <?php }else{?>
          <input type="hidden" name="foto_oculta" value="<?php echo $foto?>" required="required" />
          <?php }?>
        </div>
        </p>
        
        <?php } ?>
         <p>
       
          <?php if ($politicaA == 1) { 
		  echo "Data da assinatura eletrônica da política de idioma: ".Uteis::exibirData($dataPolitica); 
		  } else { ?>
		  <label>Ao clicar em Salvar você automaticamente concorda com a política de idioma da sua empresa!
          <input type="radio" name="politicaA" value="1" required="required" checked="checked"/> Sim, concordo!	  
			  
		 <?php }
		  ?>
        </p> 
        
           <p>
        <label>Registro de Funcionário: </label>
        <input type="text" id="rf" name="rf" value="<?php echo $rf?>" />
        </p>
        <p>
        <label>Centro de custo: </label>
        <input type="text" id="cc" name="cc" value="<?php echo $cc?>" />
        </p>
    
  <?php // } ?>      
        </div>
        <div class="esquerda">
        <p>
          <label>Nome completo (conforme documento oficial):</label>
          <input type="text" name="nomeExibicao" id="nomeExibicao" value="<?php echo $nomeExibicao?>" class="required" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Sexo:</label>
          <select name="sexo" id="sexo" class="required">
            <option <?php if($sexo ==""){ ?> selected="selected" <?php } ?>  value="">Selecione</option>
            <option <?php if($sexo == "M"){ ?> selected="selected" <?php } ?>  value="M">Masculino</option>
            <option <?php if($sexo == "F"){ ?> selected="selected" <?php } ?>  value="F">Feminino</option>
          </select>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Data de Nascimento:</label>
          <input type="date" name="dataNascimento" id="dataNascimento" class="data-mask" value="<?php echo $dataNascimento?>"  />
          </p>
        <p>
          <label>Estado Civil:</label>         
           
          <?php echo $EstadoCivil->selectEstadocivilSelect("", $idEstadoCivil);?> <span class="placeholder">Campo Obrigatório</span> </p>
             <label>Como Conheceu:</label>
       <?php echo $Conheceu->selectComoConheceuSelect("required",$idConheceu, " AND excluido = 0 AND (aluno = 1 OR geral =1)") ?>
       <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
       </p>
        <p>
          <label>País de origem:</label>          
          <!--funcao retorna pais --> 
          <?php echo $Pais->selectPaisSelect("required", $idPais);?> <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        <label>Empresa:</label>
        <?php echo $ClientePj->getNome($idClientePj); ?>
        </p>
           <p>
          <label>Senha (mínimo de 6 caracteres): </label>
        <!--  <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />-->
         <input type="password" name="senhaAcesso" id="password" class="required password" value="<?php echo $senhaAcesso?>"  />
          <br><input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
         <p>
          <label>Confirma Senha:</label>
          <input type="password" name="senhaAcesso2" id="password2" class="required password" value="<?php echo $senhaAcesso?>" /></p>
          <br>
      </div>
      <div class="direita">
        <p>
          <label>Cargo:</label>
          <input type="text" name="cargo" id="cargo" class="required" value="<?php echo $cargo?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
       <p>
          <label>RG:</label>
          <input type="text" name="rg" id="rg" class="rg" value="<?php echo $rg?>"  />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Qual documento?:</label>
          <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect("required", 1 /*$idTipoDocumentoUnico*/);?> <span class="placeholder">Campo Obrigatório</span> </p>
           <p>
          <label>Nº do documento:</label>
          <input type="text" name="documentoUnico" id="documentoUnico" class="required" value="<?php echo $documentoUnico?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
    
      <?php if ($_SESSION['idClientePf_SS'] == 4) { ?>
        <label>
      Telefone Celular:
      </label><p>
      <input type="text"  name="telefone" id="telefone" value="<?php echo $telefone?>" class="required" />
       
      <span class="placeholder">Campo Obrigatório</span></p>
  
     <label>
      Telefone Comercial:
      </label><p>
      <input type="text"  name="telefonePj" id="telefonePj" value="<?php echo $telefonePj?>" />
		</p>
        
         <label>
      Telefone Residencial:
      </label><p>
      <input type="text"  name="telefonePf" id="telefonePf" value="<?php echo $telefonePf?>" />
    </p>
    
    
      </div>
      <div class="esquerda">
         <label>
      Endereço residencial:
      </label>
      (Endereço, número, bairro, cidade e cep)
      <p>
      <input type="text" size="30" name="endereco" id="endereco" value="<?php echo $endereco?>" class="required" />
      <span class="placeholder">Campo Obrigatório</span></p>
     <label>
      Email Corporativo:
      </label><p>
     <input type="text" name="emailPj" id="emailPj" value="<?php echo $emailPj?>"  class="required"/>
     <span class="placeholder">Campo Obrigatório</span></p>
    </p>
      </div>
          
       <label>
      Email Pessoal:
      </label><p>
     <input type="text" name="emailPf" id="emailPf" value="<?php echo $emailPf?>"  />
      
    <p> <label>
      Skype:
      </label></p><p>
     <input type="text" name="skype" id="skype" value="<?php echo $skype?>"  />
    </p>   
    
      
      
      <?php } else {?>
      
      
      
      </div>
      <?php } ?>
<div id="passo" style="display:none">
<label>
Passo 1 de 3
</label>
<a id="proximo" onclick="proximo();" >Clique aqui para ir para proximo passo.</a>
</div>      
        <p>
          <button class="Bblue" id="salvou" onclick="enviar();">Salvar</button>
          <button class="gray" onclick="zerarCentro();carregarModulo('cursos/portais/index.php', '#centro');">Fechar</button>
        </p>
      </div>
    </form>
  </div>
</fieldset>

<?php 
 if ($_SESSION['idClientePf_SS'] != 4) {

require_once "endereco.php"; 
echo "<p>";
//require_once "enderecoVirtual.php"; 
echo "</p>";
echo "<p>";
//require_once "telefone.php"; 
echo "</p>";
echo "<p>";
//require_once "formacaoPerfil.php"; 
echo "</p>";

 }
?>
<script>
/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_foto').on('change',function(){
	$('#visualizar').html('Enviando..');
	$('#formulario').ajaxForm({
		target:'#visualizar' // o callback será no elemento com o id #visualizar
	}).submit();
});

function obrigatoriadadeDocumentoUnico(form){
	
	var eForm = $('#' + form);

	var tipoDocumentoUnico = eForm.find('#tipoDocumentoUnico_idTipoDocumentoUnico');
	var documentoUnico = eForm.find('#documentoUnico');
	
	if( eForm.find('#TipoCliente_idTipoCliente').val() == 3 ){
		tipoDocumentoUnico.addClass('required').find('~ span').hide();
		documentoUnico.addClass('required').find('~ span').hide();			
	}else{		
		tipoDocumentoUnico.removeClass('invalid required').find('~ span').hide();
		documentoUnico.removeClass('invalid required').find('~ span').hide();							
	}
	ativarForm();
}

$('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("form_clientepf")');
$('#form_clientepf #TipoCliente_idTipoCliente').attr('onchange', 'obrigatoriadadeDocumentoUnico("form_clientepf")');

//obrigatoriadadeDocumentoUnico("form_clientepf");
//tipoDocumentoUnico("form_clientepf");
/*
ativarForm();
*/
function enviar() {
	var cargo = $('#cargo').val();
	if (cargo == '') {
		alert("Preencha o Cargo");
		$('#cargo').focus();
		return false;
	}
	var password = $('#password').val();
	if (password == '') {
		alert("Preencha a senha");
		$('#password').focus();
		return false;
	}
	var password2 = $('#password2').val();
	if (password2 == '') {
		alert("Preencha a confirmação da senha");
		$('#password2').focus();
		return false;
	}
	
	var telefone = $('#telefone').val();
	if (telefone == '') {
		alert("Preencha o Telefone");
		$('#telefone').focus();
		return false;
	}
	var endereco = $('#endereco').val();
	if (endereco == '') {
		alert("Preencha o Endereço");
		$('#endereco').focus();
		return false;
	}
	var sexo = $('#sexo').val();
	if (sexo == '') {
		alert("Preencha o Sexo");
		$('#sexo').focus();
		return false;
	}
	var idPais = $('#pais_idPais').val();
	if (idPais == '') {
		alert("Preencha o Pais");
		$('#pais_idPais').focus();
		return false;
	}
	var documentoUnico = $('#documentoUnico').val();
	if (documentoUnico == '') {
		alert("Preencha o Documento");
		$('#documentoUnico').focus();
		return false;
	}
	
	
	postForm('form_clientepf', '<?php echo "modulos/cadastro/clientepfAcao.php?id=".$idClientePf?>');
	enviadoOK();
	zerarCentro();
	carregarModulo('modulos/cadastro/opcaoAtividadeExtraClientePf.php', '#centro');
	
	window.setTimeout('funcao()', 3000);
	
}
function funcao() {
	document.getElementById("passo").style.display = "block";
	

}
function passo1() {
	
//window.location = '/cursos/aluno/';			
}

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});

/*$(document).ready(function(){
    $('[name=dataNascimento]').mask('00/00/0000');
});*/
</script> 
