<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Professor = new Professor();	
$IdiomaProfessor = new IdiomaProfessor();

$ids = $IdiomaProfessor->selectIdiomaProfessor(" WHERE professor_idProfessor = ".$_SESSION['idUsuario']);

for ($x=0;$x<count($ids);$x++) {
	$idIdioma[] = $ids[$x]['idioma_idIdioma'];
}
$idIdioma = implode(', ',$idIdioma);

$sql .= "SELECT link, nomeArquivo from arquivos WHERE idioma_idIdioma in (".$idIdioma.")";
$rs = Uteis::executarQuery($sql);

for ($x=-0;$x<count($rs);$x++) {

$html .= "<tr title='Clique sobre o nome para fazer o download'><th><a href=".$rs[$x]['link']." target=\"_blank\">".$rs[$x]['nomeArquivo']."</a></th></tr>";	
	
}


?>

<fieldset>
	<legend>Arquivos</legend>

<table id="tb_lista_arquivos" class="registros">
  <thead>
    <tr>
       <th>Nome</th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $html;
	?>
  </tbody>
 
</table>

</fieldset>
</div>
<script>//tabelaDataTable('tb_lista_arquivos','simples');</script> 