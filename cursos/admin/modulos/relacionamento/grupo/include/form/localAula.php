<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();

$LocalAula = new LocalAula();
$Endereco = new Endereco();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$idAulaPermanenteGrupo = $_REQUEST['idAulaPermanenteGrupo'];
$idAulaDataFixa = $_REQUEST['idAulaDataFixa'];
$idPlanoAcaoGrupo =  $_REQUEST['idPlanoAcaoGrupo'];

if ($idAulaDataFixa > 0) {
	$rs = $AulaDataFixa->selectAulaDataFixa(" AND idAulaDataFixa = ".$idAulaDataFixa);	
	$localAula_idLocalAula = $rs[0]['localAula_idLocalAula'];
}

if ($idAulaPermanenteGrupo > 0) {
	$rs = $AulaPermanenteGrupo->selectAulaPermanenteGrupo(" WHERE idAulaPermanenteGrupo = ".$idAulaPermanenteGrupo);	
	$localAula_idLocalAula = $rs[0]['localAula_idLocalAula'];
}

?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Atualizar Local da Aula</legend>
    <form id="form_Atualizar_local" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" id="idAulaPermanenteGrupo" name="idAulaPermanenteGrupo" value="<?php echo $idAulaPermanenteGrupo;?>">
      <input type="hidden" id="idAulaDataFixa" name="idAulaDataFixa" value="<?php echo $idAulaDataFixa;?>">
      <input type="hidden" id="idPlanoAcaoGrupo" name="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo;?>">
      <div class="esquerda">
        <p>
          <label>Local alternativo de aula:<?php echo $iPlanoAcaoGrupo;?></label>           
                    <?php echo $LocalAula->selectLocalAulaSelect("", $localAula_idLocalAula);?> 
          <span class="placeholder">Campo obrigatório</span></p>
        <p id="op1"> 
           <label >Endereço:</label>
           <?php echo $Endereco->selectEnderecoSelect_PlanoAcaoAluno("", $idEndereco, $idPlanoAcaoGrupo);?> 
        </p>
        <p id="op2">
          <label>Endereço(Endereço, número):</label> 
          
           <?php 
//		   $idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
		    echo $Endereco->selectEnderecoSelectPlanoAcaoGrupoEmp("", $idEndereco, $idPlanoAcaoGrupo);?>  
        </p>
         <p id="op3">
          <label>Companhia de Idiomas:</label><br />
           <b><?php echo ENDERECO;?></b> 
        </p>
        <p id="op4">
          <label>Insira o Endereço:(rua, numero, cep, complemento)</label><br />
           <input type="text" name="endereco_novo" id="endereco_novo" value = "" size="50"/> 
        </p>
      </div>
      <div class="linha-inteira">  
      <p>
        <button class="button blue" onclick="postForm('form_Atualizar_local', '<?php echo CAMINHO_REL."grupo/include/acao/localAula.php"?>');">Salvar</button>        
      </p>
    </form>
    </div>
  </fieldset>
</div>
<script>
function mudarCampo(){
      var idLocalAula = $("#idLocalAula option:selected").val();
                     if(idLocalAula =="" || idLocalAula == 1 ){
                      $("#op3").hide();  
                      $("#op2").hide();
                      $("#op1").show();
					  $("#op4").hide();
                      }
                        if(idLocalAula == 3){
                        $("#op1").hide();  
                        $("#op2").show();
                        $("#op3").hide();
                        $("#op4").hide();  
                    }  
						if(idLocalAula == 2){
                        $("#op1").hide();  
                        $("#op2").hide();
                        $("#op3").show();  
						$("#op4").hide();  
                    }  
                        if(idLocalAula == 7 || idLocalAula == 6 || idLocalAula == 5){
                        $("#op1").hide();
                        $("#op3").hide();
                        $("#op2").hide();
						$("#op4").hide();  
                    } 
					    if(idLocalAula == 8){
                        $("#op1").hide();  
                        $("#op2").hide();
                        $("#op3").hide();  
						$("#op4").show();  
                    }  
                      
                }
            $('#idLocalAula').attr('onchange','mudarCampo()');
            mudarCampo();
ativarForm();
</script> 
</div>
</div>