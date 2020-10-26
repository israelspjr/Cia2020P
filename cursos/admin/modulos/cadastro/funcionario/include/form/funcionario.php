<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$Funcionario = new Funcionario();
$TipoDocumentoUnico = new TipoDocumentoUnico();

$idFuncionario = $_GET['id'];

if( $idFuncionario ){

	$valorFuncionario = $Funcionario->selectFuncionario('WHERE idFuncionario='.$idFuncionario);
	
	$idFuncionario = $valorFuncionario[0]['idFuncionario'];
	$estadoCivilIdEstadoCivil = $valorFuncionario[0]['estadoCivil_idEstadoCivil'];
	$paisIdPais = $valorFuncionario[0]['pais_idPais'];
	$nome = $valorFuncionario[0]['nome'];
	$nomeExibicao = $valorFuncionario[0]['nomeExibicao'];
	$sexo = $valorFuncionario[0]['sexo'];
	$dataNascimento = Uteis::exibirData($valorFuncionario[0]['dataNascimento']);
	$rg = $valorFuncionario[0]['rg'];
	$tipoDocumentoUnicoIdTipoDocumentoUnico = $valorFuncionario[0]['tipoDocumentoUnico_idTipoDocumentoUnico'];
	$documentoUnico = $valorFuncionario[0]['documentoUnico'];
	$senhaAcesso = EncryptSenha::B64_Decode($valorFuncionario[0]['senhaAcesso']);
	$obs = $valorFuncionario[0]['obs'];
	$inativo = $valorFuncionario[0]['inativo'];
	$foto = $valorFuncionario[0]['foto'];
	$cargo = $valorFuncionario[0]['cargo'];
	$admicao = Uteis::exibirData($valorFuncionario[0]['admicao']);
	$demicao = Uteis::exibirData($valorFuncionario[0]['demicao']);
	$horasTrabalho = Uteis::exibirHorasInput($valorFuncionario[0]['horasTrabalho']);
}

?>

<fieldset>
  <form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."funcionario/"?>include/acao/funcionario.php" style="display:none;">
    <input type="hidden" id="acao" name="acao" value="foto" />
    <input type="file" id="add_foto" name="foto" />
  </form>
  <script>
        $(document).ready(function(){
         /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
         $('#add_foto').on('change',function(){
            $('#visualizar').html('Enviando..');
            $('#formulario').ajaxForm({
                target:'#visualizar' // o callback será no elemento com o id #visualizar
             }).submit();
         });
     })
    </script>
  <legend>Dados pessoais</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="ABRIR FORMULÁRIO" id="img__" onclick="abrirFormulario('div_form_funcionario', 'img__');" />
  <div class="agrupa" id="div_form_funcionario">
    <form id="form_funcionario" class="validate" action="" method="post" onsubmit="return false" >
      <div class="esquerda">
        <p>
          <label>Nome:</label>
          <input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Nome para exibição:</label>
          <input type="text" name="nomeExibicao" id="nomeExibicao" class="required" value="<?php echo $nomeExibicao?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Qual documento?:</label>
          <?php echo $TipoDocumentoUnico->selectTipoDocumentoUnicoSelect("required", $tipoDocumentoUnicoIdTipoDocumentoUnico);?> <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Número do documento:</label>
          <input type="text" name="documentoUnico" id="documentoUnico" class="required" value="<?php echo $documentoUnico?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>RG:</label>
          <input type="text" name="rg" id="rg" class="rg"  value="<?php echo $rg?>"/>
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
          <label>Pais de origem:</label>
          <?php echo $Pais->selectPaisSelect("required", $paisIdPais);?> <span class="placeholder">Campo Obrigatório</span></p>
        </p>
      </div>
      <div class="direita">
        <p>
          <label>Foto:</label>
          <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
        <div id="visualizar">
          <?php if($foto != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/foto/funcionario/miniatura-<?php echo $foto;?>" />
          <input type="hidden" name="foto_oculta" value="<?php echo $foto?>" required="" />
          <?php }else{?>
          <input type="hidden" name="foto_oculta" value="<?php echo $foto?>" required="" />
          <?php }?>
        </div>
        </p>
        <p>
          <label>Cargo:</label>
          <input type="text" name="cargo" id="cargo" class="required" value="<?php echo $cargo?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Data de admissão:</label>
          <input type="text" name="admicao" id="admicao" class="required data" value="<?php echo $admicao?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Data de demissão:</label>
          <input type="text" name="demicao" id="demicao" class="data" value="<?php echo $demicao?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
          <p><label>Horas diárias de trabalho</label>
          <input type="time" name="horasTrabalho" id="horasTrabalho" value="<?php echo $horasTrabalho?>" class="horas required" size="5" />
       	<p>
          <label >Senha:</label>      
           <img src="<?php echo CAMINHO_IMG."senha.png";?>" title="GERAR SENHA" onclick="geraSenha('password', 'rpassword');" />
          <input type="password" name="senhaAcesso" id="password" class="required password" value="<?php echo $senhaAcesso?>"/>
       <!--  <input type="checkbox" value="1" onclick="mostraSenha(this)" /><small>mostrar a senha</small>-->
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Confirma Senha:</label>
          <input type="password" name="senhaAcesso2" id="rpassword" class="required password" value="<?php echo $senhaAcesso?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
      </div>
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_funcionario', '<?php echo CAMINHO_CAD."funcionario/include/acao/funcionario.php?id=$idFuncionario"?>')" >Salvar</button>
        </p>
      </div>
    </form>
  </div>
</fieldset>

<script>
ativarForm();

$('#tipoDocumentoUnico_idTipoDocumentoUnico').attr('onchange','tipoDocumentoUnico("form_funcionario")');
tipoDocumentoUnico("form_funcionario");
</script>