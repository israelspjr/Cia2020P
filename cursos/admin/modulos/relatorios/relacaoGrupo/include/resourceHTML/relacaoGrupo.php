<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$Relatorio = new Relatorio();

/*$caminhoAbrir = CAMINHO_REL."grupo/cadastro.php";
$caminhoAtualizar = "click";
$onde = "#geraRel"; */

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."fechamentoGrupo/include/acao/fechamentoGrupo.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $Relatorio->relatorioFechamentoGrupo($where, "");
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
