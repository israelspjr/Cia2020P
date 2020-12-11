<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");	

	
$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();	
$Modalidade = new Modalidade(); 
$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
		
$idItemValorSimuladoProposta = $_GET['id'];
$valorSimuladoPropostaIdValorSimuladoProposta = $_GET['idValorSimuladoProposta'];
	
if($idItemValorSimuladoProposta != '' && $idItemValorSimuladoProposta  > 0){

	$valorItemValorSimuladoProposta = $ItemValorSimuladoProposta->selectItemValorSimuladoProposta('WHERE idItemValorSimuladoProposta='.$idItemValorSimuladoProposta);
	
	$valorSimuladoPropostaIdValorSimuladoProposta = $valorItemValorSimuladoProposta[0]['valorSimuladoProposta_idValorSimuladoProposta'];				
	$valor = $valorItemValorSimuladoProposta[0]['valor'];
	$valorDescontoHora = Uteis::formatarMoeda($valorItemValorSimuladoProposta[0]['valorDescontoHora'], true);
	$validadeDesconto = Uteis::exibirData($valorItemValorSimuladoProposta[0]['validadeDesconto']);
	$horas = Uteis::exibirHorasInput($valorItemValorSimuladoProposta[0]['horasPorAula']);
	$frequenciaSemanalAula = $valorItemValorSimuladoProposta[0]['frequenciaSemanalAula'];
	$horasFixa = Uteis::exibirHorasInput($valorItemValorSimuladoProposta[0]['cargaHorariaFixaMensal']);
	$horasNGF = Uteis::exibirHorasInput($valorItemValorSimuladoProposta[0]['horaNaoGeraFf']);
	$obs = $valorItemValorSimuladoProposta[0]['obs'];
	$tipo = $valorItemValorSimuladoProposta[0]['tipo'];	
	$modalidadeIdModalidade = $valorItemValorSimuladoProposta[0]['modalidade_idModalidade']; 	
	
	$valorNaoFaz = Uteis::arrayCampoEspecifico($NaoFazAulaNestaSemanaProposta->selectNaoFazAulaNestaSemanaProposta(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = ".$idItemValorSimuladoProposta), "semana");		

}

$sql = "SELECT SQL_CACHE idioma_idIdioma FROM proposta AS P ";
$sql .= " INNER JOIN valorSimuladoProposta AS V ON V.proposta_idProposta = P.idProposta WHERE idValorSimuladoProposta = ".$valorSimuladoPropostaIdValorSimuladoProposta;
$idioma_idIdioma = Uteis::executarQuery($sql);
$idioma_idIdioma = $idioma_idIdioma[0]['idioma_idIdioma'];
		
$valor = $valor ? Uteis::formatarMoeda($valor) : "";
	
?>

<fieldset>
  <legend>Valor simulado</legend>
  <form id="form_ItemValorSimuladoProposta" class="validate" action="" method="post" onsubmit="return false" >
    <input type="hidden" name="valorSimuladoPropostaIdValorSimuladoProposta" id="valorSimuladoPropostaIdValorSimuladoProposta" value="<?php echo $valorSimuladoPropostaIdValorSimuladoProposta ?>" />
    <div class="esquerda">
      <p>
        <label>Tipo da carga horária:</label>
        <select id="tipo" name="tipo" class="required" onchange="mudaTipo()">
          <option value="" >Selecione</option>
          <option value="R" <?php echo $tipo=='R' ? "selected" : ""?> >Regular</option>
          <option value="T" <?php echo $tipo=='T' ? "selected" : ""?> >Total</option>
          <option value="E" <?php echo $tipo=='E' ? "selected" : ""?> >Exata</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Modalidade:</label>
        <?php 
			if( $idioma_idIdioma == '' ) $idioma_idIdioma = 0;
			$and = " AND idModalidade IN (";
			$and .= "	SELECT modalidade_idModalidade FROM modalidadeIdioma WHERE idioma_idIdioma IN(".$idioma_idIdioma.")";
			$and .= ")";
			echo $Modalidade->selectModalidadeSelect("required", $modalidadeIdModalidade, $and);?>
        <span class="placeholder">Campo Obrigatório</span></p>
      <p>
        <label>Valor hora (R$):</label>
        <input type="text" id="valor" name="valor" value="<?php echo $valor?>" class="required numeric" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <div id="div_frequenciaSemanalAula" >
        <p>
          <label>Frequencia semanal de aula</label>
          <input type="text" id="frequenciaSemanalAula" name="frequenciaSemanalAula" value="<?php echo $frequenciaSemanalAula?>" class="required numeric" maxlength="1"/>
          <span class="placeholder">Campo obrigatório</span> </p>
        <p>
          <label>Carga horária fixa mensal:</label>          
          <input type="text" id="horasFixa" name="horasFixa" value="<?php echo $horasFixa?>" class="hora" />
          <span class="placeholder"></span> </p>
      </div>
    </div>
    <div class="direita">
      <div id="div_valorDescontoHora">
        <p>
          <label>Valor do desconto (R$ por hora):</label>
          <input type="text" id="valorDescontoHora" name="valorDescontoHora" value="<?php echo $valorDescontoHora?>" class="numeric" />
          <span class="placeholder"></span> </p>
        <p>
          <label>Validade do desconto:</label>
          <input type="text" id="validadeDesconto" name="validadeDesconto" value="<?php echo $validadeDesconto?>" class="data" />
        </p>
      </div>
      <div id="div_horas">
        <p>
          <label id="horas_lbl"></label>         
          <input type="text" id="horas" name="horas" value="<?php echo $horas?>" class="required hora" />
          <span class="placeholder">Campo obrigatório</span> </p>
      </div>
      <div id="div_horasNGF">
        <p>
          <label>Horas que não irão para a Folha de frequência:</label>
          <input type="text" id="horasNGF" name="horasNGF" value="<?php echo $horasNGF?>" class="hora" />
          <span class="placeholder"></span> </p>
      </div>
      <p>
        <label>Observções:</label>
        <textarea id="obs" name="obs" rows="4" cols="40" ><?php echo $obs?></textarea>
      </p>
    </div>
    <div class="linha-inteira">
      <div id="semanas">
        <fieldset>
          <legend>Semanas do mês em que não fará aulas</legend>
          <?php for($s=1; $s < 5; $s++){?>
          <div style="float:left;width:25%">
            <label><?php echo $s?>ª semana do mês:</label>
            <input type="checkbox" name="semana_<?php echo $s?>" id="semana_<?php echo $s?>" value="1" <?php echo in_array($s, $valorNaoFaz) ? "checked" : ""?> />
          </div>
          <?php } ?>
        </fieldset>
      </div>
      <br />
      <br />
      <p>
        <button class="button blue" onclick="postForm('form_ItemValorSimuladoProposta', '<?php echo CAMINHO_VENDAS."proposta/include/acao/itemValorSimuladoProposta.php?id=$idItemValorSimuladoProposta"?>');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>

function atualizaValorPorModalidade(idModalidade){
	postForm('', '<?php echo CAMINHO_VENDAS."proposta/include/acao/itemValorSimuladoProposta.php"?>', 'acao=atualizaValorPorModalidade&idIdioma=<?php echo $idioma_idIdioma?>&idModalidade='+idModalidade+'&campoAtualizar=<?php echo "#form_ItemValorSimuladoProposta #valor"?>');	
}

$('#form_ItemValorSimuladoProposta #idModalidade').attr('onchange', 'atualizaValorPorModalidade( $(this).val() )');

var $form_ItemValorSimuladoProposta = $('#form_ItemValorSimuladoProposta');
var $tipo = $('#tipo');

function mudaTipo(){
	
	$formItemValorSimuladoProposta_horas = $('#form_ItemValorSimuladoProposta').find('#div_horas');
	$formItemValorSimuladoProposta_frequenciaSemanalAula = $('#form_ItemValorSimuladoProposta').find('#div_frequenciaSemanalAula');
	$formItemValorSimuladoProposta_horasNGF = $('#form_ItemValorSimuladoProposta').find('#div_horasNGF');
	$formItemValorSimuladoProposta_valorDescontoHora = $('#form_ItemValorSimuladoProposta').find('#div_valorDescontoHora');
	$formItemValorSimuladoProposta_semanas = $('#form_ItemValorSimuladoProposta').find('#semanas');
	
	if( $tipo.val() == 'R'){
		$formItemValorSimuladoProposta_horas.show().find('#horas_lbl').html('Horas por aula:');
		$formItemValorSimuladoProposta_frequenciaSemanalAula.show().find('#frequenciaSemanalAula').addClass('required').find('~ span').hide();
		$formItemValorSimuladoProposta_horasNGF.hide();
		$formItemValorSimuladoProposta_valorDescontoHora.show();
		$formItemValorSimuladoProposta_semanas.show();
		
	}else if( $tipo.val() == 'T'){
		$formItemValorSimuladoProposta_horas.show().find('#horas_lbl').html('Carga horário total:');
		$formItemValorSimuladoProposta_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formItemValorSimuladoProposta_horasNGF.hide();
		$formItemValorSimuladoProposta_valorDescontoHora.show();
		$formItemValorSimuladoProposta_semanas.hide();
		
	}else if( $tipo.val() == 'E'){
		$formItemValorSimuladoProposta_horas.show().find('#horas_lbl').html('Carga horário exata:');
		$formItemValorSimuladoProposta_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formItemValorSimuladoProposta_horasNGF.show();
		$formItemValorSimuladoProposta_valorDescontoHora.hide();
		$formItemValorSimuladoProposta_semanas.hide();
	}else{
		$formItemValorSimuladoProposta_horas.hide().find('#horas_lbl').html('');
		$formItemValorSimuladoProposta_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formItemValorSimuladoProposta_horasNGF.hide();
		$formItemValorSimuladoProposta_valorDescontoHora.hide();
		$formItemValorSimuladoProposta_semanas.hide();
	}
}

mudaTipo();
ativarForm();
</script>