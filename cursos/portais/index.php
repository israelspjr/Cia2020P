<?php 
$pgUnico = true;
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/js_area.php");
require_once($_SERVER['DOCUMENT_ROOT'] . CAMINHO_CFG . "include/css_area.php");

$FolhaFrequencia = new FolhaFrequencia();
$NewsProfessor = new NewsProfessor();
	
if($_SESSION['logado']==""){
    session_destroy();
}

if ($_SESSION['tipo'] >= 1) {
	$rs = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = ".$idFolhaFrequencia);
	$_SESSION['idPlanoAcaoGrupo'] = $rs[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$_SESSION['idProfessor'] = $rs[0]['professor_idProfessor'];

	$dat = explode("-",$rs[0]['dataReferencia']);

	$ano = $dat[0];
	$mes = $dat[1];
}

/*$valor = $NewsProfessor->selectNewsProfessor(" WHERE portal = 2 AND inativo = 0 AND popup = 1 ".$add. " ORDER BY idNewsProfessor DESC");

foreach ($valor as $value) {
	?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $value['news'] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php 	}   */ ?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../images/_favicon.ico" sizes="32x32">
<title>Portal </title>

<link rel="s/tylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<script src="../config/js/jquery.min.js"></script>
<script src="../config/js/dataTable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../config/js/Chart.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!--Icons-->
<script src="../config/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<?php  //var_dump($_SESSION); 
$appN = $_SESSION['appN'];
//echo $appN;
if ($appN == 1) {
?>
<style>
	body{
		background-image: url("../images/bcgaluno2.jpg");
	}
</style>
<?php	
} elseif ($appN == 2) {
//	$novoCadastro = " <p><a href=\"login.php?app=2&novo=1\"><button class=\"Bblue\">Não tem cadastro? Crie um agora</button></a>";
?>
<style>
	body{
		background-image: url("../images/bcgprof.jpg");
	}
</style>

<?php	
} else {
?>	
<style>
	body{
		background-image: url("../images/bcgrh.jpg");
	}
	@media (min-width:756px) {
		#centro {
			width:890px;
		}
	}
</style>
<?php	
}
?>
<body>
<style>

</style>
<div class="header">
<div>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse" aria-controls="sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="bemvindo" href="index.php" style="width:90%">BEM-VINDO(A)  <br><span><?php echo $_SESSION['nome_SS'] ?></span></a>
                
			</div>
		</div><!-- /.container-fluid -->
	</nav>
</div>	
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php require('menu.php'); ?>
</div><!--/.sidebar-->
		
	<ol class="breadcrumb">
   
		<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Principal</li>
	</ol>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
    	<div class="row">
    	</div>

	<div id="divs_jquery"></div>
    <div id="centro"></div>

</div><!--/.row-->
<?php if ($appN == 4) { ?>
    <script>
	$( document ).ready(function() {
    carregarModulo('/cursos/portais/charts.php', '#centro');
});
</script>

<?php } ?>
</div>	<!--/.main-->

</body>
</html>