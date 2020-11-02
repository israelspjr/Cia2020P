<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");


$DemonstrativoPagamento = new DemonstrativoPagamento();

$idDemonstrativoPagamento = $_REQUEST['id'];

$obs = $DemonstrativoPagamento->getObs($idDemonstrativoPagamento);
//echo $obs;

?>

<div id="dadosDemonstrativo"  class="conteudo_nivel">
    <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    <fieldset>
        <legend>
            Demonstrativo
        </legend>
        <div class="menu_interno">
            <button class="button gray" onclick="imprimirDiv('#demosntrativo_pagamento', 'Demonstrativo do professor')" >
                Imprimir
            </button>
            <button class="button blue"
            onclick="postForm('', '<?php echo CAMINHO_PAG."demonstrativo/include/acao/envioEmail.php"?>', '<?php echo "id=$idDemonstrativoPagamento"?>');" >
                Enviar por e-mail
            </button>
        </div>
        <div class="lista">
            <div class="">
                <div id="demosntrativo_pagamento" class="linha-inteira">
                    <img src="<?php echo CAMINHO_IMG."_logo.png"?>" />
                    <?php echo $DemonstrativoPagamento -> selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento); 
                    ?>
                </div>
            </div>
        </div>
    </fieldset>
<div class="linha-inteira" style="    width: 80%;padding-left:29px;">
<form id="form_obs" name="form_obs" method="post" action="" onsubmit="return false">
<label>Observação: </label><br />
<textarea rows="5" cols="50" id="obsP" name="obsP" ><?php echo $obs?></textarea>
 
 <p><div id="salvoOK" name="salvoOK"></div></p>
 <p>
          <button class="button blue" onclick="salvar();" >Salvar</button>
          
        </p>
</form>
</div>

</div>
<script>
        tabelaDataTable('tb_dem_aulas', 'simples');
        tabelaDataTable('tb_dem_credDeb', 'simples');
        tabelaDataTable('tb_dem_imposto', 'simples');
		ativarForm();
		
function salvar() {

var texto = $("#obsP").val();

		retorno = $.ajax({
        url:"<?php echo CAMINHO_PAG . "demonstrativo/include/acao/envioEmail.php";?>",
        type:"POST",
        datatype: "html",
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        data:{"obs":texto, "id":<?php echo $idDemonstrativoPagamento ?>}
         });
    
        retorno.done(function( html ) {
            $( "#salvoOK" ).append( "Observação gravada no banco e demonstrativo enviado com sucesso!!" );
        });	
	
	
}
</script>