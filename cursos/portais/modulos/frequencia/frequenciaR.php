<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();
$ClientePj = new ClientePj();

require_once "filtrosR.php";

$valor = $ClientePj->selectClientePj("where idClientePj = ".$_SESSION['idClientePj_SS']);
$FME = $valor[0]['frequenciaMinimaExigida'];

//echo $where;
?>
<style>
.dataTables_wrapper {
	height:30px;
}

.registros td {
	font-size:12px;	
}
</style>
<div class="esquerda">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo "modulos/frequencia/frequenciaRAcao.php"?>')"> Exportar relatório</button>&nbsp;&nbsp;<!--<a href="<?php echo "modulos/frequencia/frequenciaPdfR.php?idGrupo=".$idGrupo."&tipo=".$tipo."&frequencia=".$frequencia."&tipoR=".$tipoR."&alunoN=".$alunoN."&d1=".$d1k."&d2=".$d2k."";?>" target="_blank"><button class="button gray" > Exportar para PDF</button></a>-->
  <center> <legend>Frequência Mínima Exigida: <?php echo $FME; ?>% </legend> </center>
<p>Frequência em <font color="#FF0000">vermelho</font>: abaixo da média esperada<br />
Frequência em <font color="#0000FF">azul</font>: aluno entrou ou saiu no meio do mês/período<br />
Círculo <img title="Justificativa" src="<?php echo CAMINHO_IMG?>\pendente.png"> amarelo: justificativa de ausência dos alunos</p>

</div>
<?php

echo $Relatorio->relatorioFrequencia($where, $tipo, false, $FME, $frequencia, $tipoR, $dInicial, $dFinal, $alunoN,1);
?>

<script> 
//tabelaDataTable('tb_lista_res');


</script> 
