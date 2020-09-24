<?php
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Professor = new Professor();	
$IdiomaProfessor = new IdiomaProfessor();
//$Database = new Database();

$ids = $IdiomaProfessor->selectIdiomaProfessor(" WHERE professor_idProfessor = ".$_SESSION['idProfessor_SS']);

for ($x=0;$x<count($ids);$x++) {
	$idIdioma[] = $ids[$x]['idioma_idIdioma'];
}
$idIdioma = implode(', ',$idIdioma);
/*
$sql .= "SELECT A.link, A.nomeArquivo, A.categoria_idCategoria, S.valor from arquivos AS A
INNER JOIN segmento as S on S.idSegmento = A.categoria_idCategoria 
WHERE A.bc = 1 ORDER BY A.categoria_idCategoria, A.idArquivos  DESC";
$result = $this-> query($sql);

$resultado = array();

while ($row = mysqli_fetch_assoc($result)) {
//	$resultado[$row['valor']]['nome'][] = $row['nomeArquivo'];
	$resultado[$row['valor']]['nome'][$row['nomeArquivo']]['link']= $row['link'];

}

foreach ($resultado AS $key => $value) {
	
	$html .= "<div> <div style=\"text-align:center;font-weight:bolder;    background-color: #30a5ff;
    color: white;
    font-size: 27px;
    text-transform: uppercase;
    border-radius: 10px;
    margin-bottom: 13px;cursor: pointer;\" onclick=mostrar(".$x.")>".$key."<br></div>";
	//echo count($value);
	
	$html .= "<div id=\"mostrar".$x."\" style=\"display:none\">";
	
	$x++;
	
	foreach ($value AS $key2 => $valor) {
			
		foreach ($valor AS $key => $val) {

			$html .= "<div style=\"text-align:left;font-weight:normal;    border-bottom: 1px solid;\"  title='Clique sobre o nome para acessar o conteúdo'><a href=\"".$val['link']."\" target=\"_blank\" >". $key."</a></div>";	

		}
	}
	
	$html .= "</div></div></div><hr>";
	
}

*/
?>

<fieldset>
	<legend>Banco de Conhecimento.</legend>
     <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Comunicação" 
  onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/bc/comunica.php', '#centro');"; /> </div>
    <p>
    Olá, professor! Todos os anos oferecemos vários workshops e treinamentos para a nossa equipe e nem todos conseguem participar ou anotar tudo o que discutimos. Aqui você encontrará os arquivos de workshops passados, para que encontre muitas dicas de como enriquecer ainda mais as suas aulas.
    </p>
    <div class="col-md-8">
				<div class="panel panel-default">
		<!--			<div class="panel-heading"></div>-->
<div class="panel-body">
<table id="tb_lista_arquivos" class="registros" data-toggle="table" data-row-style="rowStyle">
  <tbody>
    <?php 
	echo $html;
	?>
  </tbody>
 
</table>
</div>
</div>
</div>
</fieldset>
</div>
<script>
function mostrar(x) {

$('#mostrar'+x).show();	
	
}
</script>


<!--<script>tabelaDataTable('tb_lista_arquivos');</script> -->