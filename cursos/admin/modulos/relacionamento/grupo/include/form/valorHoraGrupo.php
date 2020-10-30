<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ValorHoraGrupo = new ValorHoraGrupo();
$Modalidade = new Modalidade();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idValorHoraGrupo = $_GET['id'];
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

if( $idValorHoraGrupo ){
	
	$valor = $ValorHoraGrupo->selectValorHoraGrupo(" WHERE idValorHoraGrupo = ".$idValorHoraGrupo);

	$idPlanoAcaoGrupo = $valor[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$idModalidade = $valor[0]['modalidade_idModalidade'];
	$valorHora = Uteis::formatarMoeda($valor[0]['valorHora']);
	$cargaHorariaFixaMensal = $valor[0]['cargaHorariaFixaMensal'] ? Uteis::exibirHoras($valor[0]['cargaHorariaFixaMensal']) : "";
	$valorDescontoHora = $valor[0]['valorDescontoHora'] ? Uteis::formatarMoeda($valor[0]['valorDescontoHora']) : "";
	$validadeDesconto = $valor[0]['validadeDesconto'] ? Uteis::exibirData($valor[0]['validadeDesconto']) : "";
	$previsaoReajuste = Uteis::exibirData($valor[0]['previsaoReajuste']);
	$dataInicio = Uteis::exibirData($valor[0]['dataInicio']);
    $dataFim = Uteis::exibirData($valor[0]['dataFim']);
	$naoPagarProfessor = $valor[0]['naoPagarProfessor'];
	/*$valorHoraProfessor = Uteis::formatarMoeda($valor[0]['valorHoraProfessor']);*/
		
}

$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Valor hora do grupo</legend>
    <form id="form_ValorHoraGrupo" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <div class="linha-inteira">
      <p>
          <label><strong>Qualquer alteração realizada neste formulário pode acarretar em erro de valores.
              <br />Em caso de alteração de valor entre pelo botão adicionar</strong></label>
      </p>
      </div>
      <div class="esquerda">
      <p>
        <label>Modalidade:</label>
        <?php 
		$and = " AND idModalidade IN (
			SELECT modalidade_idModalidade FROM modalidadeIdioma WHERE idioma_idIdioma IN(".$idIdioma.")
		)";
		echo $Modalidade->selectModalidadeSelect("required", $idModalidade, $and);?>
        <span class="placeholder">Campo Obrigatório</span></p>
      <?php //if($idValorHoraGrupo) {?>
     
     
      <p>
        <label><strong>Inicio em:</strong></label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data" value="<?php echo $dataInicio;?>" />
        <span class="placeholder">Campo Obrigatório</span> 
     </p>
     <p>
        <label><strong>Término em:</strong></label>
        <input type="text" name="dataFim" id="dataFim" class="data" value="<?php echo $dataFim;?>" />
         
     </p>        
      <p>
        <label><strong>Valor hora:</strong></label>
        <input type="text" id="valorHora" name="valorHora" class="required numeric" value="<?php echo $valorHora;?>" />
        <span class="placeholder">Campo Obrigatório</span>      
       </p>
      <p>
         <label>Carga horária fixa mensal:</label>
        <input type="text" id="cargaHorariaFixaMensal" name="cargaHorariaFixaMensal" class="hora" value="<?php echo $cargaHorariaFixaMensal;?>" />
        <span class="placeholder"></span>             
      </p>
      <p>
          <label>Valor do desconto (R$ por hora):</label>
        <input type="text" id="valorDescontoHora" name="valorDescontoHora" class="numeric" value="<?php echo $valorDescontoHora;?>" />
        <span class="placeholder"></span> </p> 
      <p>
        <label>Validade do desconto:</label>
        <input type="text" id="validadeDesconto" name="validadeDesconto" class="data" value="<?php echo $validadeDesconto;?>" />
      <p>
        <label>Previsão de reajuste (se deixar em branco, fará o cálculo de 1 ano):</label>
        <input type="text" name="previsaoReajuste" id="previsaoReajuste" class="required data" value="<?php echo $previsaoReajuste;?>" />
        <span class="placeholder">Campo Obrigatório</span> 
      </p>
      </div>
      <div class="direita">
       <p>
        <label><strong>Não pagar professor (CLT):</strong></label>
        <input type="checkbox" name="naoPagarProfessor" id="naoPagarProfessor" class="" <?php if ($naoPagarProfessor == 1) {echo "checked=checked"; } ?> value="1" />
     </p>     
  <!--    <p>
        <label><strong>Valor hora Professor:</strong></label>
        <input type="text" id="valorHoraProfessor" name="valorHoraProfessor" class="numeric" value="<?php echo $valorHoraProfessor;?>" />
      </p>-->
       
       </div>
      <div class="linha-inteira">
      
      <?php //}else{ ?>
 <!--     <p>
        <label>Inicio em:</label>
        <input type="text" name="dataInicio" id="dataInicio" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
         <p>
        <label><strong>Término em:</strong></label>
        <input type="text" name="dataFim" id="dataFim" class="data" value="<?php echo $dataFim;?>" />
         
     </p>   
      <p>
        <label><strong>Valor hora:</strong></label>
        <input type="text" id="valorHora" name="valorHora" class="required numeric" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Carga horária fixa mensal:</label>
        <input type="text" id="cargaHorariaFixaMensal" name="cargaHorariaFixaMensal" class="hora" />
        <span class="placeholder"></span> </p>
      <p>
        <label>Valor do desconto (R$ por hora):</label>
        <input type="text" id="valorDescontoHora" name="valorDescontoHora" class="numeric" />
        <span class="placeholder"></span> </p>
      <p>
        <label>Validade do desconto:</label>
        <input type="text" id="validadeDesconto" name="validadeDesconto" class="data" />
      </p>
      <p>
        <label>Previsão de reajuste (se deixar em branco, fará o cálculo de 1 ano):</label>
        <input type="text" name="previsaoReajuste" id="previsaoReajuste" class="data" />
      </p>
      <?php// }?>-->
      <p>
        <button class="button blue" onclick="postForm('form_ValorHoraGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/valorHoraGrupo.php?id=$idValorHoraGrupo"?>');">Salvar</button>
      </p>
    </form>
  </fieldset>
  </div>
</div>
<script>ativarForm();</script> 
