<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();
$grafico = new Grafico();
require_once "pesquisa.php";?>
<div class="linha-inteira">
<div class="esquerda">    
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."psaPendentes/psaE.php"?>')"> Exportar relatório</button>
</div>
</div>
<div id="relatorio_psa">

<?php

echo $RelatorioNovo->relatorioPsaPendente($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor);

$final = 1;
?>
</table>
</div>
	<script>
	tabelaDataTable('tb_lista_res','simples')
	</script>
    
