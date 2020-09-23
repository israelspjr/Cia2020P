<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$Professor = new Professor();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$Conheceu = new ComoConheceu();
$Idioma = new Idioma();

$idProfessor = $_SESSION['idProfessor_SS'];

if ($idProfessor != -1) {

	$email = $Professor->getEmail($idProfessor);
}

$valorProfessor = $Professor -> selectProfessor(" WHERE idProfessor = $idProfessor");

$foto = $valorProfessor[0]['foto'];
$curriculum = $valorProfessor[0]['curriculum'];
$nomeExibicao = $valorProfessor[0]['nomeExibicao'];
$sexo = $valorProfessor[0]['sexo'];
$dataNascimento = $valorProfessor[0]['dataNascimento'];
$estadoCivilIdEstadoCivil = $valorProfessor[0]['estadoCivil_idEstadoCivil'];
$paisIdPais = $valorProfessor[0]['pais_idPais'];
$rg = $valorProfessor[0]['rg'];
$tipoDocumentoUnicoIdTipoDocumentoUnico = $valorProfessor[0]['tipoDocumentoUnico_idTipoDocumentoUnico'];
$documentoUnico = $valorProfessor[0]['documentoUnico'];
$senhaAcesso = EncryptSenha::B64_Decode($valorProfessor[0]['senha']);
$ccm = $valorProfessor[0]['ccm'];
$inss = $valorProfessor[0]['inss'];
$presencial = $valorProfessor[0]['presencial'];
$online = $valorProfessor[0]['online'];
$idConheceu = $valorProfessor[0]['indicadoPor'];
$rgC = $valorProfessor[0]['rgC'];
$comprovante = $valorProfessor[0]['comprovante'];
?>

<fieldset>

	<!-- UPLOAD DA FOTO-->
	<form id="form_uploadFoto" method="post" enctype="multipart/form-data" action="/cursos/portais/modulos/cadastro/professorAcao.php" style="display:none">
		<input type="hidden" id="acao" name="acao" value="foto" />
		<input type="file" id="add_foto" name="foto" />
	</form>

	<!-- UPLOAD DO FILE (CURRICULUM) -->
	<form id="form_uploadFile" method="post" enctype="multipart/form-data" action="/cursos/portais/modulos/cadastro/professorAcao.php" style="display:none">
		<input type="hidden" id="acao" name="acao" value="file" />
		<input type="file" id="add_file" name="file" />
	</form>
    
      <!-- UPLOAD DO FILE (RG) -->
  <form id="form_uploadFile2" method="post" enctype="multipart/form-data" action="/cursos/portais/modulos/cadastro/professorAcao.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="rg" />
    <input type="file" id="add_file2" name="file" />
  </form>
  
  <!-- UPLOAD DO FILE (COMPROVANTE) -->
  <form id="form_uploadFile3" method="post" enctype="multipart/form-data" action="/cursos/portais/modulos/cadastro/professorAcao.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="comprovante" />
    <input type="file" id="add_file3" name="file" />
  </form>

	<legend>
		Dados pessoais
	</legend>
	<img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR FORMULÁRIO" id="img_" onclick="abrirFormulario('div_form_professor', 'img_');" />

	<div class="agrupa" id="div_form_professor">
		<form id="form_professor" class="validate" method="post" action="" onsubmit="return false">

			<div class="esquerda">
				<p>
					<label>Foto:</label>
					<img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
					<div id="visualizarFoto">
						<?php if($foto != ''){
						?><img src="<?php echo CAMINHO_UP?>imagem/foto/professor/<?php echo $foto; ?>" />
						<input type="hidden" name="foto_oculta" value="<?php echo $foto?>" required="" />
						<?php } ?>
					</div>
				</p>
				<p>
					<label>Curriculum:</label>
					<img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();" title="Anexar novo" />
					<div id="visualizarFile">
						<?php if($curriculum != ''){
						?>
						<a target="_blank" href="<?php echo CAMINHO_UP?>arquivo/curriculo/professor/<?php echo $curriculum; ?>"> <img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /> </a>
						<input type="hidden" name="file_oculto" value="<?php echo $curriculum?>" required="" />
						<?php } ?>
					</div>
				</p>
                
                   <p>
          <label>RG / CPF / RNE:
          <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file2').click();" title="Anexar novo" /> Clique em Salvar após enviar o Rg / Cpf / Rne</label>
        <div id="visualizarFile2">
          <?php if($rgC != ''){?>
          <a target="_blank" href="<?php echo CAMINHO_UP?>arquivo/curriculo/professor/<?php echo $rgC;?>"> <img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /> </a>
          <input type="hidden" name="rgC_oculto" value="<?php echo $rgC?>" required="" />
          <?php }?>
        </div>
        </p>
        
         <p>
          <label>Comprovante de residência :
          <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file3').click();" title="Anexar novo" /> Clique em Salvar após enviar o Comprovante</label>
        <div id="visualizarFile3">
          <?php if($comprovante != ''){?>
          <a target="_blank" href="<?php echo CAMINHO_UP?>arquivo/curriculo/professor/<?php echo $comprovante?>"> <img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /> </a>
          <input type="hidden" name="comprovante_oculto" value="<?php echo $comprovante?>" required="" />
          <?php }?>
        </div>
        </p>
                
				<p>
					<label>Nome para exibição:</label>
					<input type="text" name="nomeExibicao" id="nomeExibicao" class="required" value="<?php echo $nomeExibicao?>" placeholder="Campo Obrigatório"/>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
                <?php if ($_SESSION['idProfessor_SS'] == -1) { ?>
                <p>
					<label>Email:</label>
					<input type="email" name="email" id="email" class="required" value="<?php echo $email?>" placeholder="Campo Obrigatório"/>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
                
                <p>
					<label>DDD: <input type="text" size="5" name="ddd" id="ddd" class="required" value="<?php echo $ddd?>" placeholder="Campo Obrigatório"/>
					Telefone: <input type="text" name="telefone" id="telefone" class="required" value="<?php echo $telefone?>" placeholder="Campo Obrigatório"/>
				   </label>
						<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
        			
				<?php } ?>
				<p>
					<label>Sexo:</label>
					<select name="sexo" id="sexo" class="required">
						<option <?php if($sexo ==""){ ?> selected="selected" <?php } ?>  value="">Selecione</option>
						<option <?php if($sexo == "M"){ ?> selected="selected" <?php } ?>  value="M">Masculino</option>
						<option <?php if($sexo == "F"){ ?> selected="selected" <?php } ?>  value="F">Feminino</option>
					</select>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>Data de Nascimento:</label>
					<input type="date" name="dataNascimento" id="dataNascimento" class="required " value="<?php echo $dataNascimento?>" placeholder="Campo Obrigatório" style="    line-height: 19px;"/>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>Estado Civil:</label>
					<?php echo $EstadoCivil -> selectEstadocivilSelect("", $estadoCivilIdEstadoCivil); ?>
				</p>
				<p>
					<label>País de origem:</label>
					<?php echo $Pais -> selectPaisSelect("required", $paisIdPais ? $paisIdPais : ID_PAIS); ?>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
                       <div><p>
          <label>Como Conheceu:</label>
       <?php echo $Conheceu->selectComoConheceuSelect("required",$idConheceu, " AND excluido = 0 AND (professor = 1 OR geral =1)") ?>
       <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
       </p></div>
			</div>
			<div class="direita">
				<p>
					<label>RG:</label>
					<input type="text" name="rg" id="rg" class="rg" value="<?php echo $rg?>" />
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>Qual documento?:</label>
					<?php echo $TipoDocumentoUnico -> selectTipoDocumentoUnicoSelect("required", 1); ?>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>Nº do documento (CPF: xxx.xxx.xxx-xx):</label> 
             <input type="text" name="documentoUnico" id="documentoUnico" class="required <?php echo $docsObrigatorios?>" value="<?php echo $documentoUnico?>" />
     
                   <span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
      			 				
				</p>
				<p>
				  <label>Senha (Mínimo de 6 caracteres):</label>
					<input type="password" name="senhaAcesso" id="password" class="required password"  value="<?php echo $senhaAcesso?>" placeholder="Campo Obrigatório"/><br>
                     <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>Confirma Senha:</label>
					<input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso?>" placeholder="Campo Obrigatório"/><br>
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>CCM:</label>
					<input type="text" name="ccm" id="ccm" class="" value="<?php echo $ccm?>" />
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label>INSS:</label>
					<input type="text" name="inss" id="inss" class="" value="<?php echo $inss?>" />
					<span class="placeholder" style="display:none;color:red;">Campo Obrigatório</span>
				</p>
				<p>
					<label for="presencial">
						<input type="checkbox" name="presencial" id="presencial" value="1" <?php if($presencial != 0){ ?> checked="checked" <?php } ?> />
						Aceita aulas presenciais</label>
				</p>
				<p>
					<label for="online">
						<input type="checkbox" name="online" id="online" value="1" <?php if($online != 0){ ?> checked="checked" <?php } ?> />
						Aceita aulas On-line</label>
				</p>
			</div>
             </div>
                <div id="div_lista_backgroundIdiomaProfessor" class="linha-inteira">
             <fieldset>
    <legend>Idioma do professor</legend>
     <?php //if($idProfessor == -1) { 
	 
				 echo $Idioma->selectIdiomaSelect("required", 4, $and);
	//		  echo "<span class=\"placeholder\">Campo Obrigatório</span> ";
			  ?>
              <div id="div_SotaquePorIdioma"></div>
			   <?php 
	// }
	  ?>
      </fieldset>          
                </div>
        <div class="linha-inteira">
            <p>
				<button class="bBlue" onclick="postForm('form_professor', '<?php echo "modulos/cadastro/professorAcao.php?id=$idProfessor"?>');">
					Salvar
				</button>
			</p>
           
        </form>
      
        <p>
        
	</div>
</fieldset>

 <!--
                  <input type="text" name="documentoUnico" id="rne" class="rne" value="<?php echo $documentoUnico?>" autocomplete="off" style="display:none"/>
			      <input type="text" name="documentoUnico" id="passaporte" class="passaporte" value="<?php echo $documentoUnico?>" autocomplete="off" style="display:none"/>-->
<script>
	$(document).ready(function(){
		$('#idIdioma').change(function(){
	//		atualizaNivelLinguisticoPorIdioma( $(this).val() );
			atualizaSotaquePorIdioma( $(this).val() );
		});	
	});
	
	
//	tipoDocumentoUnico('form_professor');
//	$('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("form_professor")');
		
			
	/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
	$('#add_foto').on('change', function() {
		$('#visualizarFoto').html('Enviando...');
		/* Efetua o Upload sem dar refresh na pagina */
		$('#form_uploadFoto').ajaxForm({
			target : '#visualizarFoto' // o callback será no elemento com o id #visualizar
		}).submit();
	});

	/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
	$('#add_file').on('change', function() {
		$('#visualizarFile').html('Enviando...');
		/* Efetua o Upload sem dar refresh na pagina */
		$('#form_uploadFile').ajaxForm({
			target : '#visualizarFile' // o callback será no elemento com o id #visualizar
		}).submit();
	});
	
	/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file2').on('change', function(){
	$('#visualizarFile2').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile2').ajaxForm({
		target:'#visualizarFile2' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file3').on('change', function(){
	$('#visualizarFile3').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile3').ajaxForm({
		target:'#visualizarFile3' // o callback será no elemento com o id #visualizar
	}).submit();
});

//ativarForm();

/*function atualizaSotaquePorIdioma(idIdioma, idSotaqueIdiomaProfessor){
		if(idSotaqueIdiomaProfessor == '' || idSotaqueIdiomaProfessor == undefined) idSotaqueIdiomaProfessor = '';
		
		$.post('modulos/cadastro/idiomaProfessor.php', { acao:"SotaquePorIdioma", idIdioma: idIdioma, idSotaqueIdiomaProfessor: idSotaqueIdiomaProfessor}, function(e){
			$('#div_SotaquePorIdioma').html(e);
		});
	}
	atualizaSotaquePorIdioma( '4', '<?php echo $idSotaqueIdiomaProfessor ?>' );*/
</script>
<?php if ($idProfessor != -1) { ?>
 <div id="div_lista_endereco">
         <div id="div_lista_enderecoVirtual">
          <?php require_once '../enderecoVirtual.php';?>
        </div>
          <?php require_once '../endereco.php';?>
        </div>
        <div>
        <p>&nbsp;</p>
        </div>
         <div id="div_lista_telefone">
          <?php require_once '../telefone.php';?>
        </div>
         <div>
        <p>&nbsp;</p>
        </div>
    <? } ?>