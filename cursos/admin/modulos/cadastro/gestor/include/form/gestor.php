<fieldset>
  <legend>Cadastro de gestor</legend>
  <form id="form_gestor" class="validate" action="" method="post" onsubmit="return false" >
    <p>
      <label>Inativo</label>
      <input type="checkbox" name="inativo" id="inativo" value="1" <?php echo $inativo!=0 ? "checked" : "" ?> />
    </p>
    <?php if(!$idGestor){?>
    <label>De onde virá o cadastro do representante:</label>
        <input type="radio" name="origem" id="origem1" value="1" class="required" onchange="carregaFK()" />
        Funcionário
        <input type="radio" name="origem" id="origem2" value="2" class="required" onchange="carregaFK()" />
        Professor
        <input type="radio" name="origem" id="origem3" value="3" class="required" onchange="carregaFK()" />
        Cliente pessoa física
        </p>
    <?php }else{ ?>
        <label>Origem do cadastro do gestor:</label>
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
        
        $gestorNome = mysql_fetch_array($Gestor->gestorNome(" AND idGestor = ".$idGestor));
        echo ": ".$gestorNome['nomeFK'];
    }
    
    if(!$idGestor){?>
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
		$.post('<?php echo CAMINHO_CAD?>gestor/include/acao/gestor.php',{acao:"funcionario"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function carregaProfessor(){
		//alert('professor');
		$.post('<?php echo CAMINHO_CAD?>gestor/include/acao/gestor.php',{acao:"professor"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function carregaClientePf(){
		//alert('clientepf');
		$.post('<?php echo CAMINHO_CAD?>gestor/include/acao/gestor.php',{acao:"clientePf"}, function(e){
			$('#div_tbfk').html(e);
		});
	}
	
	function gravar(){
		var idGestor = '<?php echo $idGestor?>';
		if( !$('[name=origem]:input:checked').val() && idGestor=='' )
			alert('Escolha a tabela de origem do gestor');
		else
			postForm('form_gestor', '<?php echo CAMINHO_CAD."gestor/"?>include/acao/gestor.php?id=<?php echo $idGestor?>')	
	}
	
	ativarForm();
</script> 