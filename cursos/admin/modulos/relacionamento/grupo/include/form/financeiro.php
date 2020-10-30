<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorHoraGrupo.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");	


$Modalidade= new Modalidade();
$ValorHoraGrupo = new ValorHoraGrupo();

$idPlanoAcaoGrupo = $_REQUEST['id'];

	
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo. "  AND (dataFim is null or dataFim = '')  LIMIT 1";
	
$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo($where);


$idValorHoraGrupo = $rsValorHoraGrupo[0]['idValorHoraGrupo'];
$planoAcaoGrupoIdPlanoAcaoGrupo = $rsValorHoraGrupo[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

$modalidadeIdModalidade = $rsValorHoraGrupo[0]['modalidade_idModalidade']; // select
$valorHora = Uteis::formatarMoeda($rsValorHoraGrupo[0]['valorHora']); // dinheiro
$cargaHorariaFixaMensal = Uteis::exibirHorasInput($rsValorHoraGrupo[0]['cargaHorariaFixaMensal']);// horas
$valorDescontoHora = Uteis::formatarMoeda($rsValorHoraGrupo[0]['valorDescontoHora']); // dinheiro
$validadeDesconto = Uteis::exibirData($rsValorHoraGrupo[0]['validadeDesconto']); // data
$previsaoReajuste = Uteis::exibirData($rsValorHoraGrupo[0]['previsaoReajuste']); // data ou dataInicio + 1 ano

//print_r($rsValorHoraGrupo);

?>

<fieldset>
<legend>Valor hora</legend>

<form id="form_financeiroGrupo" class="validate" action="" method="post" onsubmit="return false" >
  
  <div class="menu_interno">
  
  <img src="<?php echo CAMINHO_IMG?>pasta.png" title="VER HISTÓRICO"
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/financeiroHistorico.php?id=".$idValorHoraGrupo."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '', '')"  />
  
  </div>
  
  <div class="esquerda">
      <p>
        <label>Modalidade:</label>
        <?php echo $Modalidade->selectModalidadeSelect("required", $modalidadeIdModalidade, "");?> <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Valor Hora:</label>
        <input type="text" name="valorHora" id="valorHora" class="required" value="<?php echo $valorHora?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Carga Horaria Fixa Mensal:</label>
        <input type="text" name="cargaHorariaFixaMensal" id="cargaHorariaFixaMensal" class="hora"  value="<?php echo $cargaHorariaFixaMensal?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
        
</div>
       <div class="direita">
      <p>
        <label>Valor Desconto Hora:</label>
        <input type="text" name="valorDescontoHora" id="valorDescontoHora" class=""  value="<?php echo $valorDescontoHora?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
  
  <!-- só é obrigatorio se o desconto for preenchido-->
  <p>
    <label>Validade Desconto:</label>
    <input type="text" name="validadeDesconto" id="validadeDesconto" class="data" value="<?php echo $validadeDesconto?>" />
    <span class="placeholder">Campo Obrigatório</span> </p>
  <p>
    <label>Previsão Reajuste:</label>
    <input type="text" name="previsaoReajuste" id="previsaoReajuste" class="data" value="<?php echo $previsaoReajuste?>" />
    <span class="placeholder">Campo Obrigatório</span> </p>
  <p>
    <button class="button blue" onclick="postForm('form_financeiroGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/financeiro.php?id=".$idValorHoraGrupo."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>');"> Enviar</button>
    
  </p>
  </div>
</form>
</fieldset>

<script>
ativarForm();
</script> 
