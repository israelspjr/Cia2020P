<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();
$Cidade = new Cidade();
$Pais = new Pais();
		
$idZonaAtendimentoCidade = $_REQUEST['id'];
$pais_idPais = ID_PAIS;
$cidade_idCidade = ID_CIDADE;

if($idZonaAtendimentoCidade != '' && $idZonaAtendimentoCidade  > 0){

	$valor = $ZonaAtendimentoCidade->selectZonaAtendimentoCidade('WHERE idZonaAtendimentoCidade='.$idZonaAtendimentoCidade);
	
	//$idZonaAtendimentoCidade = $valor[0]['idZonaAtendimentoCidade'];
	 $cidade_idCidade = $valor[0]['cidade_idCidade'];
	 $pais_idPais = $valor[0]['pais_idPais'];
	 $zona = $valor[0]['zona'];
	 $inativo = $valor[0]['inativo'];
	 $excluido = $valor[0]['excluido'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();"></div>
  <fieldset>
    <legend>Cadastro - Zona Atendimento Cidade</legend>
    <form id="form_ZonaAtendimentoCidade" class="validate"  method="post" onsubmit="return false" >
      <input name="id" type="hidden" value="<?php echo $idZonaAtendimentoCidade ?>" />
      <p>
        <label for="inativo">Inativo</label>
        <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
      </p>
      <script>
				$(document).ready(function(e) {
					$('#pais_idPais').change(function(){
						if($('#pais_idPais').val()=='33'){	
							$('#cidadeP').fadeIn(300);
						}else{
							$('#cidadeP').fadeOut(300);
								$('#idCidade option').each(function(){
									 $(this).attr('selected', false);
								 });
						}
					});
				});
			</script>
      <p>
        <label>País:</label>
        <?php echo $Pais->selectPaisSelect("required", $pais_idPais); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p id="cidadeP" <?php if($pais_idPais != 33){?>style="display:none;"<?php } ?>>
        <label>Cidade:</label>
        <?php echo $Cidade->selectCidadeSelect("required", $cidade_idCidade); ?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Zona:</label>
        <input type="text" name="zona" id="zona" class="required" value="<?php echo $zona?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_ZonaAtendimentoCidade', '<?php echo CAMINHO_MODULO?>configuracoes/zonaatendimentocidade/grava.php')">Salvar</button>
      
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
