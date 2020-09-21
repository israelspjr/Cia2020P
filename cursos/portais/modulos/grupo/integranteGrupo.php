<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$IntegranteGrupo = new IntegranteGrupo();	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

$caminho = "modulos/grupo/";

//$grupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo);

?>

<fieldset>
<legend>Alunos atuais</legend>
<div class="lista">
  <table id="tb_lista_AlunosGrupo" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Entrada</th>
        <th>Saida</th>
        <th>Motivo</th>
        <th>Frequencia</th>
        <th>Data última PSA Respondida</th>
        <th>Pesquisa de satisfação</th>
        
        <th>Provas</th>
        <th>Relatório de desempenho</th>
      </tr>
    </thead>
 
    <tbody>
      <?php 
    $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND (dataSaida > CURDATE() OR dataSaida IS NULL OR dataSaida = '') ";
    echo $IntegranteGrupo->selectIntegranteGrupoTr_rh($caminho, $where, 1)?>
    </tbody>
  </table>
</div>
</fieldset>

<fieldset>
<legend>Alunos antigos</legend>
<div class="lista">
  <table id="tb_lista_AlunosGrupo_old" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Entrada</th>
        <th>Saida</th>
        <th>Motivo</th>
        <th>Frequencia</th>
        <th>Data última PSA Respondinda</th>
        <th>Pesquisa de satisfação</th>
        <th>Provas</th>
        <th>Relatório de desempenho</th>
      </tr>
    </thead>

    <tbody>
      <?php 
    $where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND dataSaida <= CURDATE() ";
    echo $IntegranteGrupo->selectIntegranteGrupoTr_rh($caminho, $where)?>
    </tbody>
  </table>
</div>
</fieldset>

<script>
//tabelaDataTable('tb_lista_AlunosGrupo', 'simples');
//tabelaDataTable('tb_lista_AlunosGrupo_old', 'simples');
</script> 