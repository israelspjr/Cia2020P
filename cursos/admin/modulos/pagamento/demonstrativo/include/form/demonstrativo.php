<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();
$CreditoDebitoGrupo = new CreditoDebitoGrupo();
$ProfessorTipoImposto = new ProfessorTipoImposto();
$Professor = new Professor();
$folha = new FolhaFrequencia();
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$idProfessor = $_REQUEST['idProfessor'];

$DadosBancarios = new DadosBancarios();
$DescontoGeral = new DescontoGeral();

$caminhoAbrir = CAMINHO_PAG . "demonstrativo/include/";
$caminhoAtualizar = CAMINHO_PAG . "demonstrativo/include/form/demonstrativo.php?idProfessor=$idProfessor&ano=$ano&mes=$mes";
$ondeAtualiza = "";

//AULAS
$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano);
//Uteis::pr($rsDemonstrativoPagamento);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}

//CREDITO
$valorTotalCredito = 0;
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor . " AND tipo = 1 ";
$rsCredito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsCredito ){
	foreach ($rsCredito as $valorCredito) {
		$valorTotalCredito += $valorCredito['valor'];
	}
}

//DEBITOS
$valorTotalDebito = 0;
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor . " AND tipo = 2 ";
$rsDebito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsDebito ){
	foreach ($rsDebito as $valorDebito) {
		$valorTotalDebito += $valorDebito['valor'];
	}
}

//Debitos 2 DOC
$valorDoc = 0;
$mostrarDoc = 0;
$where = " WHERE professor_idProfessor = ".$idProfessor;
$rsDoc = $DadosBancarios->selectDadosBancarios($where);
$dataPesquisa = date("Y-m-t", strtotime($ano."-".$mes."-01"));
$rs = $DescontoGeral->selectDescontoGeral(" WHERE descricao = 'DOC' AND date(dataCadastro) < '".$dataPesquisa."'");
if ($rsDoc) {
	if ($rsDoc[0]['cobrarDoc'] == 1){
	$valorDoc = $rs[0]['valor'];
	
	$mostrarDoc = 1;	
	if ($valorTotalAulas == 0) {
		$valorDoc = 0;
		$mostrarDoc = 2;
		} else {
			$valorTotalDebito += $valorDoc;
		}
			
		
	}
}
//echo $valorDoc;

//CARREGA TOTAIS
$valorTotalBruto = $valorTotalAulas; //+ $valorTotalCredito;

//IMPOSTO
$valorTotalImposto = 0;
$where = " WHERE P.professor_idProfessor= " . $idProfessor;

$carMes = strlen($mes);

if ($carMes < 2) {
			$mes = "0".$mes;
		}
$rsProfessorTipoImposto = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, $valorTotalBruto,$ano, $mes);
//Uteis::pr($rsProfessorTipoImposto);
if( $rsProfessorTipoImposto ){
	foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto){
		$valorTotalImposto += $valorProfessorTipoImposto['total'];
	}
}


?>

<div id="dadosDemonstrativo"  class="conteudo_nivel">
 
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <p><strong>Professor</strong>: <?php echo $Professor->getNome($idProfessor);?></p>
  <fieldset>
    <legend>Demonstrativos gerados</legend>
    <div class="lista">
      <table id="tb_lista_historico" class="registros">
        <thead>
          <tr>
            <th></th>
            <th>Data</th>
            <th>Total</th>
            <th>Visualizar</th>
            <th></th>
            <th></th>
          </tr>
        </thead>        
        <tbody>
          <?php 
					$where = " WHERE mes = $mes AND ano = $ano AND professor_idProfessor = $idProfessor AND tipoDemo = 1 ORDER BY idDemonstrativoPagamento DESC";
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
<legend>Grupos</legend>
<table id="tb_lista_Grupos" class="registros">
  <thead>
    <tr>
      <th>Professor</th>
      <th>Grupo</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    echo $Professor->selectProfessorAtivoGrupo($idProfessor, $mes, $ano,$caminhoAtualizar);
  ?>
  </tbody>
  <tfoot>
    <tr>
      <th>Professor</th>
      <th>Grupo</th>
    </tr>
  </tfoot>
</table>
<script>tabelaDataTable('tb_lista_Grupos');</script> 
  
  </fieldset>
<fieldset>
        <legend>Aulas Dadas</legend>
        <div class="lista">
          <table  id="tb_lista_AulasProfessor" class="registros">
            <thead>
              <tr>
                <th>Grupo</th>
                <th>FF</th>
                <th>Data Fechamento</th>
                <th>Horas dadas</th>
                <th>Valor Hora</th>
           <!--     <th>Dias de aula</th>                -->
                <th>Valor Total Mês</th>
              </tr>
            </thead>
                        
            <tbody>
            <?php 
            if( $rsDemonstrativoPagamento ){
							foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
								
								$horaRealizada = $valorDemonstrativoPagamento['horaRealizada'];
								$valorHora = $valorDemonstrativoPagamento['valorHora'];
						//		echo $valorDemonstrativoPagamento['idFolhaFrequencia']."|".$valorHora;
						//			$ajudaCustoHora = $valorDemonstrativoPagamento['ajudaCustoHora'];
								$diasAula = $valorDemonstrativoPagamento['diasAula'];
						//			$ajudaCustoDia = $valorDemonstrativoPagamento['ajudaCustoDia'];
								$total = $valorDemonstrativoPagamento['total'];
								$ff = $folha->selectFolhaFrequencia("WHERE idFolhaFrequencia = ".$valorDemonstrativoPagamento['idFolhaFrequencia']);
                                
                                if($ff[0]['finalizadaParcial']==1){
                                    $cor = "#0000aa";
                                    if($ff[0]['finalizadaPrincipal']==1){
                                      $cor = "#00aa00";
                                    }
                                }else{
                                    $cor = "#aa0000";
                                }
                                    
                                $total1 = ($horaRealizada/60) * $valorHora;	
								$total_horasDadas += $horaRealizada;								
								$total_diasAulas += $diasAula;
								$total_totalMes += $total1;
								
						//		Uteis::pr($valorDemonstrativoPagamento);
								echo "<tr align=\"center\">
				
								<td>									
									" . $valorDemonstrativoPagamento['nome'] . " 
									<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver grupo\" 
									onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=".$valorDemonstrativoPagamento['idPlanoAcaoGrupo']."', '', '')\" /></td>
								
								<td> 
									<img style=\"border:1px solid ".$cor.";\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Ver folha de frequencia\" 
									onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=" . $valorDemonstrativoPagamento['idFolhaFrequencia'] . "', '".$caminhoAtualizar."', '')\" />
								</td>
								
								<td>". Uteis::exibirData($ff[0]['dataFinalizada'])."</td>
								
								<td>" . Uteis::exibirHoras($horaRealizada) . "</td>
								
								<td>R$ " . Uteis::formatarMoeda($valorHora) . 
								($ajudaCustoHora ? " <font color=\"#F00\"><br /> + R$ " . Uteis::formatarMoeda($ajudaCustoHora) . " por hora</font>" : "") .
								"</td>";
								
					//			<td>" . ($diasAula. " dias") .
					//			($ajudaCustoDia ? " <font color=\"#F00\"><br /> + R$ " . Uteis::formatarMoeda($ajudaCustoDia) . " por dia</font>" : "") . 								
					//			 "</td>";
						
							
								echo "<td>R$ " . Uteis::formatarMoeda($total1) . "</td>
								
								</tr>";
							}
						}
						?>
						
            </tbody>
            
            <tfoot>
              <tr>
                <th colspan="2"><?php echo count($rsDemonstrativoPagamento)?> grupos</th>                
                <th></th>
                <th><?php echo Uteis::exibirHoras($total_horasDadas) ?></th>
              <th></th>
                
              <!--  <th><?php echo $total_diasAulas ? $total_diasAulas : "0"?> dias</th>                -->
                <th>R$ <?php echo Uteis::formatarMoeda($total_totalMes) ?></th>
              </tr>
            </tfoot>
            
          </table>
        </div>
      </fieldset>
      
    
      <fieldset>
        <legend>Créditos e Débitos</legend>
        <div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Cadastrar Créditos/Débitos" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD . "professor/contratado/include/form/creditoDebitoGrupo.php"; ?>?idProfessor=<?php echo $idProfessor?>', '<?php echo $caminhoAtualizar?>', '');" />
	</div>
        <div class="lista">
          <table id="tb_lista_creditoDebitoGrupo_pag" class="registros">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Valor</th>
              </tr>
            </thead>            
            <tbody>
             <?php if($rsDoc[0]['cobrarDoc'] == 1) { 
			 			if($mostrarDoc == 2) {
				?> <tr><td align="center">Tarifa Doc (Não será cobrado pois não há saldo disponivel)</td><td align="center">  R$ <?php echo Uteis::formatarMoeda($valorDoc); ?> </td>
                <?php } else { ?>
            <tr><td align="center">Tarifa Doc</td><td align="center">  R$ <?php echo Uteis::formatarMoeda($valorDoc); ?> </td>
			<?php }
			 }?>
             <?php 
							$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $idProfessor;
							echo $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_demons($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);
            ?>
            </tbody>
          </table>
        </div>
        <p>
        
      </fieldset>
      
       <fieldset>
       <legend>Ajuda de Custo / Transporte</legend>
      <div class="lista">
          <table  id="tb_lista_AjudadeCusto" class="registros">
            <thead>
              <tr>
                <th>Grupo</th>
                <th>Horas dadas</th>
                <th>Ajuda de Custo Hora</th>
                <th>Dias de aula</th>
                <th>Ajuda de custo Dia</th>                
                <th>Valor Total Ajuda de Custo</th>
              </tr>
            </thead>
                        
            <tbody>
            <?php 
            if( $rsDemonstrativoPagamento ){
							foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
								
								$horaRealizada = $valorDemonstrativoPagamento['horaRealizada'];
								$valorHora = $valorDemonstrativoPagamento['valorHora'];
									$ajudaCustoHora = $valorDemonstrativoPagamento['ajudaCustoHora'];
								$diasAula = $valorDemonstrativoPagamento['diasAula'];
									$ajudaCustoDia = $valorDemonstrativoPagamento['ajudaCustoDia'];
									$tajudaCustodia = $valorDemonstrativoPagamento['tajudaCustoDia'];
									$tajudaCustohora = $valorDemonstrativoPagamento['tajudaCustohora'];
								$total = $valorDemonstrativoPagamento['total'];
								$totalAjuda = $valorDemonstrativoPagamento['totalAjuda'];
								$ff = $folha->selectFolhaFrequencia("WHERE idFolhaFrequencia = ".$valorDemonstrativoPagamento['idFolhaFrequencia']);
                                
                                if($ff[0]['finalizadaParcial']==1){
                                    $cor = "#0000aa";
                                    if($ff[0]['finalizadaPrincipal']==1){
                                      $cor = "#00aa00";
                                    }
                                }else{
                                    $cor = "#aa0000";
                                }
                                    
                                
								$total_horasDadasA += $horaRealizada;								
								$total_diasAulasA += $diasAula;
								$totalajudaCustodia += $tajudaCustodia; 
								$total_totalMesA += $totalAjuda;
								$totalajudaCustohora += $tajudaCustohora;
								
								//Uteis::pr($valorDemonstrativoPagamento);
								echo "<tr align=\"center\">
				
								<td>									
									" . $valorDemonstrativoPagamento['nome'] . " 
									<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver grupo\" 
									onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=".$valorDemonstrativoPagamento['idPlanoAcaoGrupo']."', '', '')\" /></td>
								
								<!--<td> 
									<img style=\"border:1px solid ".$cor.";\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Ver folha de frequencia\" 
									onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/folhaFrequencia_abas.php?idFolhaFrequencia=" . $valorDemonstrativoPagamento['idFolhaFrequencia'] . "', '".$caminhoAtualizar."', '')\" />
								</td>-->
								
								<td>" . Uteis::exibirHoras($horaRealizada) . "</td>
								
								<td>" .// Uteis::formatarMoeda($valorHora) . 
								($ajudaCustoHora ? " <font color=\"#F00\"> + R$ " . Uteis::formatarMoeda($ajudaCustoHora) . " por hora</font>" : "") .
								"</td>
								
								<td>" . ($diasAula. " dias") . "</td>
								<td>" .
								($ajudaCustoDia ? " <font color=\"#F00\"> + R$ " . Uteis::formatarMoeda($ajudaCustoDia) . " por dia</font>" : "") . 								
								 "</td>
								
								<td>R$ " . Uteis::formatarMoeda($totalAjuda) . "</td>
								
								</tr>";
							}
						}
						?>
						
            </tbody>
            
            <tfoot>
              <tr>
                <th><?php echo count($rsDemonstrativoPagamento)?> grupos</th>                
                <th><?php echo Uteis::exibirHoras($total_horasDadasA) ?></th> 
                <th><?php echo Uteis::formatarMoeda($totalajudaCustohora) ?></th>
                <th><?php echo $total_diasAulasA ? $total_diasAulasA : "0"?> dias</th> 
                <th><?php echo Uteis::formatarMoeda($totalajudaCustodia) ?></th>               
                <th>R$ <?php echo Uteis::formatarMoeda($total_totalMesA) ?></th>
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
				
								<td>" . $valorProfessorTipoImposto['nome'] . "</td>";
				
		$param .= $valorProfessorTipoImposto['nome']."=".$valorProfessorTipoImposto['total']."&";	
		$param2 .= $valorProfessorTipoImposto['nome']."=".$valorProfessorTipoImposto['total']."&";						
								
echo "								<td>" . Uteis::formatarMoeda($valorProfessorTipoImposto['porcentagem']) . " %". 
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

$valorTotalLiquido = $valorTotalAulas + $valorTotalCredito  - $valorTotalDebito - $valorTotalImposto; 

//PARAMETROS PARA GRAVAR
$param .= "idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . "&valorTotalLiquido=" . $valorTotalLiquido . "&valorTotalBruto=" . $valorTotalBruto;	
$param2 .= "idProfessor=" . $idProfessor . "&mes=" . $mes . "&ano=" . $ano . "&valorTotalLiquido=" . $valorTotalLiquido . "&valorTotalBruto=" . $valorTotalBruto;


	?>  
      
      <fieldset>
        <legend>Totais</legend>
        <div class="lista">
          <table  id="tb_lista_total" class="registros">
            <thead>
              <tr>
                <th>Aulas</th>
                <th>Créditos</th>
                <th>Débitos</th> 
                <th>Ajuda de Custo</th>              
                <th>Impostos</th>
                <th>Total</th>
              </tr>
            </thead>
            <tr>
              <td>R$ <?php echo Uteis::formatarMoeda($total_totalMes)?></td>
              <td>R$ <?php echo Uteis::formatarMoeda($valorTotalCredito)?></td>
              <td>R$ <?php echo Uteis::formatarMoeda($valorTotalDebito)?></td>
              <td>R$ <?php echo Uteis::formatarMoeda($total_totalMesA)?></td>              
              <td>R$ <?php echo Uteis::formatarMoeda($valorTotalImposto)?></td>
              <td>R$ <?php echo Uteis::formatarMoeda($valorTotalLiquido)?></td>
            </tr>           
          </table>
        </div>
      </fieldset>


</div>
<script> 
tabelaDataTable('tb_lista_historico', 'ordenaColuna_simples'); 
tabelaDataTable('tb_lista_creditoDebitoGrupo_pag', 'simples'); 
tabelaDataTable('tb_lista_AulasProfessor', 'simples'); 
tabelaDataTable('tb_lista_imposto', 'simples'); 
tabelaDataTable('tb_lista_total', 'simples');
tabelaDataTable('tb_lista_AjudadeCusto','simples');

function gravarDemons(){
	postForm('', '<?php echo CAMINHO_PAG."demonstrativo/include/acao/demonstrativo.php"?>', '<?php echo $param?>');
}

function gravarDemonsAux(id){
	postForm('', '<?php echo CAMINHO_PAG."demonstrativo/include/acao/demonstrativo.php"?>', '<?php echo $param2?>&id='+id);
}

function Atualizar(){
    carregarModulo('<?php echo $caminhoAtualizar;?>','this');  
}
</script>