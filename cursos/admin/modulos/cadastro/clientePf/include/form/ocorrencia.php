<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Ocorrencia = new Ocorrencia();
$Funcionario = new Funcionario();

$idClientePf = $_GET['id'];
if ($idClientePf == '') {
	$idClientePf = $_GET['idClientePf'];
}

$funcionario_idFuncionario = $_SESSION['idUsuario'];

$idOcorrencia = $_REQUEST['idOcorrencia'];
		
if($idOcorrencia != '' && $idOcorrencia  > 0){

	$valor = $Ocorrencia->selectOcorrencia('WHERE idOcorrencia  ='.$idOcorrencia );
	
	$obs = $valor[0]['observacao'];
	$dataContato = $valor[0]['dataContato'];
	$dataRetorno = $valor[0]['dataRetorno'];
	$statusO = $valor[0]['status'];
//	echo $status0;
	$outro = $valor[0]['outro'];
	
	
}
if ($dataContato == '') {
		$dataContato = date("Y-m-d");
		
	}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Ocorrências</legend>
    <form id="form_Chamados" class="validate"  method="post" onsubmit="return false" >
      <input name="idOcorrencia" type="hidden" value="<?php echo $idOcorrencia ?>" />
       <input name="idClientePf" type="hidden" value="<?php echo $idClientePf ?>" />

<div class="esquerda">
       <p>
        <label for="status">Status :</label>
      <select name="status" id="status" class="required">
      <option value="-" >Selecione</option>
      <option value="1" <?php if ($statusO == 1) {?> selected="selected" <?php } ?>>Continuar contato</option>
      <option value="2" <?php if ($statusO == 2) {?> selected="selected" <?php } ?>>Não tem interesse</option>
      <option value="3" <?php if ($statusO == 3) {?> selected="selected" <?php } ?>>Tem interesse em promoções</option>
     </select>
     
                     <span class="placeholder">Campo Obrigatório</span> </p>
                
       
      </p>
      <p>
     <label for="Outro">Outra pessoa:</label>
     <input type="text" name="outro" id="outro" value="<?php echo $outro?>" />
     </p>
      </div>
  <div class="direita">
   <p>
        <label for="Funcionario">Funcionário : <?php echo $_SESSION['nome_SS']?></label>
        <br /><label>Selecionar outro funcionário : </label>
        <?php echo $Funcionario->selectFuncionarioSelect($funcionario_idFuncionario); ?>
       </p>
      </div>
      
      <div class="linha-inteira">    
      <p>
        <label for="solicitacao">Ocorrência :</label>
      <textarea name="obs2_base" id="obs2_base" cols="100" rows="15"><?php echo $obs?></textarea>
        <textarea name="obs2" id="obs2" ></textarea>
        <input id="upload" type="file" name="upload" style="display: none;" onchange="" />
      
      </p>
      </div>
      <div class="esquerda">
      <p>
        <label for="dataSolicitacao">Data de contato :</label>
      <input type="text" name="dataContato" id="dataContato" class="data required" value="<?php echo Uteis::exibirData($dataContato)?>" /> 
      </p>
      <p>
        <label for="dataRetorno1">Data de Retorno :</label>
       <input type="text" name="dataRetorno1" id="dataRetorno1" class="data required" value="<?php echo Uteis::exibirData($dataRetorno)?>" />
      </p>
      </div>
      <div class="linha-inteira">
       <button class="button blue" onclick="postForm_editor('obs2', 'form_Chamados', '<?php echo CAMINHO_CAD."clientePf/include/acao/ocorrencia.php"?>')">Salvar</button>
       </div>
      
    </form>
  </fieldset>
</div>
<script>
viraEditor('obs2');
ativarForm();
</script> 
