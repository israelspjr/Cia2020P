<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
				
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Grupo_PJ = new GrupoClientePj();
$contato = new ContatoAdicional();
$Contrato = new Contrato();
$ClientePf = new ClientePf();

$idContrato = $_REQUEST['idContrato'];

$TextoEmailPadrao = new TextoEmailPadrao();

$rs = $Contrato->selectContrato(" WHERE idContrato = ".$idContrato);

$nome = $ClientePf->getNome($rs[0]['clientePf_idClientePf']);
$email = $ClientePf->getEmail($rs[0]['clientePf_idClientePf']);

$ano = date("Y", strtotime($rs[0]['dataCadastro']));
$mes = date("m", strtotime($rs[0]['dataCadastro']));

$assunto = "Boleto de cobrança ".$mes."/".$ano." Companhia de Idiomas - não responder a esse email"; 

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Disparo de e-mail</legend>
    <form id="form_disparoEmail" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" value="<?php echo $planoAcao_idPlanoAcao;?>" />
      <input type="hidden" name="mes" value="<?php echo $mes;?>" />
      <input type="hidden" name="ano" value="<?php echo $ano;?>" />
      <div class="esquerda">
        <p>
          <label>Assunto</label>
          <input type="text" name="assunto" id="assunto" value="<?php echo $assunto;?>" class="required" size="120"/>
        </p>
       
        <div class="linha-inteira">
        <p><!--<button class="button blue" name="selecionar" id="selecionar" onclick="marcardesmarcar()">Selecionar todos</button>-->
           <p>          
          <label><strong>Integrantes(s):</strong></label>
          <div>
		  <?php
		  echo $nome;
		   //echo $PlanoAcaoGrupo->selectIntegrantesGrupoCheckBox($planoAcao_idPlanoAcao);?> 
           </div>
        </p>
      </div>

     <div class="linha-inteira" >
        <p>
          <label>Cópia</label>
          <img id="copiaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA" />
          <input type="text" name="copiaAux" id="copiaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA" />
        <select multiple="multiple" name="copia[]" id="copia" >
        </select>
        </p>
     <!--   <p>
          <label>Cópia oculta</label>
          <img id="copiaOcultaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA CÓPIA OCULTA" />
          <input type="text" name="copiaOcultaAux" id="copiaOcultaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaOcultaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA OCULTA" />
        <select multiple="multiple" name="copiaOculta[]" id="copiaOculta"  >
        </select>
        </p>-->
      </div>
      <div class="linha-inteira">           
        <p>
          <button class="button blue" onclick="dispara()">Enviar</button>
          
        </p>
      </div>
    <div class="linha-inteira">
</div> 
          
    </form>
  </fieldset>
</div>
<script src="<?php echo CAMINHO_CFG."js/email.js"?>" type="text/javascript" ></script>
<script>
function dispara(){	
    $('#copia').find('option').attr('selected', true);
    $('#copiaOculta').find('option').attr('selected', true);
	postForm('form_disparoEmail', '<?php echo CAMINHO_CAD."clientePf/include/acao/disparoEmail.php?idContrato=".$idContrato?>');	
}
/*
function marcardesmarcar(){
    $("input[name = 'check_disparoEmail_integranteGrupo[]']").each(
        function() {
            if ($(this).prop("checked")) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
}
*/
ativarForm(); 
</script>