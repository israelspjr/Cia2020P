<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();
$Professor = new Professor();
$folha = new FolhaFrequencia();
$mes = date('m'); //$_REQUEST['mes'];
$ano = date("Y"); //$_REQUEST['ano'];
$idProfessor = $_SESSION['idProfessor_SS'];

//AULAS
$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($idProfessor, $mes, $ano, false);
//Uteis::pr($rsDemonstrativoPagamento);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}
//CARREGA TOTAIS
$valorTotalBruto = $valorTotalAulas; //+ $valorTotalCredito;
?>
<fieldset>
        <legend>Aulas Dadas</legend>
        <div class="lista">
          <table  id="tb_lista_AulasProfessor" class="registros">
            <thead>
              <tr>
                <th>Grupo</th>
                <th>FF</th>
                <th>Horas dadas</th>
                <th>Valor Hora</th>
                <th>Dias de aula</th>                
                <th>Valor Total Mês</th>
              </tr>
            </thead>
                        
            <tbody>
            <?php 
            if( $rsDemonstrativoPagamento ){
							foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
								
								$horaRealizada = $valorDemonstrativoPagamento['horaRealizada'];
								$valorHora = $valorDemonstrativoPagamento['valorHora'];
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
									" . $valorDemonstrativoPagamento['nome'] . " </td>";
//									<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver grupo\" 
	//								onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=".$valorDemonstrativoPagamento['idPlanoAcaoGrupo']."', '', '')\" /></td>
								
								echo "<td> 
									<img style=\"border:1px solid ".$cor.";\" src=\"" . CAMINHO_IMG . "pa.png\" title=\"Ver folha de frequencia\" 
									onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "ff/resourceHTML/ff.php?id=" . $valorDemonstrativoPagamento['idPlanoAcaoGrupo'] . "', '".$caminhoAtualizar."', '')\" />
								</td>
								
								<td>" . Uteis::exibirHoras($horaRealizada) . "</td>
								
								<td>R$ " . Uteis::formatarMoeda($valorHora) . 
								($ajudaCustoHora ? " <font color=\"#F00\"><br /> + R$ " . Uteis::formatarMoeda($ajudaCustoHora) . " por hora</font>" : "") .
								"</td>
								
								<td>" . ($diasAula. " dias") .
								($ajudaCustoDia ? " <font color=\"#F00\"><br /> + R$ " . Uteis::formatarMoeda($ajudaCustoDia) . " por dia</font>" : "") . 								
								 "</td>";
						
							
								echo "<td>R$ " . Uteis::formatarMoeda($total1) . "</td>
								
								</tr>";
							}
						}
						?>
						
            </tbody>
            
            <tfoot>
              <tr>
                <th colspan="2"><?php echo count($rsDemonstrativoPagamento)?> grupos</th>                
                <th><?php echo Uteis::exibirHoras($total_horasDadas) ?></th>
                <th></th>
                <th><?php echo $total_diasAulas ? $total_diasAulas : "0"?> dias</th>                
                <th>R$ <?php echo Uteis::formatarMoeda($total_totalMes) ?></th>
              </tr>
            </tfoot>
            
          </table>
        </div>
      </fieldset>

</div>
<script> 
//tabelaDataTable('tb_lista_AulasProfessor', 'simples'); 
</script>