<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$PsaIntegranteGrupo = new PsaIntegranteGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();
$Funcionario = new Funcionario();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$grupo = $PlanoAcaoGrupo -> getNomeGrupo($idPlanoAcaoGrupo);

$idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo($_SESSION['idClientePf_SS'], $idPlanoAcaoGrupo, $dataAtual);

$idFuncionario = $IntegranteGrupo->select_gerentePorIdCliente($_SESSION['idClientePf_SS'], "", "", 1);

$email = $Funcionario->getEmail($idFuncionario);
$nome = $Funcionario->getNome($idFuncionario);




?>
<div id="div_lista_psa" class="lista">


  <fieldset>
    <legend>Pesquisas de satisfação</legend>
    <p>Grupo: <strong><?php echo $grupo?></strong></p>
    <div id="lista_psa" class="lista">
      <table id="tb_psa" class="registros">
        <thead>
        <!--  <th></th>-->
							<th>Data de referencia</th>
							<th>Descrição</th>
							<th>Finalizado</th>
							<th>Respostas</th>
        </thead>
 
        <tbody>
        <?php
				$caminhoAbrir =  "modulos/psa/perguntasPsa.php";
				$caminhoAtualizar =  "modulos/psa/psa.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo";
				$ondeAtualiza = "";

				echo $PsaIntegranteGrupo -> selectPsaIntegranteAlunoTr("", 1,1, $_SESSION['idClientePf_SS']);

	?>
        </tbody>
      </table>
    </div>
  </fieldset>
</div>
<?php require_once ("../ff/ffPsa.php") ?>;

<script>//tabelaDataTable('tb_psa');</script> 
