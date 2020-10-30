<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DiasBuscaAvulsa.class.php");


$DiasBuscaAvulsa = new DiasBuscaAvulsa();

$idDiasBuscaAvulsa = $_REQUEST["idDiasBuscaAvulsa"];
$idBuscaAvulsa = $_REQUEST["idBuscaAvulsa"];

if( $idDiasBuscaAvulsa ){
	
	$rsDiasBuscaAvulsa = $DiasBuscaAvulsa->selectDiasBuscaAvulsa(" WHERE idDiasBuscaAvulsa = $idDiasBuscaAvulsa");
	
	$idBuscaAvulsa = $rsDiasBuscaAvulsa[0]['buscaAvulsa_idBuscaAvulsa'];
	$tipo = $rsDiasBuscaAvulsa[0]['tipo'];
	$horaInicio = Uteis::exibirHorasInput($rsDiasBuscaAvulsa[0]['horaInicio']);	
	$horaFim = Uteis::exibirHorasInput($rsDiasBuscaAvulsa[0]['horaFim']);
	$dataAula = Uteis::exibirData($rsDiasBuscaAvulsa[0]['dataAula']);
	$diaSemanaAula = Uteis::exibirDiaSemana($rsDiasBuscaAvulsa[0]['diaSemanaAula']);
    $diaSemanaAulaOpt = $rsDiasBuscaAvulsa[0]['diaSemanaAula'];
	$obs = $rsDiasBuscaAvulsa[0]['obs'];
}

?>

<div class="conteudo_nivel" id="div_dia_avulsa">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
    <legend>Dia</legend>
    <form id="form_avulsa" class="validate" method="post" action="" onsubmit="return false">
      <input name="idDiasBuscaAvulsa" type="hidden" value="<?php echo $idDiasBuscaAvulsa ?>" />
      <input name="idBuscaAvulsa" type="hidden" value="<?php echo $idBuscaAvulsa ?>" />
      <p>
        <label>Tipo:</label>
        <select name="tipo" id="tipo" class="required" onchange="mudarTipo_avulsa()">
          <option value="">Selecione</option>
          <option <?php echo ($tipo =="1") ? "selected" : "" ?>  value="1">Aulas permanentes</option>
          <option <?php echo ($tipo =="2") ? "selected" : "" ?>  value="2">Dia fixo</option>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Data da aula:</label>
        <input type="text" name="dataAula" id="dataAula" class="data" value="<?php echo $dataAula?>"  />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Dia da semana:</label>
        <select name="diaSemanaAula" id="diaSemanaAula" class="" >
          <option value="" >Selecione</option>
          <option value="1" <?php echo ($diaSemanaAulaOpt =="1") ? "selected" : "" ?> >domingo</option>
          <option value="2" <?php echo ($diaSemanaAulaOpt =="2") ? "selected" : "" ?>>segunda-feira</option>
          <option value="3" <?php echo ($diaSemanaAulaOpt =="3") ? "selected" : "" ?>>terça-feira</option>
          <option value="4" <?php echo ($diaSemanaAulaOpt =="4") ? "selected" : "" ?>>quarta-feira</option>
          <option value="5" <?php echo ($diaSemanaAulaOpt =="5") ? "selected" : "" ?>>quinta-feira</option>
          <option value="6" <?php echo ($diaSemanaAulaOpt =="6") ? "selected" : "" ?>>sexta-feira</option>
          <option value="7" <?php echo ($diaSemanaAulaOpt =="7") ? "selected" : "" ?>>sábado</option>
        </select>
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
        <label>Hora início:</label>
        <input type="text" name="horaInicio" id="horaInicio" class="required hora" value="<?php echo $horaInicio?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Hora fim:</label>
        <input type="text" name="horaFim" id="horaFim" class="required hora" value="<?php echo $horaFim?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_avulsa', '<?php echo CAMINHO_REL."busca/avulsa/include/acao/dia.php?idDiasBuscaAvulsa=$idDiasBuscaAvulsa"?>');"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();


function mudarTipo_avulsa(){
	
	var tipo = $('#div_dia_avulsa #tipo').val();	//alert(tipo);
	var $diaSemanaAula = $('#div_dia_avulsa #diaSemanaAula');
	var $dataAula = $('#div_dia_avulsa #dataAula');
	
	if(tipo=="2"){
		$diaSemanaAula.val('').removeClass('required').parent().hide();
		$dataAula.addClass('required').parent().show();						
	}else if(tipo=="1"){
		$dataAula.val('').removeClass('required').parent().hide();		
		$diaSemanaAula.addClass('required').parent().show();		
	}else{
		$diaSemanaAula.val('').removeClass('required').parent().hide();
		$dataAula.val('').removeClass('required').parent().hide();	
	}
		
}

mudarTipo_avulsa();
</script>