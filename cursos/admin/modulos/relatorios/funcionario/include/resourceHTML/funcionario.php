<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";
?>

<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_rel', '<?php echo CAMINHO_RELAT."funcionario/include/acao/funcionario.php"?>')"> Exportar relatório</button>
</div>
<?php
echo $Relatorio->relatorioFuncionario($where, $campos, $camposNome);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
