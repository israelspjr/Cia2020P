<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new RelatorioNovo();

require_once "../acao/filtros.php";?>

<div class="esquerda">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."reversaoPsa/include/acao/reversaoPsa.php"?>')"> Exportar relatório</button>
</div>
<?php

echo $Relatorio->relatorioReversaoPsa($where, false, $dataIni, $dataFim, $tipoR, $campos, $camposNome);
?>

<script> 
function desistir(x,y) {
jQuery.ajax({
	type: "POST",
	url: "<?php echo CAMINHO_RELAT."reversaoPsa/include/acao/reversaoPsa.php"?>",
	data: {"idIntegranteGrupo": x,"acao":"desativarPsa"},
	success: function(data){
		jQuery("#desistiu_"+x+y).html(data);
	}
});
	
}


tabelaDataTable('tb_lista_res', 'simples');
</script> 
