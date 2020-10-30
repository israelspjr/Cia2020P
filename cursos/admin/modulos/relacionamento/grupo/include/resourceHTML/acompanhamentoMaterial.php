<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AcompanhamentoMaterial = new AcompanhamentoMaterial();
?>

<table id="tb_lista_acompanhamentoMaterial" class="registros">
  <thead>
    <tr>
       <th>Livro</th>
       <th>Unidade</th>
       <th>Obs</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $AcompanhamentoMaterial->selectAcompanhamentoMaterialTr($mostrarAcoes, CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/resourceHTML/acompanhamentoMaterial.php?idAcompanhamentoCurso=".$idAcompanhamentoCurso, "#div_lista_acompanhamentoMaterial", " WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso);
	?>
  </tbody>
  <tfoot>
    <tr>
       <th>Livro</th>
       <th>Unidade</th>
       <th>Obs</th>
      <th></th>
    </tr>
  </tfoot>
</table>
<script>
tabelaDataTable('tb_lista_acompanhamentoMaterial', 'simples');
</script> 
