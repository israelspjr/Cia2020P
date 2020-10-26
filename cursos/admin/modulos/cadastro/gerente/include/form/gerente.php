<?php

$cor = "#000000";

if($idGerente != '' && $idGerente  > 0){

	$valorGerente = $Gerente->selectGerente('WHERE idGerente='.$idGerente);
	
	$idFuncionario = $valorGerente[0]['funcionario_idFuncionario']; 
	$cor = $valorGerente[0]['cor']; 
	$inativo = $valorGerente[0]['inativo']; 
	$obs = $valorGerente[0]['obs']; 
}
?>

<script type="text/javascript" src="<?php echo CAMINHO_CFG."js/farbtastic.js"?>"></script>
<link href="<?php echo CAMINHO_CFG?>css/farbtastic/farbtastic.css" type="text/css" media="screen" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#picker').farbtastic('#color');
  });
 </script>
 
<fieldset>
  <legend>Cadastro de gerente</legend>
  <form id="form_gerente" class="validate" action="" method="post" onsubmit="return false">
    <p>
      <label>Funcionário:</label>     
      <?php 
		  if($idGerente==""){	
			  $and = " AND idFuncionario NOT IN ("; 
			  $and .= "	SELECT COALESCE(funcionario_idFuncionario,0) FROM gerente ";
			  $and .= ")";		
			  echo $Funcionario->selectFuncionarioSelect($idFuncionario, "required", $and);
			  echo "<span class=\"placeholder\">Campo Obrigatório</span> ";
          }else{
          	$funcionarioSelecionado =  $Funcionario->selectFuncionario(" WHERE idFuncionario = ".$idFuncionario);
			echo "<strong>".$funcionarioSelecionado[0]['nome']."</strong>";
			echo "<input type=\"hidden\" name=\"idFuncionario\" id=\"idFuncionario\" value=\"".$idFuncionario."\" />";
		  }
		 ?><span class="placeholder">Campo Obrigatório</span> </p>

      <p><label>Cor de identificação:</label>
      <input type="text" id="color" name="color" value="<?php echo $cor?>" class="required" maxlength="7"/><span class="placeholder"></span>
      <div id="picker"></div></p>  
            
    <p>
      <label>Inativo</label>
      <input type="checkbox" name="inativo" id="inativo" value="1" <?php echo $inativo!=0 ? "checked" : "" ?> />
    </p>
    <p>
      <label>Observação:</label>
      <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      <span class="placeholder">Campo Obrigatório</span> </p>
    <p>
      <button class="button blue" onclick="postForm('form_gerente', '<?php echo CAMINHO_CAD."gerente/"?>include/acao/gerente.php?id=<?php echo $idGerente?>')" >Salvar</button>
      
    </p>
  </form>
</fieldset>
