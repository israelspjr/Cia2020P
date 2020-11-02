<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$Relatorio = new Relatorio();

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."acompanhamento/include/acao/acompanhamento.php"?>')"> Exportar relatório</button>
     <a href="<?php echo CAMINHO_RELAT."acompanhamento/include/acao/acompanhamentoPdf.php?ano_ini=".$ano_ini."&mes_ini=".$mes_ini."&ano_fim=".$ano_fim."&mes_fim=".$mes_fim."&idProfessor=".$idProfessor."&idGrupo=".$idGrupo."&idGerentes=".$idGerentes."&idClientePj=".$idClientePj."&status=".$status."&mostrarTudo=".$mostrarTudo."&idIntegranteGrupo=".$idIntegranteGrupo."&frequencia=".$frequencia;?>" target="_blank"><button class="button gray" > Exportar para PDF</button></a>
</div>

<?php
echo $Relatorio->relatorioAcompanhamento($where, "", "",$mes_ini, $ano_ini, $mes_fim, $ano_fim,1, $unicoAluno,$trazerfrequencia, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
