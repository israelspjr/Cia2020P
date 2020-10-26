<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idProfessor = $_GET['idProfessor'];
$idLocalAulaProfessor = $_GET['id'];

$Endereco = new Endereco();
$Pais = new Pais();
$Uf = new Uf();	
$Cidade = new Cidade();
$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();
$LocalAulaProfessor = new LocalAulaProfessor();


$paisIdPais = ID_PAIS;
$idUf = ID_UF;	
$cidadeIdCidade = ID_CIDADE;

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de locais de aula onde o professor esta disponível para dar aulas</legend>
    <form id="form_localAulaProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" id="acao" name="idProfessor" value="<?php echo $idProfessor?>" />
      <p class="filtrarcampoendereco">
        <label>Pais:</label>
         <?php echo $Pais->selectPaisSelect("required", $paisIdPais);?> <span class="placeholder">Campo Obrigatório</span>        
      </p>
      <div id="div-brasil">
        <p >
          <label>Estado:</label>
          <?php echo $Uf->selectUfSelect("required", $idUf);?><span class="placeholder">Campo Obrigatório</span>           
          
        </p>
        <div id="div-cidade"></div>
        
      </div>
      <div id="div-zona"> </div>
      
      <p>
        <button class="button blue" onclick="postForm('form_localAulaProfessor', '<?php echo CAMINHO_CAD."professor/"?>include/acao/localAulaProfessor.php');">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>		
	
	var $zona = $('#div-zona');
	var $cidade = $('#div-cidade');
	var $brasil = $('#div-brasil');
	
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
		$brasil.css('display','block').find('#idUf').addClass('required').find('option').attr('selected', false);
		$cidade.html('');
		$zona.html('');
	}
  
	function selecionaOutroPais(idOutroPais){
		$brasil.css('display','none').find('#idUf').removeClass('required invalid').find('option').attr('selected', false);
		$cidade.html('');
		$zona.html('');
		atualizaZonaPorPais(idOutroPais, '<?php echo $zonaAtendimentoCidadeIdZonaAtendimentoCidade?>');
	}
  
  function atualizaCidade(idUf, idCidade){
	  if(idCidade == '' || idCidade == undefined) idCidade = '';
		$.post('<?php echo CAMINHO_CAD?>endereco/include/acao/endereco.php', { acao:"cidade", idUf:idUf, idCidade:idCidade}, function(e){
			$cidade.html(e);
			//$zona.html('');
			atualizaZonaPorCidade(idCidade);
		});
	}
  
  function atualizaZonaPorCidade(idCidade, idZona){
	  if(idZona == '' || idZona == undefined) idZona = '';
	$.post('<?php echo CAMINHO_CAD?>endereco/include/acao/endereco.php', { acao:"zonaCidade", idCidade:idCidade, idZona:idZona, idProfessor:'<?php echo $idProfessor?>'}, function(e){
		$zona.html(e);
	});
  }
  
   function atualizaZonaPorPais(idPais, idZona){
	if(idZona == '' || idZona == undefined) idZona = '';
	$.post('<?php echo CAMINHO_CAD?>endereco/include/acao/endereco.php', { acao:"zonaPais", idPais:idPais, idZona:idZona, idProfessor:'<?php echo $idProfessor?>'}, function(e){
		$zona.html(e);		
	});
  }   
	
		<?php if($cidadeIdCidade!='' && $idUf!='' ){?>
			atualizaCidade('<?php echo $idUf?>', '<?php echo $cidadeIdCidade?>');
		<?php }?>
		
  ativarForm();
  </script>