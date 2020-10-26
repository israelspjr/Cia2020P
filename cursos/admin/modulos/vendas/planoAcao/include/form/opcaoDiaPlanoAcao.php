<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$end = new Endereco();
$PlanoAcao = new PlanoAcao();
$LocalAula = new LocalAula();
$Endereco = new Endereco();
$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();
$OpcaoDia = new OpcaoDia();
$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();

$idValorSimuladoPlanoAcao = $_GET['idValorSimuladoPlanoAcao'];

$idOpcaoDia = $_GET['id'];		

if( $idOpcaoDia ){	
	$valorOpcaoDia = $OpcaoDia->selectOpcaoDia(" WHERE idOpcao = ".$idOpcaoDia);	
	$idValorSimuladoPlanoAcao = $valorOpcaoDia[0]['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'];
}

$where = " WHERE idValorSimuladoPlanoAcao = ".$idValorSimuladoPlanoAcao;
$valorValorSimuladoPlanoAcao = $ValorSimuladoPlanoAcao->selectValorSimuladoPlanoAcao($where);

$idPlanoAcao = $valorValorSimuladoPlanoAcao[0]['planoAcao_idPlanoAcao'];
$frequenciaSemanalAula = $valorValorSimuladoPlanoAcao[0]['frequenciaSemanalAula'];

$horaNaoGeraFf = $valorValorSimuladoPlanoAcao[0]['horaNaoGeraFf'] ? $valorValorSimuladoPlanoAcao[0]['horaNaoGeraFf'] : 0;
$horasPorAula = $valorValorSimuladoPlanoAcao[0]['horasPorAula'] - $horaNaoGeraFf;

$tipo = $valorValorSimuladoPlanoAcao[0]['tipo'];

if( $idOpcaoDia ){
	
	$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao->selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = ".$idOpcaoDia);

	for($row = 0; $row < count($valorOpcaoDiaPlanoAcao,0); $row++){
		$horaInicio[$row] = Uteis::exibirHoras($valorOpcaoDiaPlanoAcao[$row]['horaInicio']);
		$diaSemana[$row] = $valorOpcaoDiaPlanoAcao[$row]['diaSemana'];
		$idLocalAula[$row] = $valorOpcaoDiaPlanoAcao[$row]['localAula_idLocalAula'];
		$idEndereco[$row] = $valorOpcaoDiaPlanoAcao[$row]['endereco_idEndereco'];
		$dataAula[$row] = $valorOpcaoDiaPlanoAcao[$row]['dataAula'];
    }            
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <?php if( $tipo == "R" ){?>
    
    <form id="form_opcaoDiaPlanoAcao" class="validate" action="" method="post" onsubmit="return false" >
    
        <input type="hidden" name="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao" id="valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao" value="<?php echo $idValorSimuladoPlanoAcao?>" />
        
        <input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo?>" />
            
        <input type="hidden" name="frequenciaSemanalAula" id="frequenciaSemanalAula" value="<?php echo $frequenciaSemanalAula?>" />
        
        <?php for($d=0; $d<$frequenciaSemanalAula; $d++){?>
            <fieldset>
              <legend>Dia <?php echo $d+1?></legend>
              <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_opcaoDiaPlanoAcao_<?php echo $d?>" onclick="abrirFormulario('form_opcaoDiaPlanoAcao_<?php echo $d?>', 'img_opcaoDiaPlanoAcao_<?php echo $d?>');" />
              <input type="hidden" name="idOpcaoDia" id="idOpcaoDia" value = "<?=$idOpcaoDia?>">
              <div class="agrupa" id="form_opcaoDiaPlanoAcao_<?php echo $d?>" >
                <div class="esquerda">
                  <p>
                    <label>Hora de início:</label>
                    <input type="text" name="horaInicio_<?php echo $d?>" id="horaInicio_<?php echo $d?>" value="<?php echo $horaInicio[$d]?>" class="required hora"/>
                    <span class="placeholder">Campo obrigatório</span> </p>
                  <p>
                    <label>Dia da semana:</label>
                    <select name="diaSemana_<?php echo $d?>" id="diaSemana_<?php echo $d?>" class="required" >
                      <option value="" >Selecione</option>
                      <option value="1" <?php echo $diaSemana[$d]==1 ? "selected" : "";?> >domingo</option>
                      <option value="2" <?php echo $diaSemana[$d]==2 ? "selected" : "";?> >segunda-feira</option>
                      <option value="3" <?php echo $diaSemana[$d]==3 ? "selected" : "";?> >terça-feira</option>
                      <option value="4" <?php echo $diaSemana[$d]==4 ? "selected" : "";?> >quarta-feira</option>
                      <option value="5" <?php echo $diaSemana[$d]==5 ? "selected" : "";?> >quinta-feira</option>
                      <option value="6" <?php echo $diaSemana[$d]==6 ? "selected" : "";?> >sexta-feira</option>
                      <option value="7" <?php echo $diaSemana[$d]==7 ? "selected" : "";?> >sábado</option>
                    </select>
                    <span class="placeholder">Campo obrigatório</span> </p>
                </div>
                <div class="direita">
                  <p>
                    <label>Local alternativo de aula:</label>
                     <?php echo $LocalAula->selectLocalAulaSelect("required", $idLocalAula[$d], " AND excluido = 0 ", $d);?> 
                    <span class="placeholder">Campo obrigatório</span>
                  </p>
                  <p id="op1_<?php echo $d?>" style="display:none;"> 
                    <label >Endereço:</label>
                     <?php echo $Endereco->selectEnderecoSelectPlanoAcaoArray("", $idEndereco[$d], $idPlanoAcao, $d);?> 
                 </p>
                  <p id="op2_<?php echo $d?>" style="display:none;">
                    <label>Endereço(Endereço, número, CEP(00000-000), Complemento):</label> <input type="text" name="endereco_novo_<?php echo $d?>" id="endereco_novo_<?php echo $d?>" value = "<?php if($endereco[$d][0]['rua']!="") echo $endereco[$d][0]['rua'].",".$endereco[$d][0]['numero'];?>"/>
                 </p>                 
                  <p id="op3_<?php echo $d?>" style="display:none;">
                    <label>Companhia de Idiomas:</label><br />
                     <b><?php echo ENDERECO;?></b> 
                 </p>  
                 <p id="op4_<?php echo $d?>" style="display:none;">
                   <label >Endereço:</label>
                     <?php echo $Endereco->selectEnderecoSelectPlanoAcaoEmp("", $idEndereco[$d], $idPlanoAcao, $d);?>
                   </p> 
                </div>
              </div>
            </fieldset>
            <input type="hidden" name="idEndereco_<?php echo $d;?>" id="idEndereco_<?php echo $d;?>" value="" />
			<script>
                function mudarCampo<?php echo $d?>(){
                    var idLocalAula<?php echo $d?> = $("#idLocalAula<?php echo $d?> option:selected").val();
					  if(idLocalAula<?php echo $d?> == ''){
					      $("#idEndereco_<?php echo $d?>").val("");      
                          $("#op3_<?php echo $d?>").hide();  
                          $("#op2_<?php echo $d?>").hide();
                          $("#op1_<?php echo $d?>").hide();
                          $("#op4_<?php echo $d?>").hide();
                          $("#op2html_<?php echo $d?>").hide(); 
					  }					  
					  if(idLocalAula<?php echo $d?> == 1){
    					  $("#idEndereco_<?php echo $d?>").val("");	  
                          $("#op3_<?php echo $d?>").hide();  
                          $("#op2_<?php echo $d?>").hide();
                          $("#op1_<?php echo $d?>").show();
    					  $("#op4_<?php echo $d?>").hide();
    					  $("#op2html_<?php echo $d?>").hide();
                      }
					   if(idLocalAula<?php echo $d?> == 2){
    				   $("#idEndereco_<?php echo $d?>").val("<?php echo $LocalCI;?>");
                        $("#op1_<?php echo $d?>").hide();  
                        $("#op2_<?php echo $d?>").hide();
                        $("#op3_<?php echo $d?>").show();  
						$("#op2html_<?php echo $d?>").hide();
                    }  					  
                        if(idLocalAula<?php echo $d?> == 3){
                        $("#op1_<?php echo $d?>").hide();  
                        $("#op2_<?php echo $d?>").hide();
                        $("#op3_<?php echo $d?>").hide(); 
						$("#op4_<?php echo $d?>").show();
						$("#op2html_<?php echo $d?>").hide();						
                    }   
					 	if(idLocalAula<?php echo $d?> == 5){
						$("#idEndereco_<?php echo $d?>").val("<?php echo $PorTelefone;?>");
                        $("#op1_<?php echo $d?>").hide();  
                        $("#op2_<?php echo $d?>").hide();
                        $("#op3_<?php echo $d?>").hide();
                        $("#op4_<?php echo $d?>").hide();
						$("#op2html_<?php echo $d?>").hide();
						
                    }     
					                     
                        if(idLocalAula<?php echo $d?> == 6){
						$("#idEndereco_<?php echo $d?>").val("<?php echo $PorSkype;?>");	
                        $("#op1_<?php echo $d?>").hide();
                        $("#op3_<?php echo $d?>").hide();
                        $("#op2_<?php echo $d?>").hide();
                        $("#op4_<?php echo $d?>").hide();
						$("#op2html_<?php echo $d?>").hide();
                    } 
					    if(idLocalAula<?php echo $d?> == 8){
						$("#idEndereco_<?php echo $d?>").val("");
                        $("#op1_<?php echo $d?>").hide();  
                        $("#op2_<?php echo $d?>").show();
                        $("#op3_<?php echo $d?>").hide();
                        $("#op4_<?php echo $d?>").hide();  
						$("#op2html_<?php echo $d?>").hide();
                    }  
                      
                }
            $('#idLocalAula<?php echo $d?>').attr('onChange','mudarCampo<?php echo $d?>()');
            mudarCampo<?php echo $d?>();
	         </script>
        <?php }?>    	
    
        <div class="linha-inteira">
          <p>
 			
            <button class="button blue" onclick="postForm('form_opcaoDiaPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/opcaoDiaPlanoAcao.php');">Salvar</button>            
          </p>
        </div>
        
	</form>
  
  <?php }elseif( $tipo == "T" || $tipo == "E" ){?>
  	
    <fieldset>
		<legend>Opções para simular os dias</legend>
        <form id="form_escolherTipoSimulacao" class="validate" action="" method="post" onsubmit="return false" >
            
            <input type="hidden" name="acao" id="acao" value="escolherTipoSimulacao" />
            <input type="hidden" name="idPlanoAcao" id="idPlanoAcao" value="<?php echo $idPlanoAcao?>" />
            <input type="hidden" name="idValorSimuladoPlanoAcao" id="idValorSimuladoPlanoAcao" value="<?php echo $idValorSimuladoPlanoAcao?>" />
            <input type="hidden" name="horasPorAula" id="horasPorAula" value="<?php echo $horasPorAula?>" />
            
            <p>
            <label for="tipoSimulacao1">
            <input type="radio" name="tipoSimulacao" id="tipoSimulacao1" value="1" 
            onchange="escolherTipoSimulacao()" />
            Frequencia semanal</label>
            
            <label for="tipoSimulacao2">
            <input type="radio" name="tipoSimulacao" id="tipoSimulacao2" value="2" 
            onchange="escolherTipoSimulacao()" />
            Data por data</label>
            </p>             
        </form>        
        <div id="res"></div>        
    </fieldset>
    
  <?php }?>
 
</div>
<script>

function escolherTipoSimulacao(){	
	postForm('form_escolherTipoSimulacao', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/opcaoDiaPlanoAcao.php"?>', '', '#res');	
}

function gravarTipoSimulacao_frequenciaSemanal(){
	postForm('form_opcaoDiaPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/opcaoDiaPlanoAcao.php?acao=gravarTipoSimulacao_frequenciaSemanal');	
}

function gravarTipoSimulacao_dataPorData(){
	postForm('form_opcaoDiaPlanoAcao', '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/opcaoDiaPlanoAcao.php?acao=gravarTipoSimulacao_dataPorData');	
}

$('.mudarNome').each(function(){
	var id = $(this).attr('id');
	var ordem = $(this).attr('ordem')
	var novoNome = id+'_'+ordem;
	$(this).attr('name', novoNome);
});

ativarForm();
</script> 
