<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();
$DadosBancarios = new DadosBancarios();
$ProfessorTipoImposto = new ProfessorTipoImposto();
$Professor = new Professor();
$OutrosServicos = new OutrosServicos();
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$idProfessor = $_REQUEST['idProfessor'];

$caminhoAbrir = CAMINHO_PAG . "demonstrativo/consultoria/include/";
$caminhoAtualizar = CAMINHO_PAG . "demonstrativo/consultoria/include/form/demonstrativo.php?idProfessor=$idProfessor&ano=$ano&mes=$mes";
$ondeAtualiza = "";
$semImpostos = 0;

$where = "WHERE tipo <> 7 AND mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor;
$rsValor = $OutrosServicos ->selectOutrosServicosTr_total($where);
//Uteis::pr($rsValor);

foreach ($rsValor as $rsValorTotal) {
	if ($rsValorTotal['impostos'] == 0) {
		$valorTotal += $rsValorTotal['valor'];	
	} else {
		$vNaoCobrar += $rsValorTotal['valor'];
	}
}


$valorTotalGeral += $valorTotal + $vNaoCobrar;
/*
echo $valorTotalGeral."<br>";
echo $valorTotal."<br>";
echo $vNaoCobrar;

echo $vTotal."valortotal".$valorTotal;*/

$where = "WHERE tipo = 7 AND mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor;
$rsValorDeb = $OutrosServicos ->selectOutrosServicosTr_total($where);

foreach ($rsValorDeb as $rsValorTotalDeb) {
    $valorDebito += $rsValorTotalDeb['valor'];
}

//IMPOSTO
$valorTotalImposto = 0;
$where = " WHERE P.professor_idProfessor= " . $idProfessor;
if ($mes < 10) {
			$mes = "0".$mes;
		}

$rsProfessorTipoImposto = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, $valorTotal, $ano, $mes);


if( $rsProfessorTipoImposto ){
	foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto){
		$valorTotalImposto += $valorProfessorTipoImposto['total'];
	}
}

//echo $valorTotalImposto;

//Debitos 2 DOC
$valorDoc = 0;
$where = " WHERE professor_idProfessor = ".$idProfessor;
$rsDoc = $DadosBancarios->selectDadosBancarios($where);
if ($rsDoc) {
	if ($rsDoc[0]['cobrarDoc'] == 1)
	$valorDoc = $rsDoc[0]['valor'];
	$valorDebito += $valorDoc;
}
?>

<div id="dadosDemonstrativo"  class="conteudo_nivel">
 
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <p><strong>Professor</strong>: <?php echo $Professor->getNome($idProfessor);?></p>

  <fieldset>
    <legend>Demonstrativos gerados - Serviços de Consultoria</legend>
    <div class="lista">
   
      <table id="tb_lista_historico" class="registros">
        <thead>
          <tr>
            <th></th>
            <th>Data</th>
            <th>Valor</th>
            <th>Visualizar</th>
            <th>Ação</th>
            <th></th>
          </tr>
        </thead>        
        <tbody>
          <?php 
					$where = " WHERE mes = $mes AND ano = $ano AND professor_idProfessor = $idProfessor AND tipoDemo = 2 ORDER BY idDemonstrativoPagamento DESC";
					echo $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_historico($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);
				?>				
        </tbody>
      </table>

	  <?php 
	  $temDemonstrativoPagamento = $DemonstrativoPagamento->selectDemonstrativoPagamento($where);
	  
	  if(!$temDemonstrativoPagamento){?>
     	<button class="button blue" onclick="gravarDemons()">Gerar demonstrativo</button>
      <?php }else{
				$idDemonstrativoPagamento =  $temDemonstrativoPagamento[0]["idDemonstrativoPagamento"];
			?>
      	<button class="button gray" onclick="gravarDemonsAux('<?php echo $idDemonstrativoPagamento?>')">Gerar demonstrativo complementar</button>
      <?php } ?>
		<!--<button class="button blue" onclick="Atualizar()">Atualizar</button>-->	 
    </div>    
  </fieldset>
<fieldset>
        <legend>Outros Serviços (Consultoria | Tradução | Versão)</legend>
          <?php if($valorDoc > 0) { ?>
        <label>Cobrar Tarifa DOC:</label>
        R$ <?php echo Uteis::formatarMoeda($valorDoc); }?>
        <div class="lista">
          <table  id="tb_lista_AulasProfessor" class="registros">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Obs:</th>
                <th>Valor</th>
                <th>Não Cobrar Impostos</th>
                </tr>
            </thead>
                        
            <tbody>
            <?php
				echo $OutrosServicos -> selectOutrosServicos_demons(CAMINHO_CAD . "professor/contratado/include/form/outrosServicos.php", CAMINHO_CAD . "professor/contratado/include/resourceHTML/outrosServicos.php?id=" . $idProfessor, "#div_outrosServicos", "WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND professor_idProfessor = " . $idProfessor, CAMINHO_CAD . "professor/contratado");
				?>
            </tbody>
            <tfoot>
              <tr>
                <th>TOTAL</th>                
                <th></th>
      
                <th>R$ <?php echo Uteis::formatarMoeda($valorTotal + $vNaoCobrar - $valorDebito); ?></th>
                <th></th>
              </tr>
            </tfoot>
           </table>
        </div>
      </fieldset>
      
      <fieldset>
        <legend>Impostos</legend>
        <div class="lista">
          <table  id="tb_lista_imposto" class="registros">
            <thead>
              <tr>
                <th>Imposto</th>
                <th>Aliquota</th>
                <!-- <th>Parcela Dedutiva</th> -->
                <th>Valor</th>
                </tr>
            </thead>           
            <tbody>
            <?php 
						if( $rsProfessorTipoImposto ){
							foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto) {

								echo "<tr align=\"center\">
				
								<td>" . $valorProfessorTipoImposto['nome'] . "</td>
								
								<td>" . Uteis::formatarMoeda($valorProfessorTipoImposto['porcentagem']) . " %". 
									($valorProfessorTipoImposto['parcelaDedutiva'] ? " - R$ ".Uteis::formatarMoeda($valorProfessorTipoImposto['parcelaDedutiva'])."" : "")."</td>
								
								
								<td>R$ " . Uteis::formatarMoeda($valorProfessorTipoImposto['total']) . "</td>
								
								</tr>";
							}
						}
						?>
            </tbody>
          </table>
        </div>
      </fieldset>
<?php 
//Fechamento

$valorTotalLiquido = $valorTotal + $vNaoCobrar - $valorTotalImposto - $valorDebito; 

//PARAMETROS PARA GRAVAR
$param = "idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . "&valorTotalLiquido=" . $valorTotalLiquido . "&valorTotalBruto=" . ($valorTotal+ $vNaoCobrar)."&valorDebito=".$valorDebito."&semImpostos=".$vNaoCobrar;	
	
	?>  
      
      <fieldset>
        <legend>Totais</legend>
        <div class="lista">
          <table  id="tb_lista_total" class="registros">
            <thead>
              <tr>
                <th>Serviços</th>
                <th>Débitos</th>
                <th>Impostos</th>
                <th>Total</th>
              </tr>
            </thead>
            <tr>
              <td align="center">R$ <?php echo Uteis::formatarMoeda($valorTotal+ $vNaoCobrar)?></td>
              <td align="center">R$ <?php echo Uteis::formatarMoeda($valorDebito)?></td>
              <td align="center">R$ <?php echo Uteis::formatarMoeda($valorTotalImposto)?></td>
              <td align="center">R$ <?php echo Uteis::formatarMoeda($valorTotalLiquido)?></td>
            </tr>           
          </table>
        </div>
      </fieldset>


</div>
<script> 
tabelaDataTable('tb_lista_historico', 'ordenaColuna_simples'); 
tabelaDataTable('tb_lista_AulasProfessor', 'simples'); 
tabelaDataTable('tb_lista_imposto', 'simples'); 
tabelaDataTable('tb_lista_total', 'simples');


function gravarDemons(){
	postForm('', '<?php echo CAMINHO_PAG."demonstrativo/consultoria/include/acao/demonstrativo.php"?>', '<?php echo $param?>');
}

function gravarDemonsAux(id){
	postForm('', '<?php echo CAMINHO_PAG."demonstrativo/consultoria/include/acao/demonstrativo.php"?>', '<?php echo $param?>&id='+id);
}

function Atualizar(){
    carregarModulo('<?php echo $caminhoAtualizar;?>','this');  
}
</script>