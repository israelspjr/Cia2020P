<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ValorHoraGrupo.class.php");	
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Modalidade.class.php");	


$Modalidade= new Modalidade();
$ValorHoraGrupo = new ValorHoraGrupo();

$idValorHoraGrupo = $_REQUEST['id'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
	
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo. "  AND (dataFim <> '')";
	
$rsValorHoraGrupo = $ValorHoraGrupo->selectValorHoraGrupo($where);


?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <div id="sub_exib_curso" class="esquerda">
	
	<?php 
	if(count($rsValorHoraGrupo) > 0){
	foreach($rsValorHoraGrupo as $valor){
	
	$modalidadeIdModalidade = $valor['modalidade_idModalidade']; // select
	$valorHora = Uteis::formatarMoeda($valor['valorHora']); // dinheiro
	$cargaHorariaFixaMensal = Uteis::exibirHorasInput($valor['cargaHorariaFixaMensal']);// horas
	$valorDescontoHora = Uteis::formatarMoeda($valor['valorDescontoHora']); // dinheiro
	$validadeDesconto = Uteis::exibirData($valor['validadeDesconto']); // data
	$previsaoReajuste = Uteis::exibirData($valor['previsaoReajuste']); // data ou dataInicio + 1 ano
	
	$dataInicio = Uteis::exibirData($valor['dataInicio']);
	$dataFim = Uteis::exibirData($valor['dataFim']);
	
		if($modalidadeIdModalidade!=""){
			$rsModalidade = $Modalidade->selectModalidade("WHERE idModalidade=".$modalidadeIdModalidade. " LIMIT 1");
			echo "<p style=\"margin-left:30px;\"><strong>Modalidade: </strong>".$rsModalidade[0]['nome']."<br>";
		}
		
		if($valorHora!=""){
			echo "<strong>Valor Hora: </strong>".$valorHora."<br>";
		}
		
		if($cargaHorariaFixaMensal!=""){
			echo "<strong>Carga Horaria Fixa Mensal: </strong>".$cargaHorariaFixaMensal."<br>";
		}
		
		if($valorDescontoHora!=""){
			echo "<strong>Valor Desconto Hora: </strong>".$valorDescontoHora."<br>";
		}
		if($validadeDesconto!=""){
			echo "<strong>Validade Desconto: </strong>".$validadeDesconto."<br>";
		}
		if($previsaoReajuste!=""){
			echo "<strong>Previsão Reajuste: </strong>".$previsaoReajuste."<br>";
		}
		
		
		
		if($dataInicio!=""){
			echo "<strong>Data Início: </strong>".$dataInicio."<br>";
		}
		
		if($dataFim!=""){
			echo "<strong>Data Fim: </strong>".$dataFim."<br>";
		}

		echo "<hr>";
	}
	}else{
		echo "<p><strong>Não possui histórico.</strong></p>";
	}
	?>
 </div>
</div>
<script>
ativarForm();
</script> 
