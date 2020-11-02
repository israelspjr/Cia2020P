<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();

require_once "../acao/filtros.php";?>

<div class="esquerda">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."frequencia/include/acao/frequencia.php"?>')"> Exportar relatório</button>
    <a href="<?php echo CAMINHO_RELAT."frequencia/include/acao/frequenciaPdf.php?tipoRel=".$tipo."&idGrupos=".$idGrupo."&frequencia=".$frequencia."&tipoR=".$tipoR."&statusG=".$statusG."&alunoN=".$alunoN."&di=".$dataIni."&df=".$dataFim."&d1=".$d1."&d2=".$d2."&idGerente=".$ids."&idClientePj=".$clientePj_idClientePj."&idGrupo=".$grupo_idGrupo."&idClientePf=".$idClientePf."&idIntegranteGrupo=".$idIntegranteGrupo."";?>" target="_blank"><button class="button gray" > Exportar para PDF</button></a>
</div>
<div class="direita">
<p>Frequência em <font color="#FF0000">vermelho</font>: abaixo da média esperada<br />
Frequência em <font color="#0000FF">azul</font>: aluno entrou ou saiu no meio do mês/período<br />
Círculo <img title="Justificativa" src="<?php echo CAMINHO_IMG?>\pendente.png"> amarelo: justificativa de ausência dos alunos</p>

</div>
<?php

echo $Relatorio->relatorioFrequencia($where, $tipo, false, $FME, $frequencia, $tipoR, $dInicial, $dFinal, $alunoN,"", $freqReal,"", "", $d1, $d2);
?>

<script> 
tabelaDataTable('tb_lista_res', 'simples');
</script> 
