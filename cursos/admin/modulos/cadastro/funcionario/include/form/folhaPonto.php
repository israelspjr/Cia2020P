<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FolhaPonto = new FolhaPonto();
$DiaFolhaPonto = new DiaFolhaPonto();
$Funcionario = new Funcionario();

//INSERÇÃO/CARREGAMENTO DA FF
$idFolhaPonto = $_REQUEST['idFolhaPonto'];

if($idFolhaPonto){
	
	$valorFolhaPonto = $FolhaPonto->selectFolhaPonto(" WHERE idFolhaPonto = $idFolhaPonto");
	$idFuncionario = $valorFolhaPonto[0]['funcionario_idFuncionario'];
	$dataReferencia = $valorFolhaPonto[0]['dataReferencia'];
	$finalizar = $valorFolhaPonto[0]['finalizada'];
	$dataFinalizada = $valorFolhaPonto[0]['dataFinalizada'];
	$saldoInicial =  $valorFolhaPonto[0]['saldoInicial'];
	
	$tipoSaldoInicial =$valorFolhaPonto[0]['tipoSaldoInicial'];
//	$saldoFinal = $valorFolhaPonto[0]['saldoFinal'];
//	$tipoSaldoFinal = $valorFolhaPonto[0]['tipoSaldoFinal'];

	$dias = $DiaFolhaPonto->selectDiaFP(" WHERE folhaPonto_idFolhaPonto = ".$idFolhaPonto." ORDER BY dia ASC");
	
	// Verificar qdo não tem saldo inicial
	if ($saldoInicial == 0) {
		$dataReferenciaA = date("Y-m-d", strtotime("-1 months", strtotime($dataReferencia)));
		$valorFolhaPontoA = $FolhaPonto->selectFolhaPonto(" WHERE dataReferencia = '".$dataReferenciaA."' AND funcionario_idFuncionario = ".$idFuncionario."");
//		Uteis::pr($valorFolhaPontoA);
		$saldoInicial = $valorFolhaPontoA[0]['saldoFinal'];
		$tipoSaldoInicial = $valorFolhaPontoA[0]['tipoSaldoFinal'];
		
	}
//	echo $dataReferenciaA;
	
	$valorFunc = $Funcionario->selectFuncionario(" WHERE idFuncionario = ".$idFuncionario);
	//Uteis::pr(
	$nomeF = $valorFunc[0]['nome'];
	$horasTrabalho = Uteis::exibirHorasInput($valorFunc[0]['horasTrabalho']);
	$horasTNeutra = $valorFunc[0]['horasTrabalho'];
	//Uteis::pr($dias);
}

?>
<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<style>

</style>
<fieldset>
  <legend>Folha de ponto do mês <?php echo Uteis::exibirData($dataReferencia)?></legend>
  
  <div class="esquerda">        
    <p><label>Nome: <b><?php echo $nomeF;?></b></label>
  </div> 
  <div class="direita">        
    <p><label>Horas Diárias: <b><?php echo $horasTrabalho;?></b></label>
  </div>
  <?php if($finalizar == 0){ ?>
  <form id="form_SI" class="validate ff" method="post" action="" onsubmit="return false" >
  	
      Saldo Inicial: <input type="text" name="saldoInicial" id="saldoInicial" value="<?php echo Uteis::exibirHorasInput($saldoInicial)?>" class="hora required" size="5" /> 
      Tipo de Saldo <input type="radio" value="0" name="tipoSaldoInicial" <?php if($tipoSaldoInicial ==0) { echo "checked";}?>>Crédito &nbsp;&nbsp;&nbsp; <input type="radio" value="1" name="tipoSaldoInicial"<?php if($tipoSaldoInicial ==1) { echo "checked";}?> > Débito &nbsp;&nbsp;&nbsp; <button class="button blue" onClick="postForm('form_SI', '<?php echo CAMINHO_CAD."funcionario/include/acao/folhaPonto.php"?>', '<?php echo "&acao=saldoInicial&id=".$idFolhaPonto?>');">Salvar Saldo Inicial</button>
	   
  </form>
  <?php } else { ?>
 	 Saldo Inicial: <?php echo Uteis::exibirHorasInput($saldoInicial)?>
     Tipo de Saldo: <?php if($tipoSaldoInicial ==0) { echo "Crédito"; } else { echo "Débito"; } ?>
  <?php } ?>
  <div class="lista">

  <form id="form_FP" class="validate ff" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="idFolhaPonto" id="idFolhaPonto" value="<?php echo $idFolhaPonto?>" />
  
    
    <table id="tb_lista_FolhaFrequencia_form" class="registros">
      <thead>
        <tr>
        <th></th>
          <th>Dia</th>
          <th>Dia da semana</th>
          <th>Entrada</th>
          <th>Saida Intervalo</th>
          <th>Volta Intervalo</th>
          <th>Saída</th>
          <th>Ocorrência</th>
          <th>Créditos</th>
          <th>Débitos</th>
          <th>Banco</th>
          <th>Obs</th>
        </tr>
      </thead>
     
      <tbody>
        <?php 	
		 $anoRef = date('Y', strtotime($dataReferencia));
         $mesRef = date('m', strtotime($dataReferencia));

		 foreach ($dias as $valor) { 
		 	$x = $valor['dia'];
			$saldoDia = 0;
			$horasOcorrencia = 0;
			$saldoParcial = 0;
		 
		//	Uteis::pr($valor);
			
		
	/*		echo $x."|";
			echo $valor['banco'];
			echo "|";
			echo $valor['creditos'] ;
			echo "|";
			echo "ss".$valor['debitos'];
			echo "|";
			echo "|||".$saldoParcial;*/
			
			if (($valor['diaDaSemana'] == 'Sábado') || ($valor['diaDaSemana'] == 'Domingo')) {
				$class="reposicao";
				$diaFDS = ($valor['diaDaSemana']);
			} else {
				$class="";
			}
			
			if ($valor['ocorrenciaFP'] != 0) {
					$class2 = 'background-color: rgb(112 200 214 / 50%)';
					if (($valor['ocorrenciaFP'] == 8) || ($valor['ocorrenciaFP'] == 9)){
						$horasOcorrencia = 	$horasTNeutra;
					//	echo $horasOcorrencia;
					}
					if ($valor['ocorrenciaFP'] == 3) {
						$horasOcorrencia = -1*$horasTNeutra;
		//				echo "H".$horasOcorrencia ;
					}
			} else { 
					$class2 = 'background-color: white';
			}
			
			if ($valor['creditos'] != 0) {
					$class3 = 'background-color: green';
			} else { 
					$class3 = 'background-color: white';
			}
			
			if ($valor['debitos'] != 0) {
					$class4 = 'background-color: red';
			} else { 
					$class4 = 'background-color: white';
			}
			
			
			?>
            
            <tr align="center"  style="<?php echo $class2;?>" class="<?php echo $class?>"  id="linha_<?php echo $x;?>"> 
            
            <td></td>
              
              <!--DIA-->
              <td <?php echo $onclick?> ><?php echo $valor['dia']?></td>
              
              <!--DIA DA SEMANA-->
              <td <?php echo $onclick?> ><?php echo $valor['diaDaSemana']?></td>
              
              	  <?php if($finalizar == 0){ ?>
               
              <!--HORARIO DE ENTRADA -->
              
              <td > <?php if ($class=="reposicao") {
				  		echo $diaFDS; } else { ?>
                        	<input type="time" name="<?php echo "entrada_".$x?>" id="<?php echo "entrada_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['entrada'])?>" class="horas required" size="5" /> <?php } ?> </td>
              
              <!--Almoço-->
              <td><?php if ($class=="reposicao") {
				  		echo $diaFDS; } else { ?>
                        	<input type="time" name="<?php echo "almoco_".$x?>" id="<?php echo "almoco_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['saidaAlmoco'])?>" class="horas required" size="5" /> <?php } ?></td>
              
              <!--Volta Almoço-->
              <td ><?php if ($class=="reposicao") {
				  		echo $diaFDS; } else { ?>
                        	<input type="time" name="<?php echo "volta_".$x?>" id="<?php echo "volta_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['voltaAlmoco'])?>" class="horas required" size="5" /> <?php } ?>              </td>
              
              <!--Saida-->
              <td >  <?php if ($class=="reposicao") {
				  		echo $diaFDS; } else { ?>
                        	<input type="time" onfocusout="calcularBanco(<?php echo $x;?>)" name="<?php echo "saida_".$x?>" id="<?php echo "saida_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['saida'])?>" class="horas required" size="5" /> <?php } ?>            </td>
              
             <!--Ocorrencia-->
              <td >  <?php echo $DiaFolhaPonto->selectOcorrenciaSelect("",$valor['ocorrenciaFP'], "", $x);?>             </td>
              
              <!--Créditos-->
              <td id="credLinha_<?php echo $x?>" style="<?php echo $class3?>">   <input type="time" name="<?php echo "cred_".$x?>" onfocusout="calcularBanco(<?php echo $x;?>)" id="<?php echo "cred_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['creditos'])?>" class="horas required" size="5" />           </td>
              
              <!--Débitos-->
              <td id="debLinha_<?php echo $x?>" style="<?php echo $class4?>">   <input type="time" name="<?php echo "deb_".$x?>" onfocusout="calcularBanco(<?php echo $x;?>)" id="<?php echo "deb_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['debitos'])?>" class="horas required" size="5" />            </td>
              
              <?php
	//		  $saldoDia = ($valor['creditos'] - $valor['debitos']) + $valor['banco'];
			  if (($valor['diaDaSemana'] == 'Sábado') || ($valor['diaDaSemana'] == 'Domingo')) {
	//			  echo $valor['diaDaSemana'];
				  $horasTrabalhadas = $saldoDia;
				  
			  		
			  } else {
				   if ($valor['ocorrenciaFP'] != 3) {
				  	    $horasTrabalhadas = $saldoDia - $horasTNeutra + $horasOcorrencia; 
				   }
				   echo  "HT".$horasTrabalhadas;
			 		
			  }
		//	  echo $horasTrabalhadas;
			  if ($valor['ocorrenciaFP'] != 3) {
			  		if ($horasTrabalhadas <0 ) {
					    $horasTrabalhadas = -1 * $horasTrabalhadas;
			  	    }
			  }
		//	  echo "B".$valor['banco'];
		//	  echo  "HT".$horasTrabalhadas;
			  
			  if ($valor['banco'] != '0') {
				  	  $saldoParcial += ($valor['banco'] - $horasTrabalhadas );
			  } else {
					  if ($valor['ocorrenciaFP'] == 3) {
					  
					  	  $saldoParcial -= $horasTrabalhadas;
					  } 
				 //     } else {
				//		   $saldoParcial += $horasTrabalhadas; 
				//	  }
			  }
			  
		//	  echo "saldoFinal:".$x."|".$saldoParcial."<br>";
		//	  $saldoParcial = 0;
		//	  $saldoParcial += $saldoParcial;
				  $saldoInicial = $saldoInicial + $saldoParcial;
		//	 echo $saldoInicial;
			 
		//	 if ($x == 19) {
		//		break;  
		//	  }  
	
			   ?>
              
              <!--Banco-->
              <td><input type="text" name="<?php echo "banco_".$x?>" id="<?php echo "banco_".$x?>" value="<?php echo Uteis::exibirHorasInput($valor['banco'])?>" class="" size="5" style="min-width: 64px;"/> </td>
              
              <!--Observações-->
              <td><input type="text" name="<?php echo "obs_".$x?>" id="<?php echo "obs_".$x?>" value="<?php echo $valor['obs']?>" class=""  /></td>
			  <?php } else { ?>
              
              <td >      <?php echo Uteis::exibirHoras($valor['entrada'])?>       </td>
              
              <td >      <?php echo Uteis::exibirHoras($valor['saidaAlmoco'])?>        </td>
              
              <td >      <?php echo Uteis::exibirHoras($valor['voltaAlmoco'])?>        </td>
				  
			  <td >      <?php echo Uteis::exibirHoras($valor['saida'])?>        </td>
              
              <td >      <?php echo $DiaFolhaPonto->selectOcorrenciaSelect("",$valor['ocorrenciaFP'], "", $x, 1);?>         </td>
              
              <td >      <?php echo Uteis::exibirHoras($valor['creditos'])?>         </td>
              
              <td >      <?php echo Uteis::exibirHoras($valor['debitos'])?>        </td>
              
              <td >     <?php echo Uteis::exibirHoras($valor['banco'])?>         </td>
              
              <td>      <?php echo $valor['obs']?>        </td>
          
              <?php
				// Se estiver finalizada.
				
					  
		
				  
			  }
				   ?>
              
                </tr>
        <?php } 
	//	echo $saldototal;
	//	echo "<br>a".Uteis::exibirHoras($saldoInicial);
	//	echo "<br>".Uteis::exibirHoras($saldoParcial);
	//	if ($valor['ocorrenciaFP'] != 3) {
			$saldototal = $saldoInicial; // + $saldoParcial;
	//	} else {
	//		$saldototal = $saldoParcial;
	//	}
		?>
        
          </form>
            
        
      </tbody>
			
			 <tfoot>
        <tr>
        <th></th>
        <th>Dia</th>
          <th>Dia da semana</th>
          <th>Entrada</th>
      <th>Saida Intervalo</th>
          <th>Volta Intervalo</th>
             <th>Saída</th>
          <th>Ocorrência</th>
          <th>Créditos</th>
          <th>Débitos</th>
          <th>Banco</th>
          <th>Obs</th>
      </tfoot>
      
    </table>
  </div>
  
  <?php if($finalizar == 0){ 
  	 if ($saldototal < 0) {
		$saldototal = abs($saldototal);
		$tipoSaldoFinal = 1;
	};
		
  ?>
	  
	  
  <form id="form_SF" class="validate ff" method="post" action="" onsubmit="return false" >
 	 <input type="hidden" name="idFolhaPonto" id="idFolhaPonto" value="<?php echo $idFolhaPonto?>" />
      Saldo Final: <input type="text" name="saldoFinal" id="saldoFinal" value="<?php echo Uteis::exibirHorasInput($saldototal)?>" class="hora required" size="5" /> 
      Tipo de Saldo <input type="radio" value="0" name="tipoSaldoFinal" <?php if($tipoSaldoFinal ==0) { echo "checked";}?> >Crédito &nbsp;&nbsp;&nbsp; <input type="radio" value="1" name="tipoSaldoFinal" <?php if($tipoSaldoFinal ==1) { echo "checked";}?>> Débito &nbsp;&nbsp;&nbsp; <button class="button blue" onClick="postForm('form_SF', '<?php echo CAMINHO_CAD."funcionario/include/acao/folhaPonto.php"?>', '<?php echo "&acao=saldoFinal&id=".$idFolhaPonto?>');">Salvar Saldo Final</button>
	   
  </form>
  <div class="linha-inteira">
 
  <div class="esquerda">
  
     	<button class="button gray" onclick="gravar()" >Gravar</button>
        
        <?php if( $_SESSION['idFuncionario_SS'] == 33 ) {?>
               
	    	<button class="button blue" onclick="finalizarProfessor('1');" >Finalizar</button>
        
        <?php } ?>
      </div>
        </div>
        <div class="esquerda">
    <?php }else { 
	//	echo $saldototal;
	?>
		 Saldo Final: <?php echo Uteis::exibirHorasInput($saldototal)?>
         Tipo de Saldo: <?php if($tipoSaldoFinal ==0) { echo "Crédito"; } else { echo "Débito"; } ?>
         
		 
		 <?php if( $_SESSION['idFuncionario_SS'] == 33 ) {?>
    		<button class="button blue" onclick="finalizarProfessor('0');" >Desfinalizar</button>
        <?php } ?>
        <div style="float: right;"><label>Data de Finalização pelo Fincanceiro: </label><?php echo "<strong>".Uteis::exibirData($dataFinalizada)."</strong><br>"; ?></div>
        
    <?php }?>
    
    <?php if(!$finalizar){?>
        <form id="form_ff_obs" class="validate" method="post" action="" onsubmit="return false">
          <p>
            <label>Observação:</label>
            <textarea name="obs" id="obs" cols="80" rows="6" ><?php echo $obsFF?></textarea>
          </p>
          <p>
            <button class="button gray"  
            onclick="postForm('form_ff_obs', '<?php echo CAMINHO_CAD."funcionario/include/acao/folhaPonto.php?acao=gravaObs&id=".$idFolhaPonto?>')" > Enviar observação</button>
          </p>
        </form>
    <?php }else{ ?>
			<p><?php echo $obsFF?></p>
   <?php } ?>
        
  </div>
    
</fieldset>

<script src="<?php echo CAMINHO_CFG?>js/ff.js" language="javascript" type="text/javascript"></script>
<script>
function saldoFinal() {
    $("#saldoFinal").val();	
}
function gravar() {
	postForm('form_FP', '<?php echo CAMINHO_CAD."funcionario/include/acao/diaFp.php"?>')
}
function calcularFP(x) {
		$("#linha_"+x).css("background-color", "rgb(112 200 214 / 50%)");
		gravar();
}
function calcularBanco(x) {
	var entrada = $('#entrada_'+x).val();
//	console.log(entrada);
		if (entrada == "") {
			alert("Necessáio um valor para o campo entrada");
			return false;
		}
	var almoco = $('#almoco_'+x).val();
		if (almoco == "") {
			alert("Necessáio um valor para o campo saída para almoço");
			return false;
		}
	var hora1 = hmToMins(almoco) - hmToMins(entrada);
	var volta = $('#volta_'+x).val();
		if (volta == "") {
			alert("Necessáio um valor para o campo volta do almoço");
			return false;
		}
	var saida = $('#saida_'+x).val();
		if (saida == "") {
			alert("Necessáio um valor para o campo saída");
			return false;
		}
	var hora2 = hmToMins(saida) - hmToMins(volta) ;
//	console.log (hora1);
//	console.log(hora2);
	var cred = hmToMins($("#cred_"+x).val());
	if(cred >0) {
		$('#credLinha_'+x).css("background-color","green");	
		var somar = 1;
	}
	if(cred == 0) {
		$('#credLinha_'+x).css("background-color","white");
	}

	var deb = hmToMins($("#deb_"+x).val());
//	console.log(deb);
	if(deb >0) {
		$('#debLinha_'+x).css("background-color","red");
		var somar = 1;	
	}
	
	if(cred == 0) {
		$('#debLinha_'+x).css("background-color","white");
	}
	
	var saldoParcial = cred - deb;
//	console.log(saldoParcial);
//	console.log(hora1);
	if ((isNaN(hora1)) && (isNaN(hora2))){
		var diff = saldoParcial;
	} else {
		var diff = hora1 + hora2 + saldoParcial;
	}
//	console.log("ok"+diff);
	if (diff <0) { diff = diff *-1};
	
//	console.log("ok"+diff);
  if (isNaN(diff)) return false;
 
  var hhmm = [
      Math.floor(diff / 60), 
      Math.round(diff % 60)
  ].map(nr => `00${nr}`.slice(-2)).join(':');
   
  $('#banco_'+x).val(hhmm);
  gravar();
	
}

function hmToMins(str) {
//	console.log(str);
	if (str != undefined) {
  const [hh, mm] = str.split(':').map(nr => Number(nr) || 0);
  return hh * 60 + mm;
	}
}

tabelaDataTable('tb_lista_FolhaFrequencia_form','simples');

function finalizarProfessor(finalizar){	

   	postForm('', '<?php echo CAMINHO_CAD."funcionario/include/acao/folhaPonto.php" ?>', '<?php echo "&acao=finalizar&id=".$idFolhaPonto."&finalizar="?>'+finalizar);
}


function removerLink(){
//    var finalizar = <?=$finalizar;?>;
    if(finalizar){
        $('td').removeAttr("onclick");
    }
}
function avisoAula(campo){
    $('#'+campo).show();   
}
function avisoOff(campo){
    $('#'+campo).hide();
}
//removerLink();
ativarForm();
</script>
</div>