<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Professor = new Professor();
$idProfessor = $_REQUEST['idProfessor'];
?>
<p>
	<strong>Grupos atuais</strong>
</p>
<div class="lista">
	<table id="tb_lista_grupos" class="registros">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
                <th>Data</th>
                <th>Status</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
                 <th>Data</th>
                <th>Status</th>
			</tr>
		</tfoot>
		<tbody>
			<?php
      $where = " AND PAG.inativo = 0 AND G.inativo = 0  ";
	  $NDados = array('idProf'=>$idProfessor);
      echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where,$NDados,0);
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
                    WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $idProfessor."  GROUP BY PAG.idPlanoAcaoGrupo";
//			echo $sql;
            $qGrupos = Uteis::executarQuery($sql);
            $idGrupos = '';
//			Uteis::pr($qGrupos);
     	$not = array();
	      foreach ($qGrupos as $value) {
                $not[] = $value['idPlanoAcaoGrupo'];
	        }

      
//      foreach ($Professor->selectGrupoProfTr_query($where) as $res)
//        $not[] = $res['idPlanoAcaoGrupo'];
 //    Uteis::pr($not);
//	 echo count($not);
			?>
		</tbody>
	</table>
</div>
<p>
	<strong>Folha de frequência de reposição</strong>
</p>
<!--<div class="linha-inteira">
	<button class="button gray" onclick="mostrar(1);"> Mostrar Grupos com Folha de reposição</button> 
</div>-->
<div class="lista" id="reposicao" style='display:block;'>

	<table id="tb_lista_reposicao" class="registros">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
			</tr>
		</tfoot>
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

echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where2, $NDados, 1);

			?>
		</tbody>
	</table>
</div>

<p>
	<strong>Grupos antigos</strong>
</p>
<div class="linha-inteira">
	<button class="button gray" onclick="mostrar(2);"> Mostrar Grupos Antigos</button> 
</div>
<div class="lista" id="antigo" style='display:none;'>

	<table id="tb_lista_grupos_antigos" class="registros">
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Empresa</th>
				<th>Plano de ação</th>
				<th>Grupo</th>
				<th>Nível</th>
			</tr>
		</tfoot>
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

echo $Professor->selectGrupoProfTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where2, $NDados,2);

			?>
		</tbody>
	</table>
</div>


<script>
	tabelaDataTable('tb_lista_grupos');
	tabelaDataTable('tb_lista_grupos_antigos');
	tabelaDataTable('tb_lista_reposicao'); 
	
function mostrar(x) {
	if (x == 2) {
document.getElementById("antigo").style.display = "block";	
	}
	
/*	if (x == 1) {
document.getElementById("reposicao").style.display = "block";			
	}*/
}


</script>