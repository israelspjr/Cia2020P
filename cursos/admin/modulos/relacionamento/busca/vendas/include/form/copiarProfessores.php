<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AulaDataFixa = new AulaDataFixa();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
    <legend>Replicar professores para dias</legend>
    <form id="form_copiarProf" class="validate" method="post" action="" onsubmit="return false">
      <input name="idBuscaProfessor" type="hidden" value="<?php echo $idBuscaProfessor?>" />
      <?php 
	   $sql = " SELECT P.nome, P.idProfessor, OB.valorHora
	   FROM opcaoBuscaProfessorSelecionada AS OB
	   INNER JOIN professor AS P ON P.idProfessor = OB.professor_idProfessor
	   WHERE OB.aceito = 1 AND buscaProfessor_idBuscaProfessor = ".$idBuscaProfessor;
	   $rs = Uteis::executarQuery($sql);
	   
	   $idProfessor = $rs[0]['idProfessor'];
	   $nomeProfessor = $rs[0]['nome'];	
	   $valorHora = $rs[0]['valorHora'];
	      
	   ?>
      <input name="idProfessor" type="hidden" value="<?php echo $idProfessor?>" />
      <input name="valorHora" type="hidden" value="<?php echo $valorHora?>" />
      <p>
        <label>Professor base: <strong><?php echo $nomeProfessor?></strong></label>
      </p>
      <p>
        <label>Valor Hora: <strong><?php echo $valorHora?></strong></label>
      </p>
      <p>
        <label>Dias à serem adicionados:</label>
      <div class="linha-inteira">
        <?php 
		$not = " SELECT OBPS.buscaProfessor_idBuscaProfessor 
		FROM opcaoBuscaProfessorSelecionada AS OBPS WHERE OBPS.buscaProfessor_idBuscaProfessor = B.idBuscaProfessor AND aceito = 1 ";
		
		$sql = "SELECT SQL_CACHE B.aulaDataFixa_idAulaDataFixa AS id, B.idBuscaProfessor, AF.horaInicio, AF.horaFim, AF.dataAula AS dia, B.dataApartir, 'AF' AS tipo 
		FROM buscaProfessor B 
		INNER JOIN aulaDataFixa AF ON AF.idAulaDataFixa  = B.aulaDataFixa_idAulaDataFixa 
		WHERE B.finalizada = 0 AND B.excluida = 0 AND AF.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
		" AND B.idBuscaProfessor NOT IN (".$idBuscaProfessor.") AND B.idBuscaProfessor NOT IN (".$not.") ".$where.
		" UNION 
		SELECT B.aulaPermanenteGrupo_idAulaPermanenteGrupo AS id, B.idBuscaProfessor, AP.horaInicio, AP.horaFim, AP.diaSemana AS dia, B.dataApartir, 'AP' AS tipo 
		FROM buscaProfessor B 
		INNER JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo 
		WHERE B.finalizada = 0 AND B.excluida = 0 AND AP.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
		" AND B.idBuscaProfessor NOT IN (".$idBuscaProfessor.") AND B.idBuscaProfessor NOT IN (".$not.") ".$where;
		$rs = Uteis::executarQuery($sql);
		
		$cont = 1;
		foreach($rs as $valor){
			
			$idBuscaProfessor_cada = $valor['idBuscaProfessor'];
			$tipo = $valor['tipo'];
			
			if($tipo == "AF"){
				//$dataAula = Uteis::exibirData($valor['dia']);
				$dataAula = $AulaDataFixa->montaDias($valor['id']);
			}elseif($tipo == "AP"){
				//$dataAula = Uteis::exibirDiaSemana($valor['dia']);	
				$dataAula = $AulaPermanenteGrupo->montaDias($valor['id']);
			}			
			?>
        <div style="float:left;width:50%;">
          <label>
            <input type="checkbox"  name="copiarDia[]" id="copiarDia_<?php echo $idBuscaProfessor_cada;?>" 
          value="<?php echo $idBuscaProfessor_cada;?>" checked="checked" />
            <?php echo $dataAula;?> </label>
        </div>
        <?php 
            
		}?>
      </div>
      </p>
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_copiarProf', '<?php echo CAMINHO_REL."busca/vendas/include/acao/copiarProfessores.php"?>');">Enviar</button>
        </p>
      </div>
    </form>
  </fieldset>
  <script>ativarForm();</script> 
</div>
