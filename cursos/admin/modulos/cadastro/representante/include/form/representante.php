<fieldset>
  <legend>Cadastro de representante</legend>
  <form id="form_representante" class="validate" action="" method="post" onsubmit="return false" >
    <p>
      <label>Inativo</label>
      <input type="checkbox" name="inativo" id="inativo" value="1" <?php echo $inativo!=0 ? "checked" : "" ?> />
    </p>
    <p>
      <?php if(!$idRepresentante){?>
          <label>De onde virá o cadastro do representante:</label>
          <input type="radio" name="origem" id="origem1" value="1" class="required" onchange="carregaFK()" />
          Funcionário
          <input type="radio" name="origem" id="origem2" value="2" class="required" onchange="carregaFK()" />
          Professor
          <input type="radio" name="origem" id="origem3" value="3" class="required" onchange="carregaFK()" />
          Cliente pessoa física <span class="placeholder">Campo Obrigatório</span> </p>
          
	  <?php }else{ ?>
      	
        <label>Origem do cadastro do representante:</label>   
        
      	<?php 
		if($idClientePf){
			echo "<strong>Cliente pessoa física</strong>";
			echo "<input type=\"hidden\" name=\"idClientePf\" id=\"idClientePf\" value=\"".$idClientePf."\" />";
		}elseif($idFuncionario){
			echo "<strong>Funcionário</strong>";
			echo "<input type=\"hidden\" name=\"idFuncionario\" id=\"idFuncionario\" value=\"".$idFuncionario."\" />";
		}elseif($idProfessor){
			echo "<strong>Professor</strong>";
			echo "<input type=\"hidden\" name=\"idProfessor\" id=\"idProfessor\" value=\"".$idProfessor."\" />";
		}	
		
		$representanteNome = $Representante->getNome($idRepresentante);
		echo ": ".$representanteNome;
	}
    
	if(!$idRepresentante){?>
      <p>     
        <label>Escolha uma opção:</label>
        <div id="div_tbfk"></div>	    
      </p>
    <?php } ?>      
    
    <p>
      <label>Observação:</label>
      <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      <span class="placeholder">Campo Obrigatório</span> </p>
    <p>
      <button class="button blue" onclick="gravar()" >Salvar</button>
      
    </p>
  </form>
</fieldset>

<script>

	function carregaFK(){
		var $origem = $('[name=origem]:input:checked').val()
		if( $origem == 1) carregaFuncionario()
		else if( $origem == 2) carregaProfessor()
		else if( $origem == 3) carregaClientePf()
	}
	
	function carregaFuncionario(){
		//alert('funcionario');
		$.post('<?php echo CAMINHO_CAD?>representante/include/acao/representante.php',{acao:"funcionario"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function carregaProfessor(){
		//alert('professor');
		$.post('<?php echo CAMINHO_CAD?>representante/include/acao/representante.php',{acao:"professor"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function carregaClientePf(){
		//alert('clientepf');
		$.post('<?php echo CAMINHO_CAD?>representante/include/acao/representante.php',{acao:"clientePf"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function gravar(){
		var idRepresentante = '<?php echo $idRepresentante?>';
		if( !$('[name=origem]:input:checked').val() && idRepresentante=='' )
			alert('Escolha a tabela de origem do representante');
		else
			postForm('form_representante', '<?php echo CAMINHO_CAD."representante/"?>include/acao/representante.php?id=<?php echo $idRepresentante?>')	
	}
	
	ativarForm();
</script> 
