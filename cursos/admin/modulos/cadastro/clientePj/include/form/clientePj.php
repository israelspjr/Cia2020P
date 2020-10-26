<fieldset>
  <form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."clientePj/"?>include/acao/clientePj.php" style="display:none">
    <input type="hidden" id="acao" name="acao" value="foto" />
    <input type="file" id="add_foto" name="foto" />
  </form>
  <legend>Dados pessoais</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_clientePj', 'img_');" />
  <div class="agrupa" id="div_form_clientePj">
    <form id="form_clientePj" class="validate" action="" onsubmit="return false" method="post" >
     <div class="esquerda">
        <p>
          <label>Razão social:</label>
          <input type="text" name="razaoSocial" id="razaoSocial" class="required" value="<?php echo $razaoSocial ?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Nome fantasia:</label>
          <input type="text" name="nomeFantasia" id="nomeFantasia" value="<?php echo $nomeFantasia ?>" />
        </p>
        <p>
          <label>Tipo Cliente:</label>
          <?php echo $TipoCliente->selectTipoClienteSelect("required", $idTipoCliente);?> <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
        <p>
          <label>Empresa Principal (caso a empresa cadastrada seja sub empresa):</label>
          <?php echo $ClientePj->selectClientePjSelect($clientePj_idClientePj, "");?> <span class="placeholder"></span> </p>
        <p>
          <label>CNPJ:</label>
          <input type="text" name="cnpj" id="cnpj" class="required cnpj" value="<?php echo $cnpj ?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label for="isentoIE">
            <input type="checkbox" name="isentoIE" id="isentoIE" value="1" onclick="verificaIsento();" <?php echo $inscricaoEstadual == "ISENTO" ? "checked": "" ?> />
            Isento</label>
          <label>Inscricao estadual:</label>
          <input type="text" name="inscricaoEstadual" id="inscricaoEstadual" class="" value="<?php echo $inscricaoEstadual ?>" <?php echo $inscricaoEstadual == "ISENTO" ? "disabled": "" ?>/>
        </p>
        <p>
          <label>Cliente desde:</label>
          <input type="text" name="dataContratacao" id="dataContratacao" class="required data"  value="<?php echo $dataContratacao ?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
              <p>
          <label>Como Conheceu:</label>
       <?php echo $Conheceu->selectComoConheceuSelect("",$conheceu, " AND excluido = 0") ?>
       </p>
      </div>
      <div class="direita">
        <p>
          <label>Logomarca:</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" />
        <div id="visualizar">
          <?php if($logo != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/foto/clientePj/miniatura-<?php echo $logo;?>" />
          <input type="hidden" name="foto_oculta" value="<?php echo $logo?>" required="required" />
          <?php }?>
        </div>
        </p>
        <p>
          <label>Senha:</label>
          <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />
          <input type="password" name="senhaAcesso" id="password" class="required password"  value="<?php echo $senhaAcesso ?>"/>
          <span class="placeholder">Campo Obrigatório</span>
          <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>
           </p>
     	  <p>
          <label>Confirma Senha:</label>
          <input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso ?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Frequencia mínima exigida (%):</label>
          <input type="text" name="frequenciaMinimaExigida" id="frequenciaMinimaExigida" class="numeric percentual" value="<?php echo $frequenciaMinimaExigida ?>" />
          <span class="placeholder"></span> </p>
          <p>
          <label>Integrantes no grupo </label>
          <input type="text" name="intGrupo" id="intGrupo" class="numeric" value="<?php echo $intGrupo?>" />
        <p>
          <label for="faltaJustificadaPresenca">
            <input type="checkbox" name="faltaJustificadaPresenca" value="1" id="faltaJustificadaPresenca" <?php if($faltaJustificadaPresenca != 0){ ?> checked="checked" <?php } ?> />
            Falta justificada, vale como presença:</label>
          <label for="inativo">
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs ?></textarea>
        </p>
        <p>
          <label>    <div style="    width: 48px;    float: left;    margin-top: -4px;"><input type="checkbox" name="empresaIndica" id="empresaIndica" <?php if($empresaIndica == 1){ ?> checked="checked" <?php } ?>  value="1"/> <img src="<?php echo CAMINHO_IMG."diamante2.jpg"?>" width="18" height="18" title="Empresa Indica" /> </div><div id="aba_indicacoes_clientepf" divexibir="div_indicacoes_clientepf" class="aba_interna" style="cursor: pointer;">Empresa Indica</div> </label>
          <label> <label> <input type="checkbox" name="temInfluencia" id="temInfluencia" <?php if($temInfluencia == 1){ ?> checked="checked" <?php } ?>  value="1"/> Potencial de crescimento? </label>
          </p>
      </div>
      <p>
        <button class="button blue" onclick="postForm('form_clientePj', '<?php echo CAMINHO_CAD."clientePj/"?>include/acao/clientePj.php?id=<?php echo $_GET['id']?>');">Salvar</button>
      </p>
    </form>
  </div>
</fieldset>
<script>
   
/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_foto').on('change',function(){
	$('#visualizar').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#formulario').ajaxForm({
		target:'#visualizar' // o callback será no elemento com o id #visualizar
	}).submit();
});


function verificaIsento(){
	if( $('#isentoIE').is(':checked') ){	
		$('#inscricaoEstadual').val('ISENTO').attr('disabled', 'disabled');
	}else{
		$('#inscricaoEstadual').val('').removeAttr('disabled');
	}
}

function obrigatoriadadeDocumentoUnico(){
	var valTipoCliente = $('#TipoCliente_idTipoCliente').val();
	var tipoDocumentoUnico = $('#tipoDocumentoUnico_idTipoDocumentoUnico');
	var documentoUnico = $('#cnpj');
	
	if( valTipoCliente == 3 ){
		//documento deve ser obrigatório
		documentoUnico.addClass('required').find('~ span').hide();	
		
	}else{		
		documentoUnico.removeClass('invalid required').find('~ span').hide();	
						
	}
}
obrigatoriadadeDocumentoUnico();
$('#form_clientePj #TipoCliente_idTipoCliente').attr('onchange', 'obrigatoriadadeDocumentoUnico()');

</script> 
