<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$IndicacaoClientePf = new IndicacaoClientePf();
	
	$idClientePf = $_GET['id'];
	$clientePfIdClientePfIndicado = $_GET['clientePfIdClientePfIndicado'];
	$clientePjIdClientePjIndicado = $_GET['clientePjIdClientePjIndicado'];
	$idIndicacaoClientePf = $_REQUEST['idIndicacaoClientePf'];

if ($idIndicacaoClientePf > 0 ) {	
	$rs = $IndicacaoClientePf->selectIndicacaoclientepf(" WHERE idIndicacaoClientePf = ". $idIndicacaoClientePf);
	
	
}
//	Uteis::pr($rs);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Indicações do aluno</legend>
    
    <div class="esquerda">
    <form id="form_indicacaoClientePf" class="validate" method="post" action="" onsubmit="return false" >
      <input name="clientePfIdClientePfIndicado" type="hidden" value="<?php echo $clientePfIdClientePfIndicado?>" />
      <input name="clientePjIdClientePjIndicado" type="hidden" value="<?php echo $clientePjIdClientePjIndicado?>" />
      <?php //if($clientePfIdClientePfIndicado == 1) {?>
   
             <p><label>Clientes indicados:</label></p>
      <textarea name="obs" id="obs"  rows="10" cols="30" required ><?php echo $obs ?></textarea>
   
      <!--      <label>Buscar cliente pessoa física indicado:</label>-->
            <?php 		
			$and = " AND idClientePf NOT IN(".$idClientePf.") ";		
			$and .= " AND idClientePf NOT IN ("; 
			$and .= "	SELECT COALESCE(clientePf_idClientePfIndicado,0) FROM indicacaoClientePf WHERE clientePf_idClientePf = ".$idClientePf;
			$and .= ") 	";
			
			$ClientePfIndicacao = new ClientePf();
	//		echo $ClientePfIndicacao->selectClientePfSelect("required", $idClientePf, $and)?><!--<span class="placeholder">Campo Obrigatório</span> -->
            <!-- auto complte da tabela ClientePf--> </p>
          <p>
      <?php  //}
	  
	//   if($clientePjIdClientePjIndicado == 1) {?>      
       	<p>
      <!--      <label>Buscar cliente pessoa jurídica indicado:</label>-->
            <?php 						
			$and = " AND idClientePj NOT IN ("; 
			$and .= "	SELECT COALESCE(clientePj_idClientePjIndicado,0) FROM indicacaoClientePf WHERE clientePf_idClientePf = ".$idClientePf;
			$and .= ") ";
			$ClientePjIndicacao = new ClientePj();
	//		echo $ClientePjIndicacao->selectClientePjSelect(0, "required", $and)?><!--<span class="placeholder">Campo Obrigatório</span> -->
            <!-- auto complte da tabela ClientePf--> </p>
          <p>
       <?php //}?>
       
       <p><label>Produto:</label></p>
       <select name="produtoIdProduto" id="produtoIdProduto">
       <option value="-">Escolha um</option>
       <option value="Cursos">Cursos</option>
       <option value="Consultoria">Consultoria</option>
       <option value="Tradução">Tradução</option>
       </select>
      
        <p>
          <label>
            <input type="checkbox" name="interno" id="interno" <?php if($interno != 0){ ?> checked="checked" <?php } ?> value="1" />
            Indicação interna</label>
        </p>
              <p>
          <label>
            <input type="checkbox" name="externo" id="externo" <?php if($externo != 0){ ?> checked="checked" <?php } ?> value="1" />
            Indicação externa</label>
        </p>
        

             <p>
          <label>
            <input type="checkbox" name="potencial" id="potencial" <?php if($potencial != 0){ ?> checked="checked" <?php } ?> value="1" />
            Potencial de crescimento</label>
        </p>
              <p>
          <label>
            <input type="checkbox" name="influencia" id="influencia" <?php if($influencia != 0){ ?> checked="checked" <?php } ?> value="1" />
            Ele tem influência? Tem um cargo de poder na empresa?</label>
        </p>
      </div>
       
   <div class="linha-inteira">   
        <button class="button blue" onclick="postForm('form_indicacaoClientePf', '<?php echo CAMINHO_CAD."clientePf/include/acao/indicacaoClientePf.php?idClientePf=$idClientePf"?>')">Salvar</button>
    </div>    
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 