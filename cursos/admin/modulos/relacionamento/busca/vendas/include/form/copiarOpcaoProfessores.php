<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaDataFixa.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AulaPermanenteGrupo.class.php");

$AulaDataFixa = new AulaDataFixa();
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$Professor = new Professor();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel()"></div>
  <fieldset>
    <legend>Replicar Lista de Opções de professores para os dias</legend>
    <form id="form_copiarOpcoesProf" class="validate" method="post" action="" onsubmit="return false">      
      <label><strong><p>Os Professores selecionados serão copiados de um dia para os demais.<br />Caso não queira que um professor seja replicado como opção para os outros dias <u>desmarque-o</u></strong></p></label>
      <div class="linha-inteira">
        <?php 
		$sql = "SELECT SQL_CACHE B.aulaDataFixa_idAulaDataFixa AS id, B.idBuscaProfessor, AF.horaInicio, AF.horaFim, AF.dataAula AS dia, B.dataApartir, 'AF' AS tipo 
		FROM buscaProfessor B 
		INNER JOIN aulaDataFixa AF ON AF.idAulaDataFixa  = B.aulaDataFixa_idAulaDataFixa 
		WHERE B.finalizada = 0 AND B.excluida = 0 AND AF.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
		" AND B.idBuscaProfessor IN (".$idBuscaProfessor.")".$where.
		" UNION 
		SELECT B.aulaPermanenteGrupo_idAulaPermanenteGrupo AS id, B.idBuscaProfessor, AP.horaInicio, AP.horaFim, AP.diaSemana AS dia, B.dataApartir, 'AP' AS tipo 
		FROM buscaProfessor B 
		INNER JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo 
		WHERE B.finalizada = 0 AND B.excluida = 0 AND AP.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo.
		" AND B.idBuscaProfessor IN (".$idBuscaProfessor.")".$where;
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
        <div <?php
                if ($cont % 2 == 0) {echo "class=\"direita\"";
                } else {echo "class=\"esquerda\"";
                }
            ?>>
         <p>   
             <label><?php echo $dataAula; ?></label>
             <input name="idBuscaProfessor[]" type="hidden" value="<?php echo $idBuscaProfessor_cada?>" />
        </p>
         <?php 
            $sql = "SELECT OBPS.professor_idProfessor FROM opcaoBuscaProfessorSelecionada AS OBPS WHERE OBPS.buscaProfessor_idBuscaProfessor in(".$idBuscaProfessor_cada.")";
            $rs = Uteis::executarQuery($sql);
       if($rs!=""){
       foreach($rs as $valor):
           $idProfessor = $valor['professor_idProfessor'];
           $nomeProfessor = $Professor->getNome($idProfessor);     
       ?>      
          <p>
            <label>Professor: <strong>
           <input name="idProfessor[]" type="checkbox" value="<?php echo $idProfessor?>" checked /><?php echo $nomeProfessor?></strong></label>
          </p>
      <?php endforeach;
        }else{
           ?>
         <p>
            <label>Não há professores a serem copiados deste dia</label>
         </p>
      
      <?php
        }
        $cont++;
        ?>
         </div> 
        <?php
        }
    ?>
      
      </div>
      </p>
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_copiarOpcoesProf', '<?php echo CAMINHO_REL."busca/vendas/include/acao/copiarOpcaoProfessores.php"?>');">Enviar</button>
        </p>
      </div>
    </form>
  </fieldset>
  <script>ativarForm();</script> 
</div>
