<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];


$mesI = $_REQUEST['mesI'];
$anoI = $_REQUEST['anoI'];

$idGerente = $_REQUEST['gerente'];

$caminhoAtualizar = CAMINHO_MODULO."relacionamento/mudanca/include/resourceHTML/mudanca.php?mes=$mes&ano=$ano&anoI=$anoI&mesI=$mesI&gerente=$idGerente";
?>

<!--<p>Período:<strong><?php //echo "$mes/$ano"?></strong></p>-->

<!--<p><strong>Grupos com mudança de estágio iniciada</strong></p>-->
<div class="linha-inteira">
<p><strong>Grupos com mudança de estágio ou batizado no período selecionado</strong></p>
<table id="tb_lista_Mudanca2" class="registros">
  <thead>
    <tr>
      <th>Grupo</th>
      <th>Grupo</th>
     <th>Nível Anterior</th>
      <th>Nível atual</th>
      <th>Inicio do estágio</th>
      <th>Iniciar  mudança</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Grupo</th>
      <th>Grupo</th>
      <th>Nível Anterior</th>
      <th>Nível atual</th>
      <th>Inicio do estágio</th>
      <th>Iniciar  mudança</th>
    </tr>
  </tfoot>
  <tbody>
  <?php
  $where = "  AND PAG.inativo = 0 AND (MONTH(PAG.dataInicioEstagio) >= $mesI AND YEAR(PAG.dataInicioEstagio) >= $anoI AND MONTH(PAG.dataInicioEstagio) <= $mes AND YEAR(PAG.dataInicioEstagio) <= $ano) ";
  
  if ($idGerente != '-') {
	$where .= " AND GT.gerente_idGerente in (".$idGerente .")"; 
  }
  
  $where .= "ORDER BY mes, ano,PAG.dataInicioEstagio";
  echo $PlanoAcaoGrupo->mudancaEstagio_previstas($caminhoAtualizar, "#lista_Mudanca", $where, 1);
  ?>
  </tbody>
</table>
</div>
<div class="linha-inteira">
<p><strong>Grupos com mudança de estágio previstas no periodo selecionado (Grupo em vermelho - Mudança atrasada)</strong></p>
<table id="tb_lista_Mudanca" class="registros">
  <thead>
    <tr>
      <th>Grupo</th>
      <th>Grupo</th>
      <!--<th>Inicio</th>-->
      <th>Nível atual</th>
      <th>Término previsto</th>
      <th>Iniciar  mudança</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Grupo</th>
      <th>Grupo</th>
      <!--<th>Inicio</th>-->
      <th>Nível atual</th>
      <th>Término previsto</th>
      <th>Iniciar  mudança</th>
    </tr>
  </tfoot>
  <tbody>
  <?php
  $where = "  AND PAG.inativo = 0 AND (MONTH(PAG.dataPrevisaoTerminoEstagio) >= $mesI AND YEAR(PAG.dataPrevisaoTerminoEstagio) >= $anoI AND MONTH(PAG.dataPrevisaoTerminoEstagio) <= $mes AND YEAR(PAG.dataPrevisaoTerminoEstagio) <= $ano) ";
  
  if ($idGerente != '-') {
	$where .= " AND GT.gerente_idGerente in (".$idGerente .")"; 
  }
  
  $where .= "ORDER BY mes, ano,PAG.dataPrevisaoTerminoEstagio";
  echo $PlanoAcaoGrupo->mudancaEstagio_previstas($caminhoAtualizar, "#lista_Mudanca", $where);
  ?>
  </tbody>
</table>
</div>
<script>
	tabelaDataTable('tb_lista_Mudanca');
	tabelaDataTable('tb_lista_Mudanca2');		
</script> 
