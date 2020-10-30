<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idDiaAulaFF = $_REQUEST['idDiaAulaFF'];
$DiaAulaFF = new DiaAulaFF();
$BancoHoras = new BancoHoras();
$Ocorrencia = new OcorrenciaFF();
$acao = "cadastrar";
if($idDiaAulaFF){        
    $valorDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE idDiaAulaFF = ".$idDiaAulaFF);
    $bh = $BancoHoras->selectBancoHoras("WHERE diaAulaFF_idDiaAulaFF = ".$idDiaAulaFF); 
    $data = $valorDiaAulaFF[0]['dataAula']; 
    $horaRealizada = $valorDiaAulaFF[0]['horaRealizada']; 
    $idFolhaFrequencia = $valorDiaAulaFF[0]['folhaFrequencia_idFolhaFrequencia'];
    $idOcorrencia = $valorDiaAulaFF[0]['ocorrenciaFF_idOcorrenciaFF']; 
    $acao = "alterar";     
    $horaRealizada = Uteis::exibirHorasInput($horaRealizada); 
	$obs = $valorDiaAulaFF[0]['obs']; 
	
    $tipoHora = strlen($horaRealizada) == 6 ? "checked" : "";     
}
 /*  
    if($data==""):
        $data = new DateTime();
        $dataF = explode("-", $data->format('Y-m-d'));
        $diaRef = $dataF[2]; 
        $mesRef = $dataF[1]; 
        $anoRef = $dataF[0];
    else: 
        $dataF = explode("-", $data->format('Y-m-d'));
        $diaRef = $dataF[2]; 
        $mesRef = $dataF[1]; 
        $anoRef = $dataF[0];           
    endif; 
   */ 
    
?>
<div class="conteudo_nivel">
    <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    <fieldset>
        <legend>
          Creditando Horas ao Banco
        </legend>
        <form id="form_BancoHoras_credito" class="validate" action="" method="post" onsubmit="return false" >
            <input type="hidden" name="idFolhaFrequencia" id="idFolhaFrequencia" value="<?php echo $idFolhaFrequencia?>"/>          
            <input type="hidden" name="idDiaAulaFF" id="idDiaAulaFF" value="<?php echo $idDiaAulaFF?>"/>
            <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>"/>
            <input type="hidden" name="idBanco" id="idBanco" value="<?php echo $bh[0]["idBancoHoras"]?>"/>
            <input type="hidden" name="ano" id="ano" value="<?php echo $anoRef?>"/>
            <input type="hidden" name="acao" id="acao" value="<?php echo $acao?>"/> 
                <p>
                <label>Horas a compensar: <input type="radio" id="credeb" name="credeb" value="0" <?php if($idOcorrencia!=7)  {echo "checked";} ?> /></label> 
                <label>Horas realizadas a mais :<input type="radio" id="credeb" name="credeb" value = "1" <?php if($idOcorrencia==7) echo "checked";?>></label> 
        <!--        
                <p <?php if($idDiaAulaFF!=""){echo "style='display:none;'";}?>>
                <label>Mês:</label>
                <select name="mes" id="mes" class="" onChange="montarDias();" >
                  <option value="">Selecione</option>
                  <option value="1" <?php if($mesRef==1) echo "selected"?>>Janeiro</option>
                  <option value="2" <?php if($mesRef==2) echo "selected"?>>Fevereiro</option>
                  <option value="3" <?php if($mesRef==3) echo "selected"?>>Março</option>
                  <option value="4" <?php if($mesRef==4) echo "selected"?>>Abril</option>
                  <option value="5" <?php if($mesRef==5) echo "selected"?>>Maio</option>
                  <option value="6" <?php if($mesRef==6) echo "selected"?>>Junho</option>
                  <option value="7" <?php if($mesRef==7) echo "selected"?>>Julho</option>
                  <option value="8" <?php if($mesRef==8) echo "selected"?>>Agosto</option>
                  <option value="9" <?php if($mesRef==9) echo "selected"?>>Setembro</option>
                  <option value="10" <?php if($mesRef==10) echo "selected"?>>Outubro</option>
                  <option value="11" <?php if($mesRef==11) echo "selected"?>>Novembro</option>
                  <option value="12" <?php if($mesRef==12) echo "selected"?>>Dezembro</option>              
                </select>
                <span class="placeholder">Campo Obrigatório</span>
                </p>                
                
                <p <?php if($idDiaAulaFF!=""){echo "style='display:none'";}?>>
                <label>Dia:</label>
                <select name="dia" id="dia" class="" onChange="expira();">
                  <option value="">Selecione</option>                  
                </select>
                <span class="placeholder">Campo Obrigatório</span> 
                </p> 
                
               <p <?php if($idDiaAulaFF==""){echo "style='display:none'";}?>>
                <label>Data de Inserção:</label>
                    <strong><?php //echo $data->format("d/m/Y");?></strong>
                    <input type="hidden" id="dataInteira" name="dataInteira" value="<?php //echo $data->format("Y-m-d");?>" />               
               </p>-->
               
                 <p>
        <label>Data: </label>
        <input type="text" name="dataCadastro" id="dataCadastro" value="<?php echo Uteis::exibirData($data) ?>" class="data required" />
        <span class="placeholder">Campo obrigatório</span> </p>
      <p>
               
               <p>
                <label>Ocorrência:</label>
                  <?php
                    echo $Ocorrencia->selectOcorrenciaFFSelect("",$idOcorrencia);
                  ?>       
               </p> 
                <label>Data de Expiração:</label>
                <input type="text" name="dataExpiracao" id="dataExpiracao" class="data" value="<?php echo Uteis::exibirData($bh[0]['dataExpira'])?>" />
                </p>
           <p>          
        
          <label>Horas do programa:</label>
          
          <label><input type="checkbox" value="1" name="mudarClassHora" id="mudarClassHora" onchange="mudarClass()" <?php echo $tipoHora?>/>usar horas maiores (ou iguais) a 100:00</label>
          <input type="text" name="horasPrograma_1" id="horasPrograma_1" class="required hora" value="<?php echo $horaRealizada?>" />          
          <input type="text" name="horasPrograma_2" id="horasPrograma_2" class="required hora2" value="<?php echo $horaRealizada?>" />
          <input type="hidden" name="horasPrograma" id="horasPrograma" value="" />
          
          <span class="placeholder">Campo obrigatório</span> </p>
            <p>
                <label>Obs:</label>
               <textarea name="obs" id="obs" ><?php echo $obs;?></textarea>
           </p>
            <p>
                <button class="button blue" onclick="postTemp();">Salvar</button>
            </p>
        </form>
    </fieldset>
 </div>
<script>
function mudarClass(){
    if( $('#mudarClassHora').is(':checked') ){              
        $('#horasPrograma_1').hide().val('').removeClass('required');
        $('#horasPrograma_2').show().addClass('required');
    }else{
        $('#horasPrograma_2').hide().val('').removeClass('required');
        $('#horasPrograma_1').show().addClass('required');
    }       
}
mudarClass();

function postTemp(){
    mudarClass();
    if( $('#horasPrograma_1').val() != '' ){
        $('#horasPrograma').val( $('#horasPrograma_1').val() )
    }else{
        $('#horasPrograma').val( $('#horasPrograma_2').val() )
    }
    postForm('form_BancoHoras_credito', '<?php echo CAMINHO_REL."grupo/include/acao/bancoHoras_lancamentos.php"?>');
}

function montarDias(){
    var mes = $("#mes option:selected").val();
    var ano = '<?php echo $anoRef;?>';
    var dia = '<?php echo $diaRef;?>'
    if(mes != ""){          
        retorno = $.ajax({
        url:"<?php echo CAMINHO_REL."grupo/retornaDias.php";?>",
        type:"POST",
        datatype: "html",
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        data:{mes:mes, ano:ano, dia:dia}
         });
    
        retorno.done(function( html ) {
            $( "#dia" ).append( html );
        });
    } 
}

function expira(){
   var ver = '<?php echo $diaRef;?>';
   var dia = $("#dia option:selected").val();
   var mes = parseInt($("#mes option:selected").val()) + 3;
   var ano = '<?php echo $anoRef;?>'; 
   if( mes > 12){
       ano = parseInt(ano) + 1;
       mes = mes - 12;
   }   
      if(mes < 10)
      $("#dataExpiracao").val(dia+"/0"+mes+"/"+ano);
      else
      $("#dataExpiracao").val(dia+"/"+mes+"/"+ano);
    
}
ativarForm();
</script>
