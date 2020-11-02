<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";
?>

<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_rel', '<?php echo CAMINHO_RELAT."professor/include/acao/professor.php"?>')"> Exportar relatório</button>
</div>
<?php
echo $Relatorio->relatorioProfessor($where, $campos, $camposNome, "", $idProfessor);
?>

<script> 
tabelaDataTable('tb_lista_res', '');
</script> 
