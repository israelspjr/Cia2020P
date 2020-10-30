<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$VariedadeRecurso = new VariedadeRecurso();
$AcompanhamentoCurso = new AcompanhamentoCurso();

if( !isset($idAcompanhamentoCurso) ) $idAcompanhamentoCurso = $_REQUEST['idAcompanhamentoCurso'];
$mostrarAcoes = $AcompanhamentoCurso->verificaPodeEditar($idAcompanhamentoCurso);

?>
<table id="tb_lista_VariedadeRecurso" class="registros">
  <thead>
    <tr>
      <th>Título</th>
      <th>Data</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $VariedadeRecurso->selectVariedadeRecursoTr($mostrarAcoes, CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/resourceHTML/variedadeRecurso.php?idAcompanhamentoCurso=".$idAcompanhamentoCurso, "#div_lista_variedadeRecurso", "WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso);
	?>
  </tbody>
  <tfoot>
    <tr>
      <th>Título</th>
      <th>Data</th>
      <th></th>
    </tr>
  </tfoot>
</table>
<script>
tabelaDataTable('tb_lista_VariedadeRecurso', 'simples');
</script> 
