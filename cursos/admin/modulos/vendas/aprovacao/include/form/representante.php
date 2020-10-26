<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
		
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Proposta.class.php");	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Representante.class.php");
    
	$Representante = new Representante();				
	$Proposta = new Proposta();	
	
	$idProposta = $_GET['id'];
	
	if($idProposta != '' && $idProposta  > 0){
		$valorProposta = $Proposta->selectProposta('WHERE idProposta='.$idProposta);
		$idRepresentante = $valorProposta[0]['representante_idRepresentante'];
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Atribuir representante</legend>
    
      <form id="form_Representante" class="validate" action="" method="post" onsubmit="return false" >

        <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
        
        <p>
        <label>Representantes:</label>    
        <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."representante/cadastro.php";?>', '<?php echo CAMINHO_CAD."representante/cadastro.php";?>', '#div_representante');" />         
		<?php echo $Representante->selectRepresentanteSelect("required", $idRepresentante) ?>
        <span style=\"display:none\">Campo obrigatório</span></p>   
            
        <label>Idiomas:</label>
        <div id="Idioma"></div>

        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_Representante', '<?php echo CAMINHO_VENDAS?>aprovacao/include/acao/representante.php?id=<?php echo $idProposta?>');">Salvar</button>
            
          </p>
        </div>
      </form>

  </fieldset>
</div>
<script>
function carregaRepresentanteIdioma(){
	var idRepresentante = $('#idRepresentante').val();
	$.post('<?php echo CAMINHO_VENDAS?>aprovacao/include/acao/representante.php',{acao:"carregaRepresentanteIdioma", idRepresentante:idRepresentante}, function(e){			
		$('#form_Representante #Idioma').html(e);
	});
}

$('#form_Representante #idRepresentante').attr('onchange', 'carregaRepresentanteIdioma();');
carregaRepresentanteIdioma();

ativarForm();</script>
