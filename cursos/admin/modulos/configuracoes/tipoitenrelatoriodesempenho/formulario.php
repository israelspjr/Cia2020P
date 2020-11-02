<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoItenRelatorioDesempenho.class.php");
	
	
	$TipoItenRelatorioDesempenho = new TipoItenRelatorioDesempenho();
		
$idTipoItenRelatorioDesempenho = $_REQUEST['id'];

if($idTipoItenRelatorioDesempenho != '' && $idTipoItenRelatorioDesempenho  > 0){

	$valor = $TipoItenRelatorioDesempenho->selectTipoItenRelatorioDesempenho('WHERE idTipoItenRelatorioDesempenho='.$idTipoItenRelatorioDesempenho);
	
	$idTipoItenRelatorioDesempenho = $valor[0]['idTipoItenRelatorioDesempenho'];
		 $nome = $valor[0]['nome'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
         $avaliacao = $valor[0]['avaliacao'];
         $reavaliacao = $valor[0]['reavaliacao'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Tipo Item Relatório Desempenho</legend>
    <form id="form_TipoItenRelatorioDesempenho" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idTipoItenRelatorioDesempenho ?>" />
				<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="required" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
                <label>Avaliação Inicial:</label>
                <select name="avaliacao" id="avaliacao">
                    <?php
                        for($i=1;$i<=12;$i++):
                            
                            if($i == $avaliacao){$sel = "selected";}else{$sel = "";}
                            
                            echo "<option value='$i' $sel>".Uteis::retornaNomeMes($i)."</option>";
                            
                        endfor;   
                    ?>
                </select>
                <span class="placeholder">Campo Obrigatório</span>
                </p> 
                
                <p>
                <label>Reavaliação:</label>
                 <select name="reavaliacao" id="reavaliacao">
                    <?php
                        for($j=1;$j<=12;$j++):
                            
                            if($j == $reavaliacao){$sel2 = "selected";}else{$sel2 = "";}
                            
                            echo "<option value='$j' $sel2>".Uteis::retornaNomeMes($j)."</option>";
                            
                        endfor;   
                    ?>
                </select>
                <span class="placeholder">Campo Obrigatório</span>
                </p> 
				
	  
        <button class="button blue" onclick="postForm('form_TipoItenRelatorioDesempenho', '<?php echo CAMINHO_MODULO?>configuracoes/tipoitenrelatoriodesempenho/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

