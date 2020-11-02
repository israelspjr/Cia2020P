<?php
//pagina conteudo o formulario 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Chamados = new Chamados();
$Funcionario = new Funcionario();
$Setor = new Setor();
		
$idChamados = $_REQUEST['id'];

$funcionario_idFuncionario = $_SESSION['idUsuario'];

if($idChamados != '' && $idChamados  > 0){

	$valor = $Chamados->selectChamados('WHERE idChamados ='.$idChamados);
	
	$funcionario_idFuncionario = $valor[0]['funcionario_idFuncionario'];
	$obs = $valor[0]['solicitacao'];
	$tipoUrgencia = $valor[0]['tipoUrgencia'];
	$dataSolicitacao = $valor[0]['dataSolicitacao'];
	$dataSolucao = $valor[0]['dataSolucao'];
	$testado = $valor[0]['testado'];
	$finalizado = $valor[0]['finalizado'];	
	$sistema = $valor[0]['sistema']; 
	$idSetor = $valor[0]['setor_idSetor'];
	$descartado = $valor[0]['descartado'];
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Chamados</legend>
    <form id="form_Chamados" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idChamados ?>" />
      
      <div class="esquerda">
      <p>
     <!--   <label for="Funcionario">Funcionário : <?php echo $_SESSION['nome_SS']?></label>-->
        <br /><label>Funcionário : </label>
        <?php echo $Funcionario->selectFuncionarioSelect($funcionario_idFuncionario); ?>
        
<!--        <input type="hidden" name="funcionario_idFuncionario" id="funcionario_idFuncionario" value="<?php $funcionario_idFuncionario ?> "/>-->
      </p>
       <p>
        <label for="sistema">Sistema :</label>
      <select name="sistema" id="sistema">
      <option value="-" >Selecione</option>
      <option value="1" <?php if ($sistema == 1) {?> selected="selected" <?php } ?>>Cursos</option>
      <option value="2" <?php if ($sistema == 2) {?> selected="selected" <?php } ?>>Consultoria</option>
      <option value="3" <?php if ($sistema == 3) {?> selected="selected" <?php } ?>>Site Principal</option>
      <option value="4" <?php if ($sistema == 4) {?> selected="selected" <?php } ?>>Profcerto</option>
      <option value="5" <?php if ($sistema == 5) {?> selected="selected" <?php } ?>>Outros Sites</option>
      <option value="6" <?php if ($sistema == 6) {?> selected="selected" <?php } ?>>Hardware</option>
      <option value="7" <?php if ($sistema == 7) {?> selected="selected" <?php } ?>>Servidores</option>
      <option value="8" <?php if ($sistema == 8) {?> selected="selected" <?php } ?>>Emails</option>
      </select>
     
                     <span class="placeholder">Campo Obrigatório</span> </p>
                
       
      </p>
        <p>
        <label for="tipoUrgencia">Tipo de solicitação :</label>
        <select name="tipoUrgencia" id="tipoUrgencia">
        <option value="-">Selecione</option>
        <option value="1" <?php if ($tipoUrgencia == 1) {?> selected="selected" <?php } ?>>Urgente 1 - Vendas</option>
        <option value="2" <?php if ($tipoUrgencia == 2) {?> selected="selected" <?php } ?>>Urgente 2 - Financeiro</option>
        <option value="3" <?php if ($tipoUrgencia == 3) {?> selected="selected" <?php } ?>>Urgente 3 - Administrativo</option>
        <option value="4" <?php if ($tipoUrgencia == 4) {?> selected="selected" <?php } ?>>Urgente 4 - Terceiros</option>
        <option value="5" <?php if ($tipoUrgencia == 5) {?> selected="selected" <?php } ?>>Urgente 5 - Outros</option>
        <option value="6" <?php if ($tipoUrgencia == 6) {?> selected="selected" <?php } ?>>Melhoria 1 - Vendas</option>
        <option value="7" <?php if ($tipoUrgencia == 7) {?> selected="selected" <?php } ?>>Melhoria 2 - Administrativo</option>
        <option value="8" <?php if ($tipoUrgencia == 8) {?> selected="selected" <?php } ?>>Melhoria 3 - Outros</option>
        </select>
        
      </p>
       <p>
        <label for="dataSolicitacao">Data da Solicitação / Finalização:</label>
       <input type="text" name="dataSolicitacao" id="dataSolicitacao" class="data" value="<?php echo Uteis::exibirData($dataSolicitacao)?>"/>
      </p>
      <p>
      <label>Setor que solicitou</label>
      <?php echo $Setor->selectSetorSelectC($idSetor, "required"); ?>
      </p>
      </div>
      <div class="direita">
     
      
      <p>
        <label for="dataSolucao">Data da Solução :</label>
       <input type="text" name="dataSolucao" id="dataSolucao" class="data" value="<?php echo Uteis::exibirData($dataSolucao)?>"/>
      </p>
      <p>
        <label for="testado">Testado :</label>
        <input type="checkbox" name="testado" id="testado" value="1" <?php if($testado != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="finalizado">Finalizado:</label>
        <input type="checkbox" name="finalizado" id="finalizado" value="1" <?php if($finalizado != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <p>
        <label for="finalizado">Descartado:</label>
        <input type="checkbox" name="descartado" id="descartado" value="1" <?php if($descartado != 0){ ?> checked="checked" <?php } ?> />
      </p>
      
      
      <p>
      <label>Escolha o setor para enviar a notificação de finalização:</label>
  <?php echo $Setor->selectSetorSelectMulti(); ?>
      
      </p>
      
      
      </div>
      <div class="linha-inteira">
      <p>
        <label for="solicitacao">Solicitação :</label>
        <textarea name="obs_base" id="obs_base" cols="100" rows="15"><?php echo $obs?></textarea>
        <textarea name="obs" id="obs" ></textarea>
        <input id="upload" type="file" name="upload" style="display: none;" onchange="" />
   
	   
      </p>
                
       
      </p>
      
  <center><strong>Não esquecer de fazer um tutorial</strong></center>
  </div>
      <div class="esquerda">
     
       <button class="button blue" onclick="postForm_editor('obs', 'form_Chamados', '<?php echo CAMINHO_MODULO?>configuracoes/chamados/grava.php')">Salvar</button>
       
      
       
      
    </form>
  </fieldset>

  
  
  
  
 </div>
  
 

 

<script>
viraEditor('obs');
ativarForm();
</script> 
