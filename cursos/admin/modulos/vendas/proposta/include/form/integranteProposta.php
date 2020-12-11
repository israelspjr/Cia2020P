<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/IntegranteProposta.class.php");	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ClientePf.class.php");
		
	$IntegranteProposta = new IntegranteProposta();	
	$ClientePf = new ClientePf();
	$idClientePf = 	$_GET['idClientePf'];
	$idIntegranteProposta = $_GET['id'];
	$proposta_idProposta = $_GET['idProposta'];
	$clientePfIdClientePf = ($idClientePf!="") ? "$idClientePf":"";
 // echo $idClientePf."Aqui";
	//POR PADRÃO COMEÇA EM ABERTO
	$statusAprovacaoIdStatusAprovacao = "1";
	
	if($idIntegranteProposta != '' && $idIntegranteProposta  > 0){
	
		$valorProposta = $IntegranteProposta->selectIntegranteProposta('WHERE idIntegranteProposta='.$idIntegranteProposta);
		$clientePfIdClientePf = $valorIntegranteProposta[0]['clientePf_idClientePf'];
		$proposta_idProposta = $valorIntegranteProposta[0]['proposta_idProposta'];
		$statusAprovacaoIdStatusAprovacao = $valorIntegranteProposta[0]['statusAprovacao_idStatusAprovacao'];
		$linkVisualizacao = $valorIntegranteProposta[0]['linkVisualizacao'];
	}
  $atualizar = $_REQUEST['atualizar'];
  if($atualizar==1){
  	echo "<script>integrantes();</script>";
  }
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Integrantes da proposta</legend>
    
      <form id="form_IntegranteProposta" class="validate" action="" method="post" onsubmit="return false" >
        <input type="hidden" name="statusAprovacaoIdStatusAprovacao" id="statusAprovacaoIdStatusAprovacao" value="<?php echo $statusAprovacaoIdStatusAprovacao ?>" />
        <input type="hidden" name="proposta_idProposta" id="proposta_idProposta" value="<?php echo $proposta_idProposta ?>" />
        <p>
          <label>Cliente PF :</label>
           
          <select id="idClientePf" name="idClientePf"></select>
<?php
		  /*	$and = " 
			AND COALESCE(clientePj_idClientePj,0) IN ( 
				SELECT COALESCE(clientePj_idClientePj,0) FROM proposta WHERE idProposta =".$proposta_idProposta.
			") 
			AND idClientePf NOT IN ( 
				SELECT clientePf_idClientePf FROM integranteProposta WHERE proposta_idProposta =".$proposta_idProposta.
			")";
		   echo $ClientePf->selectClientePfSelect("required", $clientePfIdClientePf, $and);
		   */
		 ?>
        </p>
        <!--<p>
          <label>Link para visualização da proposta:</label>
          <input type="text" readonly="readonly" title="NÃO É POSSÍVEL EDITAR, APENAS LEITURA" value="<?php echo $linkVisualizacao?>" />
        </p>-->
        <div class="linha-inteira">
          <p>
            <button class="button blue" onclick="postForm('form_IntegranteProposta', '<?php echo CAMINHO_VENDAS?>proposta/include/acao/integranteProposta.php?id=<?php echo $idIntegranteProposta?>&idProposta=<?php echo $proposta_idProposta?>');">Salvar</button>
            
          </p>
        </div>
      </form>

  </fieldset>
</div>
<script>
$('#idClientePf').on('change', function() {
  if($(this).val()=="novo"){
   abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePf/cadastro.php?p=$proposta_idProposta";?>', '<?php echo CAMINHO_VENDAS."proposta/include/form/integranteProposta.php?id=$proposta_idProposta&atualizar=1";?>', '#bt');
  }
});
function integrantes(){
	var retorno;
  $( "#idClientePf" ).empty();
  $( "#idClientePf" ).append("<option >Selecione</option>");
  $( "#idClientePf" ).append("<option value='novo'>Novo Registro</option>");
  retorno = $.ajax({
    url:"<?php echo CAMINHO_VENDAS."proposta/select_integrante.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{idProposta:<?=$proposta_idProposta?>}   
  });
  retorno.done(function( html ) {
    $( "#idClientePf" ).append( html );
  });
}
integrantes();
ativarForm();
</script>