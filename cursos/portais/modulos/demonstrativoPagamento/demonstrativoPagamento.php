<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DemonstrativoPagamento = new DemonstrativoPagamento();

$idDemonstrativoPagamento = $_REQUEST['idDemonstrativoPagamento'];

$rs = $DemonstrativoPagamento->selectDemonstrativoPagamento("where idDemonstrativoPagamento = ".$idDemonstrativoPagamento);

$tipoDemo = $rs[0]['tipoDemo'];
?>

<!--<div id="dadosDemonstrativo"  class="conteudo_nivel">
    <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    --><fieldset>
        <legend>
            Demonstrativo
        </legend>
        <div class="menu_interno">
            <button class="button gray" onclick="imprimirDiv('#demosntrativo_pagamento', 'Demonstrativo do professor')" >
                Imprimir
            </button>
            <button class="button blue" onclick="contestar();" >
           
                Enviar e-mail de Contestação.
            </button>
             <div id="contestar" name="contestar" style="display:none;" method="get">
             <p>
             <div><strong>Insira sua Reclamação:</strong></div>
             </p>
             <form name="contestando" id="contestando" action="" onsubmit="return false">
            <textarea id="contesta" name="contesta" rows="5" cols="45">
            </textarea>
            <input type="hidden" id="idp" name="idp" value="<?php echo "$idDemonstrativoPagamento"?>" />
            <p><div>
            <button type="submit" class="button" id="enviou" name="enviou" onclick="enviar()">
            
            Enviar
            </button>
            </div>
            </form>
            </p>
            </div>
       
        </div>
        <div class="lista">
            <div class="">
                <div id="demosntrativo_pagamento" class="linha-inteira">
                            <?php echo $DemonstrativoPagamento -> selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento, $tipoDemo); 
                    ?>
                </div>
            </div>
        </div>
    </fieldset>
</div>

<script>
//		tabelaDataTable('tb_dem_outrosservicos', 'simples');
 //       tabelaDataTable('tb_dem_aulas', 'simples');
  //      tabelaDataTable('tb_dem_credDeb', 'simples');
  //      tabelaDataTable('tb_dem_imposto', 'simples');
//		ativarForm();

function contestar() {
	document.getElementById("contestar").style = "block";	
	
}
	
$('#enviou').attr('onclick', 'enviar()');	

//function aviso() {
//	alert("Email enviado com sucesso");
//}

function enviar() {
	postForm("contestando", "modulos/demonstrativoPagamento/disparoEmail.php");	
	
}

</script>