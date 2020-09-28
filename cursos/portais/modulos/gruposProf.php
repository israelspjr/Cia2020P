<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$Professor = new Professor();
?>
<div id="planoAcao"></div>
<p>
	<strong>Grupos atuais</strong>
</p>
<div class="lista">
	<table id="tb_lista_grupos" class="registros" style="cursor:pointer">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
                <th>Data-FF</th>
                <th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
      $where = " AND PAG.inativo = 0 AND G.inativo = 0  GROUP BY PAG.idPlanoAcaoGrupo";
	  $NDados = array('idProf'=>$_SESSION['idProfessor_SS']);
      echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where,$NDados,0,1);
      $sql = " SELECT SQL_CACHE DISTINCT(G.idGrupo), PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao ,G.nome, N.nivel , P.idProfessor, PAG.dataPrevisaoTerminoEstagio
			FROM professor AS P
                    INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
                    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
               /*     LEFT JOIN diaaulaff as DAFF ON DAFF.folhaFrequencia_idFolhaFrequencia=FF.idFolhaFrequencia*/
                    INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
                        (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
                    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
					INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo
                    WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $_SESSION['idProfessor_SS']."  GROUP BY PAG.idPlanoAcaoGrupo";
//			echo $sql;
            $qGrupos = Uteis::executarQuery($sql);
            $idGrupos = '';
//			Uteis::pr($qGrupos);
     	$not = array();
	      foreach ($qGrupos as $value) {
                $not[] = $value['idPlanoAcaoGrupo'];
	        }

			?>
		</tbody>
	</table>
</div>
<hr />
<p>
	<strong>Folha de frequência de reposição</strong>
</p>

<div class="lista" id="reposicao" style='display:block;'>

	<table id="tb_lista_reposicao" class="registros" style="cursor:pointer">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
               
			</tr>
		</thead>
	<tbody>
			<?php
			
			$where2 = "
        AND FF.dataReferencia <= '".date("Y")."-".date("m")."-01'
        AND PAG.inativo = 0
        AND G.inativo = 0";

if(count($not)>0){  
$where2 .= " AND PAG.idPlanoAcaoGrupo NOT IN(".implode(",", $not).")";
}
$where2 .= " GROUP BY G.idGrupo";

echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where2, $NDados, 1,1);

			?>
		</tbody>
	</table>
</div>
<hr />
<p>
	<strong>Grupos antigos</strong>
</p>
<div class="linha-inteira">
	<button class="button gray" onclick="mostrar(2);"> Mostrar Grupos Antigos</button> 
</div>
<div class="lista" id="antigo" style='display:none;'>

	<table id="tb_lista_grupos_antigos" class="registros" style="cursor:pointer">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
                 
			</tr>
		</thead>
		<tbody>
			<?php
		
			$where2 = "
     /*   AND FF.dataReferencia <= '".date("Y")."-".date("m")."-01'*/
        AND (PAG.inativo = 1
        OR G.inativo = 1)";

if(count($not)>0){  
$where2 .= " AND PAG.idPlanoAcaoGrupo NOT IN(".implode(",", $not).")";
}
$where2 .= " GROUP BY G.idGrupo";

echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where2, $NDados,2,1);

			?>
		</tbody>
	</table>
</div>


<script>
//	tabelaDataTable('tb_lista_grupos', 'simples');
//	tabelaDataTable('tb_lista_grupos_antigos', 'simples');
//	tabelaDataTable('tb_lista_reposicao', 'simples'); 
	
function mostrar(x) {
	if (x == 2) {
document.getElementById("antigo").style.display = "block";	
	}
	
}

function zerarPlano() {
	$('#planoAcao').html('');
}

</script>