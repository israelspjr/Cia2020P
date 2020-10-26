<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

?>

<fieldset>
  <legend>VPG</legend>
  
  <div style="float:left;width:30%;padding:1em;" >
    <form id="form_V" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="tipo_V" id="tipo_V" value="V" />
      <input type="hidden" name="integrantePlanoAcao_idIntegrantePlanoAcao" id="integrantePlanoAcao_idIntegrantePlanoAcao" value="<?php echo $idIntegrantePlanoAcao ?>" />
      <input type="hidden" name="id_V" id="id_V" value="" />
      <input type="hidden" name="acao_V" id="acao_V" value="" />
      <p>
        <label>Vocabulário:</label>
   <!--     <input type="text" name="valor_V" id="valor_V" class="required" >
        <span class="placeholder">Campo obrigatório</span></p>-->
        <textarea name="valor_V" id="valor_V" rows="10" cols="30">
        </textarea>
      <p>
        <button class="button blue" onclick="gravarVPG('form_V');">Salvar</button>
        
      </p>
    </form>
    
    <div id="listaVpg_V">
    </div>
    
  </div>
    
  <div style="float:left;width:30%;padding:1em;" >
    <form id="form_P" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="integrantePlanoAcao_idIntegrantePlanoAcao" id="integrantePlanoAcao_idIntegrantePlanoAcao" value="<?php echo $idIntegrantePlanoAcao ?>" />
      <input type="hidden" name="tipo_P" id="tipo_P" value="P" />
      <input type="hidden" name="acao_P" id="acao_P" value="" />
      <p>
        <label>Pronúncia:</label>
    <!--    <input type="text" name="valor_P" id="valor_P" class="required" >
        <span class="placeholder">Campo obrigatório</span></p>-->
         <textarea name="valor_P" id="valor_P" rows="10" cols="30">
        </textarea>
      <p>
        <button class="button blue" onclick="gravarVPG('form_P');">Salvar</button>
        
      </p>
    </form>
    
    <div id="listaVpg_P">
    </div>
    
  </div>
  
  <div style="float:left;width:30%;padding:1em;" >
    <form id="form_G" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="integrantePlanoAcao_idIntegrantePlanoAcao" id="integrantePlanoAcao_idIntegrantePlanoAcao" value="<?php echo $idIntegrantePlanoAcao ?>" />
      <input type="hidden" name="tipo_G" id="tipo_G" value="G" />
      <input type="hidden" name="acao_G" id="acao_G" value="" />
      <p>
        <label>Gramática:</label>
  <!--      <input type="text" name="valor_G" id="valor_G" class="required" >
        <span class="placeholder">Campo obrigatório</span></p>-->
         <textarea name="valor_G" id="valor_G" rows="10" cols="30">
        </textarea>
      <p>
        <button class="button blue" onclick="gravarVPG('form_G');">Salvar</button>
        
      </p>
    </form>
    
    <div id="listaVpg_G">
    </div>
    
  </div>
  
</fieldset>
<div id="ver">
    </div>
<script>


function gravarVPG(form){
	postForm(form, '<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/vpgPlanoAcao.php');
}

function carregaVPG(tipo){
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/resourceHTML/vpgPlanoAcao.php', {tipo:tipo, idIntegrantePlanoAcao: '<?php echo $idIntegrantePlanoAcao?>'}, function(e){			
		$('#listaVpg_'+tipo).html(e);
	})
	
}
function Editar(val){
	 var dados = {
	 	idvpg:val
	 }
	 $.post('<?php echo CAMINHO_VENDAS."planoAcao/include/form/vpg_consult.php";?>', dados, function(retorno){
	 			var resp = JSON.parse(retorno);	 			
	 			var id = resp["idVpgPlanoAcao"];
	 			var integ = resp["integrantePlanoAcao_idIntegrantePlanoAcao"];
	 			var tipo = resp["tipo"];	 			
	 			var valor = resp["valor"];
	 			
	 			$("#id_"+tipo).val(id);
	 			$("#tipo_"+tipo).val(tipo);
	 			$("#integrantePlanoAcao_idIntegrantePlanoAcao_"+tipo).val(integ);
	 			$("#valor_"+tipo).val(valor);
	 			$("#acao_"+tipo).val("editar");					 			
               });
}
function Excluir(val){
	var idVPG = val;
}
carregaVPG('V');
carregaVPG('P');
carregaVPG('G');

ativarForm();
</script>