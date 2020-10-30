<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RevisaoVPG = new RevisaoVPG();
$AcompanhamentoCurso = new AcompanhamentoCurso();

if( !isset($idAcompanhamentoCurso) ) $idAcompanhamentoCurso = $_REQUEST['idAcompanhamentoCurso'];
$mostrarAcoes = $AcompanhamentoCurso->verificaPodeEditar($idAcompanhamentoCurso);
?>
<table id="tb_lista_RevisaoVPG" class="registros">
  <thead>
    <tr>
       <th>Data</th>
       <th>Anexo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $RevisaoVPG->selectRevisaoVPGTr($mostrarAcoes, CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/resourceHTML/revisaoVPG.php?idAcompanhamentoCurso=".$idAcompanhamentoCurso, "#div_lista_RevisaoVPG", "WHERE acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso);
	?>
  </tbody>
  <tfoot>
    <tr>
       <th>Data</th>
       <th>Anexo</th>
      <th></th>
    </tr>
  </tfoot>
</table>
<script>
tabelaDataTable('tb_lista_RevisaoVPG', 'simples');

</script> 
