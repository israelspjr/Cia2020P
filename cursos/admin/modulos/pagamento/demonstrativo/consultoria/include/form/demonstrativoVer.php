<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");


$DemonstrativoPagamento = new DemonstrativoPagamento();

$idDemonstrativoPagamento = $_REQUEST['id'];
?>

<div id="dadosDemonstrativo"  class="conteudo_nivel">
    <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    <fieldset>
        <legend>
            Demonstrativo Pagamento Outros Serviços
        </legend>
        <div class="menu_interno">
            <button class="button gray" onclick="imprimirDiv('#demosntrativo_pagamento', 'Demonstrativo pagamento outros serviços')" >
                Imprimir
            </button>
            <button class="button blue"
            onclick="postForm('', '<?php echo CAMINHO_PAG."demonstrativo/consultoria/include/acao/envioEmail.php"?>', '<?php echo "id=$idDemonstrativoPagamento"?>');" >
                Enviar por e-mail
            </button>
        </div>
        <div class="lista">
            <div class="">
                <div id="demosntrativo_pagamento" class="linha-inteira">
                    <img src="<?php echo CAMINHO_IMG."_logo.png"?>" />
                    <?php 
                    $tipodemo = 2;
                    echo $DemonstrativoPagamento -> selectDemonstrativoPagamento_imprimir($idDemonstrativoPagamento, $tipodemo); 
                    ?>
                </div>
            </div>
        </div>
    </fieldset>
</div>

<script>
        tabelaDataTable('tb_dem_aulas', 'simples');
        tabelaDataTable('tb_dem_credDeb', 'simples');
		tabelaDataTable('tb_dem_outrosservicos', 'simples');
        tabelaDataTable('tb_dem_imposto', 'simples');
</script>

<script>ativarForm();</script>