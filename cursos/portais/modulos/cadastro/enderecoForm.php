<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Endereco = new Endereco();
$Pais = new Pais();
$Uf = new Uf();	
$Cidade = new Cidade();
$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();

if($paisIdPais == "") $paisIdPais = ID_PAIS;

if($cidadeIdCidade == "") $cidadeIdCidade = ID_CIDADE;

//CHAVES ESTRANGEIRAS
$clientePfIdClientePf = $_GET['idClientePf'];
	
$idEndereco = $_GET['id'];	
if($idEndereco!=''){
	
	$valorEndereco = $Endereco->selectEndereco('WHERE idEndereco='.$idEndereco);
		
	$clientePfIdClientePf = $valorEndereco[0]['clientePf_idClientePf'];
	$cidadeIdCidade = $valorEndereco[0]['cidade_idCidade'];
	$paisIdPais = $valorEndereco[0]['pais_idPais'];
	$zonaAtendimentoCidadeIdZonaAtendimentoCidade = $valorEndereco[0]['zonaAtendimentoCidade_idZonaAtendimentoCidade'];
	$principal = $valorEndereco[0]['principal'];
	$rua = $valorEndereco[0]['rua'];
	$bairro = $valorEndereco[0]['bairro'];
	$numero = $valorEndereco[0]['numero'];
	$cep = $valorEndereco[0]['cep'];
	$complemento = $valorEndereco[0]['complemento'];
	$obs = $valorEndereco[0]['obs'];
	$referencia = $valorEndereco[0]['referencia'];
	$linkMapa = $valorEndereco[0]['linkMapa'];		
	
	//print_r($valorEndereco);	
}
	
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
-->

  <script>
	$(document).ready(function(){
		$('.filtrarcampoendereco select').change(function(){
			if($(this).val() == 33){
				selecionaBrasil();					
			}else{
				selecionaOutroPais( $(this).val() );			
			}
		});	
	});
	
	function selecionaBrasil(){
		$('#div-brasil').css('display','block');
		$('#idUf').addClass('required');
		$('#div-brasil #idUf').find('option').attr('selected', false);
		//if( $('#idCidade') ) $('#idCidade').addClass('required');	
		$('#div-cidade').html('');
		$('#div-zona').html('');
	}
  
	function selecionaOutroPais(idOutroPais){
		$('#div-brasil').css('display','none');
		$('#idUf').removeClass('required invalid');
		$('#idUf ~ span').css('display','none');
		$('#div-brasil #idUf').find('option').attr('selected', false);
		//if( $('#idCidade') ) $('#idCidade').removeClass('required invalid');
		$('#div-cidade').html('');
		$('#div-zona').html('');
		atualizaZonaPorPais(idOutroPais, '<?php echo $zonaAtendimentoCidadeIdZonaAtendimentoCidade?>');

	}
  
  function atualizaCidade(idUf, idCidade){
	  if(idCidade == '' || idCidade == undefined) idCidade = '';
		$.post('<?php echo CAMINHO_CAD?>acao/endereco.php', { acao:"cidade", idUf:idUf, idCidade:idCidade}, function(e){
			$('#div-cidade').html(e);
			atualizaZonaPorCidade(idCidade, '<?php echo $zonaAtendimentoCidadeIdZonaAtendimentoCidade?>')
			//$('#div-zona').html('');
		});
	}
  
  function atualizaZonaPorCidade(idCidade, idZona){
	  if(idZona == '' || idZona == undefined) idZona = '';
	$.post('<?php echo CAMINHO_CAD?>acao/endereco.php', { acao:"zonaCidade", idCidade:idCidade, idZona:idZona}, function(e){
		$('#div-zona').html(e);
	});
  }
  
   function atualizaZonaPorPais(idPais, idZona){
	if(idZona == '' || idZona == undefined) idZona = '';
	$.post('<?php echo CAMINHO_CAD?>acao/endereco.php', { acao:"zonaPais", idPais:idPais, idZona:idZona}, function(e){
		$('#div-zona').html(e);
	});
  }
  
   function atualizaUfPorCidade(idCidade){
	$.post('<?php echo CAMINHO_CAD?>acao/endereco.php', { acao: "ufCidade", idCidade: idCidade}, function(idUf){		
		$('#div-brasil #idUf').find('option[value='+idUf+']').attr('selected',true);				
		atualizaCidade(idUf, idCidade);			
		//atualizaZonaPorCidade(idCidade, '<?php// echo $zonaAtendimentoCidadeIdZonaAtendimentoCidade?>')				
	});
  }
  
  </script>
  
  <fieldset>
    <legend>Endereço</legend>
    <form id="form_endereco" class="validate" method="post" onsubmit="return false" >
      
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
     
      <div class="esquerda">
      	<p>
          <label><input type="checkbox" name="principal" id="principal" value="1" <?php if($principal == 1){?> checked="checked" <?php } ?> />
          Endereço principal
          <br /><small>apenas um dos seus endereços pode ser definido como principal.</small></label></p>
        <p class="filtrarcampoendereco">
          <label>Pais:</label>
            
          <?php echo $Pais->selectPaisSelect("required", $paisIdPais);?>
          <span class="placeholder">Campo Obrigatório</span> 
          <!--funcao retorna pais_idPais--> 
          
        </p>
        <div id="div-brasil">
          <p >
            <label>Estado:</label>
            <?php echo $Uf->selectUfSelect("required", $idUf);?><span class="placeholder">Campo Obrigatório</span> 
            <!--funcao retorna uf_idUf, mas nao grava nessa tabela--> 
            
          </p>
          <div id="div-cidade"></div>
        </div>
        <div id="div-zona"> </div>
                			
        <p>
          <label>Rua:</label>
          <input type="text" name="rua" id="rua" class="required" value="<?php echo $rua?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Número:</label>
          <input type="text" name="numero" id="numero" class="numeric required" value="<?php echo $numero?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <div >
        <p>
          <label>Bairro:</label>
          <input type="text" name="bairro" id="bairro" class="required" value="<?php echo $bairro?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>CEP:</label>
          <input type="text" name="cep" id="cep" class="cep" value="<?php echo $cep?>"/>
          <span class="placeholder">Campo Obrigatório</span> </p>
        <p>
          <label>Complemento:</label>
          <input type="text" name="complemento" id="complemento" value="<?php echo $complemento?>" />
        </p>
        <p>
          <label>Referência:</label>
          <input type="text" name="referencia" id="referencia" value="<?php echo $referencia?>" />
        </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        </p> 
        <p>
          <label>Link do mapa (google maps):</label>
          <input type="text" name="linkMapa" id="linkMapa" value="<?php echo $linkMapa?>"/>
          
          <?php if($linkMapa!=''){?>
            <img src="<?php echo CAMINHO_IMG?>mapa.png" title="Veja seu mapa clicando aqui" 
            onclick="abrirLink('<?php echo $linkMapa?>')" /> 
          <?php }else{?>
          	<img src="<?php echo CAMINHO_IMG?>info.png" title="Saiba como inserir um link de mapa" />
          <?php }?>
          <!--MAPA GOOGLE MAPS-echo --> 
        </p>
        
      </div>
      <div style="width:100%">
        <p>
          <button class="Bblue" onclick="enviadoOK();postForm('form_endereco', 'modulos/cadastro/enderecoAcao.php?id=<?php echo $idEndereco?>');">Salvar</button>
          <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/endereco.php', '#centro');">Fechar</button>
          
          
        </p>
      </div>
    </form>
  </fieldset>
</div>
<script>		
	<?php
	//if($idEndereco!=''){
		if($paisIdPais==33){?>
			selecionaBrasil();
			<?php if($cidadeIdCidade!=''){?>
				atualizaUfPorCidade('<?php echo $cidadeIdCidade?>');
			<?php } 
		}elseif($paisIdPais!=''){?>
			var idPais = $('.filtrarcampoendereco #pais_idPais').find('option').filter(':selected').val(); 
			selecionaOutroPais( idPais );
		<?php }
	//}?>
	ativarForm();
</script> 
