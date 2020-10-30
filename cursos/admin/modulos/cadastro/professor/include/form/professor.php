<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$Professor = new Professor();
$TipoDocumentoUnico = new TipoDocumentoUnico();
$Conheceu = new ComoConheceu();

$ClientePj = new ClientePj();

$idProfessor = $_GET['id'];

if($idProfessor != '' && $idProfessor  > 0){

	$valorProfessor = $Professor->selectProfessor('WHERE idProfessor='.$idProfessor);
	
	$idProfessor = $valorProfessor[0]['idProfessor'];
	$foto = $valorProfessor[0]['foto'];
	$curriculum = $valorProfessor[0]['curriculum'];
	$nome = $valorProfessor[0]['nome'];
	$nomeExibicao = $valorProfessor[0]['nomeExibicao'];
	$sexo = $valorProfessor[0]['sexo'];
	$dataNascimento = Uteis::exibirData($valorProfessor[0]['dataNascimento']);
	$estadoCivilIdEstadoCivil = $valorProfessor[0]['estadoCivil_idEstadoCivil'];		
	$paisIdPais = $valorProfessor[0]['pais_idPais'];
    $naoReceberEmail = $valorProfessor[0]['naoReceberEmail'];
    $rg = $valorProfessor[0]['rg'];
	$tipoDocumentoUnicoIdTipoDocumentoUnico = $valorProfessor[0]['tipoDocumentoUnico_idTipoDocumentoUnico'];
	$documentoUnico = $valorProfessor[0]['documentoUnico'];		
	$senhaAcesso = EncryptSenha::B64_Decode($valorProfessor[0]['senha']);		
	$obs = $valorProfessor[0]['obs'];
	$ccm = $valorProfessor[0]['ccm'];									
	$inss = $valorProfessor[0]['inss'];
	$dataContratacao = Uteis::exibirData($valorProfessor[0]['dataContratacao']);		
	$inativo = $valorProfessor[0]['inativo'];
	$otimaPerformance = $valorProfessor[0]['otimaPerformance'];
	$altaPerformance = $valorProfessor[0]['altaPerformance'];
	$vetado = $valorProfessor[0]['vetado'];
	$indisponivel = $valorProfessor[0]['indisponivel'];
    $presencial = $valorProfessor[0]['presencial'];
    $tradutor = $valorProfessor[0]['tradutor'];
    $consultor = $valorProfessor[0]['consultor'];
    $online = $valorProfessor[0]['online'];
	$idFinanceiro = $valorProfessor[0]['id_migracao'];
	$indicadoPor = $valorProfessor[0]['indicadoPor'];
	$cidadeOrigem = $valorProfessor[0]['cidadeOrigem'];
	$skype = $valorProfessor[0]['skype'];
	$deixandoGrupo = $valorProfessor[0]['deixandoGrupo'];
	$chatClub = $valorProfessor[0]['chatClub'];
	$terceiro = $valorProfessor[0]['terceiro'];
	$tipoVeto = $valorProfessor[0]['tipoVeto'];
	$expSkype = $valorProfessor[0]['expSkype'];
	$candidato = $valorProfessor[0]['candidato'];
	$sobre = $valorProfessor[0]['sobre'];
	$tambemAluno = $valorProfessor[0]['tambemAluno'];
	$clientePjIdClientePj = $valorProfessor[0]['clientePj_idClientePj'];
	$dataCapacitacao = Uteis::exibirData($valorProfessor[0]['dataCapacitacao']);
	$encontro = $valorProfessor[0]['encontro'];
	$dataSegundo = Uteis::exibirData($valorProfessor[0]['dataSegundo']);
	$rgC = $valorProfessor[0]['rgC'];
	$comprovante = $valorProfessor[0]['comprovante'];
	$usoImagem = $valorProfessor[0]['usoImagem'];
}

$docsObrigatorios = $cadastroDeCandidato ? "" : "required";

?>

<fieldset>
  
  <!-- UPLOAD DA FOTO-->
  <form id="form_uploadFoto" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."professor/"?>include/acao/professor.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="foto" />
    <input type="file" id="add_foto" name="foto" />
  </form>
  
  <!-- UPLOAD DO FILE (CURRICULUM) -->
  <form id="form_uploadFile" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."professor/"?>include/acao/professor.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="file" />
    <input type="file" id="add_file" name="file" />
  </form>
  
   <!-- UPLOAD DO FILE (RG) -->
  <form id="form_uploadFile2" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."professor/"?>include/acao/professor.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="rg" />
    <input type="file" id="add_file2" name="file" />
  </form>
  
  <!-- UPLOAD DO FILE (COMPROVANTE) -->
  <form id="form_uploadFile3" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."professor/"?>include/acao/professor.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="comprovante" />
    <input type="file" id="add_file3" name="file" />
  </form>
  
  <legend>Dados pessoais</legend>
 
    <form id="form_professorB" class="validate" method="post" action="" onsubmit="return false">
      <input type="hidden" name="candidato" id="candidato" value="<?php echo $candidato?>" />
      <div class="esquerda">        
        <p>
          <label>Nome:</label>
          <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
    </div>
     <div class="direita">
           <p>
          <label>Foto:</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
        <div id="visualizarFoto">
          <?php if($foto != ''){?>
          <img width="250px" height="200px" src="<?php echo CAMINHO_UP?>imagem/foto/professor/<?php echo $foto;?>" />
          <input type="hidden" name="foto_oculta" value="<?php echo $foto?>" required="" />
          <?php } else {
			  echo "<font color='red'>Insira uma foto!  </font><br>";
			//  echo ' Ou clique aqui para professor sem foto.<input type="text" name="foto_oculta" value="" class="required" />';
			  
		  }?>
        </div>
        </p>        
    </div>
    <div class="linha-inteira">
      <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR FORMULÁRIO" id="img_" onclick="abrirFormulario('div_form_professor', 'img_');" />  
    </div>
 <div class="agrupa" id="div_form_professor"> 
    <div class="esquerda">
      <p>   
          <label>Nome para exibição:</label>
          <input type="text" name="nomeExibicao" id="nomeExibicao" class="required" value="<?php echo $nomeExibicao?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
          <p>
          <label>Qual documento?:</label>
          <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect($teraDocumentoUnico, $tipoDocumentoUnicoIdTipoDocumentoUnico);?> <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Nº do documento:</label>
          <input type="text" name="documentoUnico" id="documentoUnico" class="<?php echo $docsObrigatorios?>" value="<?php echo $documentoUnico?>" />
          <span class="placeholder">Campo Obrigatório</span> </p><p>
          <label>RG:</label>
          <input type="text" name="rg" id="rg" value="<?php echo $rg?>" />
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
          <input type="text" name="dataNascimento" id="dataNascimento" class="data" value="<?php echo $dataNascimento?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Estado Civil:</label>
          <?php echo $EstadoCivil->selectEstadocivilSelect("", $estadoCivilIdEstadoCivil);?> <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>País de origem:</label>
          
          <?php echo $Pais->selectPaisSelect("required", $paisIdPais ? $paisIdPais : ID_PAIS)?> <span class="placeholder">Campo Obrigatório</span> </p>
          
          <p>
          <label>Cidade de origem:</label>
        <input type="text" name="cidadeOrigem" id="cidadeOrigem" value="<?php echo $cidadeOrigem?>" />  
    </p>
         <p>
          <label>Data contratação:</label>
          
          <input type="text" name="dataContratacao" id="dataContratacao" class="<?php echo $docsObrigatorios?> data" value="<?php echo $dataContratacao?>" />
          <?php if ($candidato == 1) { ?>
			  
              <input type="checkbox" name="contratado" id="contratado" value="1" /> Contratar!!
			  
		  <?php } ?>
          <span class="placeholder">Campo Obrigatório</span> </p>
          <p>
          
          <strong>P</strong>  <input type="checkbox" name="presencial" id="presencial" value="1" <?php if($presencial != 0){ ?> checked="checked" <?php } ?> />
            Aulas Presenciais
        </p>
        <p>
          
            <input type="checkbox" name="online" id="online" value="1" <?php if($online != 0){ ?> checked="checked" <?php } ?> />
            Aulas Virtuais
        </p>
        <p>
          
            <input type="checkbox" name="tradutor" id="tradutor" value="1" <?php if($tradutor != 0){ ?> checked="checked" <?php } ?> />
            Tradutor
        </p>
        <p>
          
            <input type="checkbox" name="consultor" id="consultor" value="1" <?php if($consultor != 0){ ?> checked="checked" <?php } ?> />
            Consultor
        </p>
        
        <p>
          
            <input type="checkbox" name="chatClub" id="chatClub" value="1" <?php if($chatClub != 0){ ?> checked="checked" <?php } ?> />
            ChatClub
        </p>
        <p>
                     
          <img src="<?php echo CAMINHO_IMG."terceiro.png"?>" title="terceiro" style="    width: 18px;
    height: 20px;"/>  <input type="checkbox" name="terceiro" id="terceiro" value="1" <?php if($terceiro != 0){ ?> checked="checked" <?php } ?> />
            Terceiro
        </p>
        <p>
          
            <input type="checkbox" name="tambemAluno" id="tambemAluno" value="1" <?php if($tambemAluno != 0){ ?> checked="checked" <?php } ?> />
            Também é aluno
        </p>
         <p>
          
            <input type="checkbox" name="usoImagem" id="usoImagem" value="1" <?php if($usoImagem != 0){ ?> checked="checked" <?php } ?> />
            Permite uso de imagem
        </p>
        <p>
        <label>Empresa à qual pertence:</label>
        <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, ""," AND inativo = 0");?>
        </p>
      </div>
      <div class="direita">
        <p>
          <label>Currículo:
          <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();" title="Anexar novo" /> Clique em Salvar após enviar o Currículo</label>
        <div id="visualizarFile">
          <?php if($curriculum != ''){?>
          <a target="_blank" href="<?php echo CAMINHO_UP?>arquivo/curriculo/professor/<?php echo $curriculum;?>"> <img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /> </a>
          <input type="hidden" name="file_oculto" value="<?php echo $curriculum?>" required="" />
          <?php }?>
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
          <label>PSAs Disponíveis:
         <img src="<?php echo CAMINHO_IMG."pa.png"?>" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/resourceHTML/psa.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/contratado/cadastro.php?idProfessor=$idProfessor"?>', '#modulos_Grupo')"/></label>
        </p>
     <!--   <p>
        <label>Verificar testes do profTeste : 
        <img src="<?php echo CAMINHO_IMG."pa.png"?>" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/resourceHTML/profteste.php?idProfessor=$idProfessor"?>', '<?php echo CAMINHO_CAD."professor/contratado/cadastro.php?idProfessor=$idProfessor"?>', '#modulos_Grupo')"/></label>
        -->
        <p>
         <label> ID Sistema Financeiro: </label>
         <input type="text" name="idFinanceiro" id="idFinanceiro" value="<?php echo $idFinanceiro ?>" />            
        </p>
                <p>
          <label>Como Conheceu:</label>
       <?php echo $Conheceu->selectComoConheceuSelect("",$indicadoPor, " AND excluido = 0") ?>
       </p>
      <p>
          <label>CCM:</label>
          <input type="text" name="ccm" id="ccm" class="" value="<?php echo $ccm?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>INSS:</label>
          <input type="text" name="inss" id="inss" class="" value="<?php echo $inss?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
       
        
      	<p>
          <label>Senha:</label>
   <!--       <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />-->
          <input type="password" name="senhaAcesso" id="password" class="required password"  value="<?php echo $senhaAcesso?>" />
          <span class="placeholder">Campo Obrigatório</span> 
          <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
          </p>
      	<p>
          <label>Confirma Senha:</label>
          <input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4" class="required"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
           <p>
          <label>Sobre mim:</label>
          <textarea name="sobre" id="sobre" cols="40" rows="4" ><?php echo $sobre?></textarea>
           </p>
          <p>
              <label>
                  <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" <?php if($naoReceberEmail != 0){ ?> checked="checked" <?php } ?> value="1" />
                  Não receberá e-mail</label>
          </p>
          <p>
          
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo
        </p>
        <p>
          
            <img src="<?php echo CAMINHO_IMG."otima.gif";?>" title="Ótima Performance" />  
            <input type="checkbox" name="otimaPerformance" id="otimaPerformance" value="1" <?php if($otimaPerformance != 0){ ?> checked="checked" <?php } ?> />
            Ótima performance
        &nbsp;&nbsp;&nbsp;
          
            <img src="<?php echo CAMINHO_IMG."alta.gif";?>" title="Alta Performance" /> 
            <input type="checkbox" name="altaPerformance" id="altaPerformance" value="1" <?php if($altaPerformance != 0){ ?> checked="checked" <?php } ?> />
            Alta performance
        </p>
          <p>
                     
            <input type="checkbox" name="indisponivel" id="indisponivel" value="1" <?php if($indisponivel != 0){ ?> checked="checked" <?php } ?> />
            Indisponível
        </p>
        
         <p>
                     
          <img src="<?php echo CAMINHO_IMG."skype.png"?>" title="Na Tela" style="    width: 18px;
    height: 20px;"/>  <input type="checkbox" name="skype" id="skype" value="1" <?php if($skype != 0){ ?> checked="checked" <?php } ?> />
            Capacitado p/ aulas online     
       &nbsp;&nbsp;&nbsp; Data da Capacitação:  <input type="text" name="dataCapacitacao" id="dataCapacitacao" class="data" value="<?php echo $dataCapacitacao?>" /><br>
                     
          <input type="checkbox" name="expSkype" id="expSkype" value="1" <?php if($expSkype != 0){ ?> checked="checked" <?php } ?> />
            Experiência prévia c/ aulas online
        </p> 
          <p>
        
          <input type="checkbox" name="encontro" id="encontro" value="1" <?php if($encontro != 0){ ?> checked="checked" <?php } ?> />
            Segundo Encontro     
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Data do Segundo encontro:  <input type="text" name="dataSegundo" id="dataSegundo" class="data" value="<?php echo $dataSegundo?>" /></p>
         <p>
                     
          <img src="<?php echo CAMINHO_IMG."mao.png"?>" title="Skype" style="    width: 18px;
    height: 20px;"/>  <input type="checkbox" name="deixandoGrupo" id="deixandoGrupo" value="1" <?php if($deixandoGrupo != 0){ ?> checked="checked" <?php } ?> />
            Deixando grupos
        </p>
         <div width="100%">
          <div width="50%" style="float:left">
          <p>
            <img src="<?php echo CAMINHO_IMG."vetado.gif";?>" title="Vetado" />  
            <input type="checkbox" name="vetado" id="vetado" value="1" onclick="mostrar(1);" <?php if($vetado != 0){ ?> checked="checked" <?php } ?> />
            
            Vetado 
            </div>
            		<div id="tipoVetoD" style="float:left;display:none;">  <input type="checkbox" name="tipoVeto" id="tipoVeto" value="1" <?php if($tipoVeto == 1){ ?> checked="checked" <?php } ?> /> Comportamental <br />
             <input type="checkbox" name="tipoVeto" id="tipoVeto" value="2" <?php if($tipoVeto == 2){ ?> checked="checked" <?php } ?> /> Pedagógico <br />
              <input type="checkbox" name="tipoVeto" id="tipoVeto" value="3" <?php if($tipoVeto == 3){ ?> checked="checked" <?php } ?> /> Ambos <br />
             		</div>
           </div>
        </p>
       </div>
      <div class="esquerda">
      <p>
        <button class="button blue" onclick="postForm('form_professorB', '<?php echo CAMINHO_CAD."professor/"?>include/acao/professor.php?id=<?php echo $idProfessor?>');">Salvar</button>
      </p>      
    </form>
    </div>
  </div>
</fieldset>


<script>     

tipoDocumentoUnico('form_professorB');
$('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("form_professorB")')

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_foto').on('change', function(){
	$('#visualizarFoto').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFoto').ajaxForm({
		target:'#visualizarFoto' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
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


function mostrar(x) {
if (x == 1) {
	$('#tipoVetoD').show();
	$('#vetado').attr('onclick', 'mostrar(0);');
} else {
	$('#tipoVetoD').hide();
    $('#vetado').attr('onclick', 'mostrar(1);');
}
	
}

mostrar(<?php echo $vetado?>);
</script> 
