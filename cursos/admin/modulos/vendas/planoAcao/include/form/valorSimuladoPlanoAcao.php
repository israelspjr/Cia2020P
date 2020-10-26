<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorSimuladoPlanoAcao.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcao.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");			
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NaoFazAulaNestaSemanaPlanoAcao.class.php");

	
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();	
$PlanoAcao = new PlanoAcao();	
$Modalidade = new Modalidade(); 
$NaoFazAulaNestaSemanaPlanoAcao = new NaoFazAulaNestaSemanaPlanoAcao();
			
$idValorSimuladoPlanoAcao = $_GET['id'];
$planoAcaoIdPlanoAcao = $_GET['idPlanoAcao'];
	
if($idValorSimuladoPlanoAcao != '' && $idValorSimuladoPlanoAcao  > 0){

	$valorValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao('WHERE idValorSimuladoPlanoAcao='.$idValorSimuladoPlanoAcao);

	$planoAcaoIdPlanoAcao = $valorValorSimuladoPlanoAcao[0]['planoAcao_idPlanoAcao'];				
	$valor = $valorValorSimuladoPlanoAcao[0]['valorHora'];
	$valorDescontoHora = Uteis::formatarMoeda($valorValorSimuladoPlanoAcao[0]['valorDescontoHora'], true);
	$validadeDesconto = Uteis::exibirData($valorValorSimuladoPlanoAcao[0]['validadeDesconto']);
	$horas = Uteis::exibirHorasInput($valorValorSimuladoPlanoAcao[0]['horasPorAula']);
	$frequenciaSemanalAula = $valorValorSimuladoPlanoAcao[0]['frequenciaSemanalAula'];
	$horasFixa = Uteis::exibirHorasInput( $valorValorSimuladoPlanoAcao[0]['cargaHorariaFixaMensal'] );
	$horasNGF = Uteis::exibirHorasInput( $valorValorSimuladoPlanoAcao[0]['horaNaoGeraFf'] );
	$obs = $valorValorSimuladoPlanoAcao[0]['obs'];
	$tipo = $valorValorSimuladoPlanoAcao[0]['tipo'];	
	$modalidadeIdModalidade = $valorValorSimuladoPlanoAcao[0]['modalidade_idModalidade']; 	
	
	$valorNaoFazTemp = $NaoFazAulaNestaSemanaPlanoAcao->selectNaoFazAulaNestaSemanaPlanoAcao(" WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao);
	for ($row = 0; $row < count($valorNaoFazTemp,0); $row++){	
		$valorNaoFaz[$row] = $valorNaoFazTemp[$row]['semana'];
	}
	
}

$idioma_idIdioma =  $PlanoAcao->getIdIdioma($planoAcaoIdPlanoAcao);
		
$valor = $valor ? Uteis::formatarMoeda($valor) : "";
	
?>

<fieldset>
  <legend>Valor simulado</legend>
  <form id="form_ValorSimuladoPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
    <input type="hidden" name="planoAcaoIdPlanoAcao" id="planoAcaoIdPlanoAcao" value="<?php echo $planoAcaoIdPlanoAcao ?>" />
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
        <label id="lbl_valor"></label>
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
        <label>Observações:</label>
        <textarea id="obs" name="obs" rows="4" cols="40" ><?php echo $obs?></textarea>
      </p>
    </div>
    <div class="linha-inteira">
      <div id="semanas">
        <fieldset>
          <legend>Semanas do mês em que não fará aulas</legend>
          <?php for($s=1; $s < 5; $s++){?>
          <div style="float:left;width:20%">
            <label><?php echo $s?>ª semana do mês:</label>
            <input type="checkbox" name="semana_<?php echo $s?>" id="semana_<?php echo $s?>" value="1" <?php echo in_array($s, $valorNaoFaz) ? "checked" : ""?> />
          </div>
          <?php } ?>
        </fieldset>
      </div>
      <br />
      <br />
      <p>
        <button class="button blue" onclick="postForm('form_ValorSimuladoPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/valorSimuladoPlanoAcao.php?id=<?php echo $idValorSimuladoPlanoAcao?>');">Salvar</button>
        
      </p>
    </div>
  </form>
</fieldset>
<script>
function atualizaValorPorModalidade(idModalidade){
	postForm('', '<?php echo CAMINHO_VENDAS."proposta/include/acao/itemValorSimuladoProposta.php"?>', '&acao=atualizaValorPorModalidade&idIdioma=<?php echo $idioma_idIdioma?>&idModalidade='+idModalidade+'&campoAtualizar=<?php echo "#form_ValorSimuladoPlanoAcao #valor"?>');
}

$('#form_ValorSimuladoPlanoAcao #idModalidade').attr('onchange', 'atualizaValorPorModalidade( $(this).val() )');

var $form_ValorSimuladoPlanoAcao = $('#form_ValorSimuladoPlanoAcao');
var $tipo = $('#form_ValorSimuladoPlanoAcao').find('#tipo');

function mudaTipo(){
	
	$formValorSimuladoPlanoAcao_horas = $('#form_ValorSimuladoPlanoAcao').find('#div_horas');
	$formValorSimuladoPlanoAcao_frequenciaSemanalAula = $('#form_ValorSimuladoPlanoAcao').find('#div_frequenciaSemanalAula');
	$formValorSimuladoPlanoAcao_horasNGF = $('#form_ValorSimuladoPlanoAcao').find('#div_horasNGF');
	$formValorSimuladoPlanoAcao_valorDescontoHora = $('#form_ValorSimuladoPlanoAcao').find('#div_valorDescontoHora');
	$formValorSimuladoPlanoAcao_semanas = $('#form_ValorSimuladoPlanoAcao').find('#semanas');
	
	if( $tipo.val() == 'R'){		
		$form_ValorSimuladoPlanoAcao.find('#lbl_valor').html('Valor hora (R$):');
		$formValorSimuladoPlanoAcao_horas.show().find('#horas_lbl').html('Horas por aula:');
		$formValorSimuladoPlanoAcao_frequenciaSemanalAula.show().find('#frequenciaSemanalAula').addClass('required').find('~ span').hide();
		$formValorSimuladoPlanoAcao_horasNGF.hide();
		$formValorSimuladoPlanoAcao_valorDescontoHora.show();
		$formValorSimuladoPlanoAcao_semanas.show();
		
	}else if( $tipo.val() == 'T'){
		$form_ValorSimuladoPlanoAcao.find('#lbl_valor').html('Valor hora (R$):');
		$formValorSimuladoPlanoAcao_horas.show().find('#horas_lbl').html('Carga horário total:');
		$formValorSimuladoPlanoAcao_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formValorSimuladoPlanoAcao_horasNGF.hide();
		$formValorSimuladoPlanoAcao_valorDescontoHora.show();
		$formValorSimuladoPlanoAcao_semanas.hide();
		
	}else if( $tipo.val() == 'E'){
		$form_ValorSimuladoPlanoAcao.find('#lbl_valor').html('Valor total (R$):');
		$formValorSimuladoPlanoAcao_horas.show().find('#horas_lbl').html('Carga horário exata:');
		$formValorSimuladoPlanoAcao_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formValorSimuladoPlanoAcao_horasNGF.show();
		$formValorSimuladoPlanoAcao_valorDescontoHora.hide();
		$formValorSimuladoPlanoAcao_semanas.hide();
		
	}else{
		$form_ValorSimuladoPlanoAcao.find('#lbl_valor').html('');
		$formValorSimuladoPlanoAcao_horas.hide().find('#horas_lbl').html('');
		$formValorSimuladoPlanoAcao_frequenciaSemanalAula.hide().find('#frequenciaSemanalAula').removeClass('invalid required').find('~ span').hide();
		$formValorSimuladoPlanoAcao_horasNGF.hide();
		$formValorSimuladoPlanoAcao_valorDescontoHora.hide();
		$formValorSimuladoPlanoAcao_semanas.hide();
	}
}

mudaTipo();
ativarForm();
</script>