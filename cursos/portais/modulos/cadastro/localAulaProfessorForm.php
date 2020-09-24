<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$idProfessor = $_SESSION['idProfessor_SS'];
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
<style>
.placeholder {
display: none;
color: red;	
	
}
</style>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de locais de aula onde o professor esta disponível para dar aulas</legend>
    <form id="form_localAulaProfessor" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" id="acao" name="idProfessor" value="<?php echo $idProfessor?>" />
         <input type="hidden" id="pais_idPais" name="pais_idPais" value="33" />   
      <p class="filtrarcampoendereco">
        <label>Pais: Brasil</label>
         <?php //echo $Pais->selectPaisSelect("required", $paisIdPais);?> <span class="placeholder" style="display:none;color:red">Campo Obrigatório</span>        
      </p>
      <div id="div-brasil">
        <p >
          <label>Estado:</label>
          <?php echo $Uf->selectUfSelect("required", $idUf);?><span class="placeholder" style="display:none;color:red">Campo Obrigatório</span>           
          
        </p>
        <div id="div-cidade"></div>
        
      </div>
      <div id="div-zona"> </div>
      
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_localAulaProfessor', '/cursos/portais/modulos/cadastro/localAulaProfessorAcao.php');">Salvar</button>
        
          <button class="button gray" 
        onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/localAulaProfessor.php', '#centro');" >Fechar</button>
        
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
		$.post('modulos/cadastro/enderecoAcao.php', { acao:"cidade", idUf:idUf, idCidade:idCidade}, function(e){
			$cidade.html(e);
			//$zona.html('');
			atualizaZonaPorCidade(idCidade);
		});
	}
  
  function atualizaZonaPorCidade(idCidade, idZona){
	  if(idZona == '' || idZona == undefined) idZona = '';
	$.post('modulos/cadastro/enderecoAcao.php', { acao:"zonaCidade", idCidade:idCidade, idZona:idZona, idProfessor:'<?php echo $idProfessor?>'}, function(e){
		$zona.html(e);
	});
  }
  
   function atualizaZonaPorPais(idPais, idZona){
	if(idZona == '' || idZona == undefined) idZona = '';
	$.post('modulos/cadastro/enderecoAcao.php', { acao:"zonaPais", idPais:idPais, idZona:idZona, idProfessor:'<?php echo $idProfessor?>'}, function(e){
		$zona.html(e);		
	});
  }   
	
	<?php if($cidadeIdCidade!='' && $idUf!='' ){?>
		atualizaCidade('<?php echo $idUf?>', '<?php echo $cidadeIdCidade?>');
	<?php }?>
		
//  ativarForm();
  
  function enviadoOK() {
	alert("Conteúdo inserido/alterado com sucesso!");
}
  </script>