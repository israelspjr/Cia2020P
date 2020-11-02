<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();


 //FILTROS
$where = "WHERE 1 ";

$tipo = $_POST['tipo'];

$tipoAluno = $_POST['tipoAluno'];

$tipoC = $_POST['tipoC'];
if ($tipoC != '-') {
	$where .= " AND P.candidato = ".$tipoC;	
}

if ($tipoAluno != '-') {
	$where .= " AND P.inativo = ".$tipoAluno;	
}

$tipoProfessor = $_POST['tipoP'];

if ($tipoProfessor != '-') {
	if ($tipoProfessor == 2) {
		$where .= " AND P.inativo = 0";	
		$tipo = 3;
	} elseif ($tipoProfessor == 1) {
		$where .= " AND P.inativo = 0";
			
	}
	
} else {
	$where .= " AND P.inativo = 0";	
	
}



$valorGerente =  implode(",",$_POST['idGerente']); 
if ($valorGerente != '-') {
	$idGerente2 = $valorGerente;
}



$dataCadastro = $_POST['dataCadastro'];
$dataCadastro2 = $_POST['dataCadastro2'];

$dataI = explode("/", $dataCadastro);

$dataF = explode("/", $dataCadastro2);


if($dataCadastro && $dataCadastro2) {
	$mes1 = Uteis::gravarData($dataCadastro);
	$mes2 = Uteis::gravarData($dataCadastro2);
	
//	$where .= " AND (DAYOFMONTH(dataNascimento) >= ".$dataI[0].") AND (DAYOFMONTH(dataNascimento) <= ".$dataF[0].")
//         AND (MONTH(dataNascimento) >= ".$dataI[1].") AND (MONTH(dataNascimento) <= ".$dataF[1].")";
	$where .= " AND date_format(P.dataNascimento, '%m-%d') IS NOT NULL
    AND (date_format(P.dataNascimento, '%m-%d') between '".$dataI[1]."-".$dataI[0]."' AND '".$dataF[1]."-".$dataF[0]."')";
}


//echo $where;
?>
<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_filtra_Grupos', '<?php echo CAMINHO_RELAT."aniversarios/excel.php"?>')"> Exportar relatório</button>
</div>

<div class="lista">

      <?php echo $RelatorioNovo->relatorioAniversariantesTr($where,$tipo,$idGerente2);?>
 
</div>

<script>
tabelaDataTable('tb_lista_res1', 'ordenaColuna');
eventDestacar(1);
</script> 
