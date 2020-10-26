 <?php
 $Conheceu = new ComoConheceu();
$idPais = ID_PAIS;

$proposta = $_GET['p'];


if($idClientePf != '' && $idClientePf  > 0){

	$valorClientePF = $ClientePf->selectClientepf('WHERE idClientePf='.$idClientePf);
	
	$idClientePf = $valorClientePF[0]['idClientePf']; 
	$idTipoCliente = $valorClientePF[0]['tipoCliente_idTipoCliente'];  
	$nome =$valorClientePF[0]['nome']; 
	$nomeExibicao = $valorClientePF[0]['nomeExibicao']; 
	$sexo = $valorClientePF[0]['sexo']; 
	$dataNascimento = Uteis::exibirData($valorClientePF[0]['dataNascimento']);  
	$idEstadoCivil = $valorClientePF[0]['estadoCivil_idEstadoCivil']; 
	$idPais = $valorClientePF[0]['pais_idPais']; 
	$inativo = $valorClientePF[0]['inativo']; 
	$foto = $valorClientePF[0]['foto']; 
	$fotoThumb = $valorClientePF[0]['foto']; 
	$cargo = $valorClientePF[0]['cargo'];  
	$clientePjIdClientePj = $valorClientePF[0]['clientePj_idClientePj']; 
	$naoReceberEmail = $valorClientePF[0]['naoReceberEmail'];  
	$idTipoDocumentoUnico = $valorClientePF[0]['tipoDocumentoUnico_idTipoDocumentoUnico']; 
	$documentoUnico = $valorClientePF[0]['documentoUnico']; 
	$senhaAcesso = EncryptSenha::B64_Decode($valorClientePF[0]['senhaAcesso']); 
	$obs = htmlspecialchars($valorClientePF[0]['obs']);
	$rg = $valorClientePF[0]['rg'];  
	$dataCadastro = $valorClientePF[0]['dataCadastro']; 
	$inativaPsa = $valorClientePF[0]['inativaPsa']; 
	$rf = $valorClientePF[0]['rf'];
	$subEmpresa = $valorClientePF[0]['subEmpresa'];
	$cc = $valorClientePF[0]['cc'];
	$politica = $valorClientePF[0]['politica'];
	$politicaA = $valorClientePF[0]['politicaA'];
	$dataPolitica = $valorClientePF[0]['dataPolitica'];
	$motivo = $valorClientePF[0]['motivo'];
	$dRetorno = Uteis::exibirData($valorClientePF[0]['dataRetorno']);
	$dataInativar = Uteis::exibirData($valorClientePF[0]['dataInativar']);
	$area = $valorClientePF[0]['area'];
	$excluido = $valorClientePF[0]['excluido'];
	$conheceu = $valorClientePF[0]['conheceu'];
	$cat = explode(",", $valorClientePF[0]['categoria']);
	$alunoIndica = $valorClientePF[0]['alunoIndica'];
	$temInfluencia = $valorClientePF[0]['influencia'];
	$cargoPoder = $valorClientePF[0]['poder'];
	$idFinanceiro = $valorClientePF[0]['id_migracao'];
	$clientePjIdClientePj2 = $valorClientePF[0]['clientePj_idClientePj2'];
	
}

if($proposta != '' && $proposta  > 0){
$Proposta = new Proposta();
$rp = $Proposta->selectProposta("WHERE idProposta = ".$proposta);
$clientePjIdClientePj = $rp[0]['clientePj_idClientePj'];
}

if ($idClientePf == 0) {
$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];	
}
?>

<fieldset>
  <legend>Dados básicos (campos com * são obrigátorios)</legend>  
    <form id="formularioPf" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."clientePf/include/acao/clientepf.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="foto" />
      <input type="hidden" id="destino" name="destino" value="#visualizar" />
      <input type="file" id="add_foto" name="foto" onchange="postFileForm('formularioPf')" />
    </form>
    
      <!-- UPLOAD DO FILE (POLITICA) -->
  <form id="form_uploadFile" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."clientePf/"?>include/acao/clientepf.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="file" />
    <input type="file" id="add_file" name="file" />
  </form>
    
   <form id="form_clientepf" class="validate" action="" method="post"  onsubmit="return false" >
   <input type="hidden" name="idIntengranteGrupo" id="idIntengranteGrupo" value="<?php echo $idIntegranteGrupo?>"  />
      <div class="esquerda">
        
          <label>Nome *:</label>
          <input type="text" name="nome" id="nome" class="required" required value="<?php echo $nome?>" />
       <!--   <span class="placeholder">Campo Obrigatório</span> 
          -->
          <label>Nome para exibição *:</label>
          <input type="text" name="nomeExibicao" id="nomeExibicao" value="<?php echo $nomeExibicao?>" class="required" />
         <!-- <span class="placeholder">Campo Obrigatório</span>
       -->
         
         <label>Tipo Cliente *:</label>
         <?php echo $TipoCliente->selectTipoClienteSelect("required", $idTipoCliente);?> <!--<span class="placeholder">Campo Obrigatório</span> </p>
 -->
       <label>Como Conheceu *:</label>
       <?php echo $Conheceu->selectComoConheceuSelect("required",$conheceu, " AND excluido = 0") ?>

          <label>Qual documento? *:</label>
          <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect("required", $idTipoDocumentoUnico);?> <!--<span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>Nº do documento *:</label>
          <input type="text" name="documentoUnico" id="documentoUnico" class="required" value="<?php echo $documentoUnico?>" />
     <!--     <span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>RG:</label>
          <input type="text" name="rg" id="rg" class="" value="<?php echo $rg?>"  />
   <!--        <span class="placeholder">Campo Obrigatório</span> </p>
              <p>-->
          <label>Estado Civil *:</label>
          <?php echo $EstadoCivil->selectEstadocivilSelect("required", $idEstadoCivil);?> <!-- <span class="placeholder">Campo Obrigatório</span> </p>
          <p>-->
          <label>Id Financeiro: (Opcional, utilizado em integração com sistema financeiro)</label>
        <input type="text" id="idFinanceiro" name="idFinanceiro" value="<?php echo $idFinanceiro?>" />
  
         <label>Registro de Funcionário: (opcional, caso a empresa cliente forneça este dado)</label>
        <input type="text" id="rf" name="rf" value="<?php echo $rf?>" />
   
         <label>Centro de custo: (opcional, caso a empresa cliente forneça este dado)</label>
        <input type="text" id="cc" name="cc" value="<?php echo $cc?>" />
   
          <label>Sexo *:</label>
          <select name="sexo" id="sexo" class="required">
            <option <?php if($sexo ==""){ ?> selected="selected" <?php } ?>  value="">Selecione</option>
            <option <?php if($sexo == "M"){ ?> selected="selected" <?php } ?>  value="M">Masculino</option>
            <option <?php if($sexo == "F"){ ?> selected="selected" <?php } ?>  value="F">Feminino</option>
          </select>
   <!--         <span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>Data de Nascimento *:</label>
          <input type="text" name="dataNascimento" id="dataNascimento" class=" required data" value="<?php echo $dataNascimento?>"  />
   <!--        <span class="placeholder">Campo Obrigatório</span> </p>
    
        <p>-->
      
        <label>Categoria:</label>
        
        <input type="checkbox" id="sem_estrela" <?php if (in_array("0", $cat)) {echo  "checked"; } ?> />
        <img src="<?php echo CAMINHO_IMG."estrela_branco.gif"?>"> Aluno sem nehuma estrela<br>
        <input type="checkbox" name="categoria[]" id="estrela_1" value="1" <?php if (in_array("1", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> é aluno há mais de 3 anos(Lealdade)<br>
        <input type="checkbox" name="categoria[]" id="estrela_2" value="2" <?php if (in_array("2", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> aluno indica (registrar indicação) ou é RH (PROMOTOR)<br>
        <input type="checkbox" name="categoria[]" id="estrela_3" value="3" <?php if (in_array("3", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> faz aula NaTela <br>
        <input type="checkbox" name="categoria[]" id="estrela_4" value="4" <?php if (in_array("4", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> paga valor tabela ou premium e/ou realiza mais de três horas semanais (LUCRO)<br>
        <input type="checkbox" name="categoria[]" id="estrela_5" value="5" <?php if (in_array("5", $cat)) {echo  "checked"; }?> /><img src="<?php echo CAMINHO_IMG."estrela.gif"?>"> tem aulas individuais (ALUNO É FORMADOR DE OPINIÃO,TEM PODER)<br>
      </div>
       <div class="direita">
   
          <label>Foto:</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
        <div id="visualizar">
          <?php if($foto != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/foto/clientePf/miniatura-<?php echo $fotoThumb;?>" />
          <?php }?>
          <input type="hidden" name="foto_oculta" value="<?php echo $foto;?>" />
        </div>
  
        <label> Política de idioma assinada</label>
        <img src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file').click();" title="Anexar novo" /></label>
        <div id="visualizarFile">
          <?php if($politica != ''){?>
          <a target="_blank" href="<?php echo CAMINHO_UP?>imagem/foto/clientePf/<?php echo $politica;?>"> <img src="<?php echo CAMINHO_IMG."contrato.png"?>" title="Visualizar" /> </a>
          <input type="hidden" name="file_oculto" value="<?php echo $politica?>" required="" />
          <?php }?>
          <label>Concorda com a política de idioma da sua empresa?
          <input type="radio" name="politicaA" value="1" required="required" <?php if ($politicaA == 1) {echo "checked=checked"; } ?>/> Sim
          <?php if ($politicaA != 1) { ?>
          <input type="radio" name="politicaA" value="0" required="" <?php if ($politicaA == 0) {echo "checked=checked"; } ?>/> Não
          <?php } else {
			  echo "Data da assinatura eletrônica:".Uteis::exibirData($dataPolitica); 
			    } ?></label>
        </div>
 
          <label>País de origem *:</label>
          <?php echo $Pais->selectPaisSelect("required", $idPais);?> <!--<span class="placeholder">Campo Obrigatório</span> </p>
        -->
            <label>Empresa à qual pertence *: (empresa que o aluno trabalha)</label>
          <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, ""," AND inativo = 0");?> <!--<span class="placeholder">Campo Obrigatório</span> </p>
        <p>
   -->
          <label>Empresa à qual pertence 2:<strong style="display:block;" title="Possibilidade de vincular aluno em empresas, caso este faça aulas particulares em paralelo">?</strong></label>
          <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj2, "","",2);?>
          
        <label>Sub-empresa à qual pertence: <strong style="display:block" title=" Caso o aluno pertença a uma empresa do grupo da empresa principal e precise de relatórios separados">?</strong> </label>
        <?php echo $ClientePj->selectClientePjSelectFilha($subEmpresa, "", " AND clientePj_idClientePj is not null"); ?>
    
        <p>
          <label>Cargo *:</label>
          <input type="text" name="cargo" id="cargo" class="required" value="<?php echo $cargo?>" />
     <!--     <span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>Senha *:</label>
         <!-- <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />-->
          <input type="password" name="senhaAcesso" id="password" class="required password" value="<?php echo $senhaAcesso?>"  />
     <!--     <span class="placeholder">Campo Obrigatório</span>-->
          <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
  <!--         </p>
          
        <p>-->
          <label>Confirma Senha *:</label>
          <input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso?>" />
  <!--         <span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
   <!--         <span class="placeholder">Campo Obrigatório</span> </p>
        <p>-->
          <label>
            <input type="checkbox" name="naoReceberEmail" id="naoReceberEmail" <?php if($naoReceberEmail != 0){ ?> checked="checked" <?php } ?> value="1" />
            Não receberá e-mail</label>
 
        <label>
            <input type="checkbox" name="inativaPsa" id="inativaPsa" <?php if($inativaPsa == 1){ ?> checked="checked" <?php } ?>  value="1"/>
            Não enviar PSA</label>
            <input type="hidden" name="idProposta" value="<?php echo $rp[0]['idProposta']; ?>">
 
           <label>
            <input type="checkbox" name="inativo" id="inativo" <?php if($inativo != 0){ ?> checked="checked" <?php } ?>  value="1" onclick="dataInativacao(1);"/>Inativo </label>  
            <label> <input type="checkbox" name="excluido" id="excluido" value="1" <?php if ($excluido == 1){ echo "checked"; } ?> /> Excluído </label> 
           
            <div id="divDataInativar" style="display:none;">
            <label>Data:  </label>
            <input type="text" name="dataInativar" id="dataInativar" class="data " maxlength="10" autocomplete="off"  value="<?php echo $dataInativar?>" />
           <!-- <span class="placeholder">Campo Obrigatório</span> </p>-->
             <label>Motivo:  </label>
            <input type="text" name="motivo" id="motivo" class=" "  autocomplete="off"  value="<?php echo $motivo?>" />
             <label>
              <label>Data retorno *:  </label>
            <input type="text" name="dRetorno" id="dRetorno" class="data " maxlength="10" autocomplete="off"  value="<?php echo $dRetorno?>" />
     <!--       <span class="placeholder">Campo Obrigatório</span> </p>
            
          <p>-->
      <label>Qual área deve entrar em contato (Aluno inativo)?</label>
      <input type="radio" name="area" id="area" value="0" <?php if ($area == 0){ echo "checked";} ?> />Comercial
      <input type="radio" name="area" id="area" value="1" <?php if ($area == 1){ echo "checked";} ?>/>Coordenação
 </div>
     <label>   <div style="    width: 48px;    float: left;    margin-top: -4px;"> <input type="checkbox" name="alunoIndica" id="alunoIndica" <?php if($alunoIndica == 1){ ?> checked="checked" <?php } ?>  value="1"/> <img src="<?php echo CAMINHO_IMG."diamante2.jpg"?>" width="18" height="18" title="Aluno Indica" /> </div><div id="aba_indicacoes_clientepf" divexibir="div_indicacoes_clientepf" class="aba_interna" style="cursor: pointer;">Aluno Indica</div> </label>
      <label> <input type="checkbox" name="temInfluencia" id="temInfluencia" <?php if($temInfluencia == 1){ ?> checked="checked" <?php } ?>  value="1"/> Têm influência? </label>
        <label> <input type="checkbox" name="cargoPoder" id="cargoPoder" <?php if($cargoPoder == 1){ ?> checked="checked" <?php } ?>  value="1"/> Tem um cargo de poder na empresa? </label></p>
</div>
      <div class="linha-inteira">
   
        <p>
          <button class="button blue" onclick="postForm('form_clientepf', '<?php echo CAMINHO_CAD."clientePf/include/acao/clientepf.php?id=$idClientePf"?>')">Salvar</button>
        </p>
      </div>
    </form>
 
</fieldset>
<script>
ativarForm();
function obrigatoriadadeDocumentoUnico(form){
	
	var eForm = $('#' + form);

	var tipoDocumentoUnico = eForm.find('#tipoDocumentoUnico_idTipoDocumentoUnico');
	var documentoUnico = eForm.find('#documentoUnico');
	var nascimento = eForm.find('#dataNascimento');
	
	if( eForm.find('#TipoCliente_idTipoCliente').val() == 3 ){
		tipoDocumentoUnico.addClass('required').find('~ span').hide();
		documentoUnico.addClass('required').find('~ span').hide();	
		documentoUnico.attr("placeholder", "Campo obrigatório");
		nascimento.attr("placeholder", "Campo obrigatório");		
	}else{		
		tipoDocumentoUnico.removeClass('invalid required').find('~ span').hide();
		documentoUnico.removeClass('invalid required').find('~ span').hide();
		documentoUnico.removeAttr('placeholder');
		nascimento.removeClass('invalid required').find('~ span').hide();									
		nascimento.removeAttr('placeholder');
	}
	ativarForm();
}

$('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("form_clientepf")');
$('#form_clientepf #TipoCliente_idTipoCliente').attr('onchange', 'obrigatoriadadeDocumentoUnico("form_clientepf")');

obrigatoriadadeDocumentoUnico("form_clientepf");
tipoDocumentoUnico("form_clientepf");

function dataInativacao() {

var checado = $("#inativo").is(":checked");

if (checado == true) {

$('#divDataInativar').show();
$('#dataInativar').prop('required',true);
} else {
$('#divDataInativar').hide();
$('#dataInativar').prop('required',false);

}

}


/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});

</script> 
