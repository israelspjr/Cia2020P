<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$ClientePf = new ClientePf();	
$Grupo = new Grupo(); 

$appN = $_SESSION['appN'];

?>

<p><strong>Grupos atuais</strong></p>
  <div class="lista">
    <table id="tb_lista_grupos" class="registros">
     
        <?php	
		if ($appN == 4) {
			
			?>
			  <thead>
      <tr>
        <th>Grupos</th>
      </tr>
    </thead>
    
    <?php
	echo $Grupo->selectGrupoTr_Rh($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, " WHERE clientePj_idClientePj = ".$_SESSION['idClientePj_SS']." AND G.inativo = 0 ORDER BY G.idGrupo DESC", 1);
		} else {
		$where = " WHERE C.idClientePf = ".$_SESSION['idClientePf_SS']." AND (I.dataSaida > CURDATE() OR I.dataSaida IS NULL OR I.dataSaida = '') AND P.inativo = 0 ";
		
		$sql = "SELECT SQL_CACHE DISTINCT(P.idPlanoAcaoGrupo), P.planoAcao_idPlanoAcao, G.nome, G.idGrupo, NI.nivel
		FROM clientePf AS C
		INNER JOIN integranteGrupo AS I ON I.clientePf_idClientePf = C.idClientePf
		INNER JOIN planoAcaoGrupo AS P ON P.idPlanoAcaoGrupo = I.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN nivelEstudo AS NI ON NI.IdNivelEstudo = P.nivelEstudo_IdNivelEstudo 
		INNER JOIN grupo AS G ON G.idGrupo = P.grupo_idGrupo" . $where ." 
		ORDER BY G.nome, NI.nivel";
		
		$result = Uteis::executarQuery($sql);
		
       foreach ($result as $valor2) {
		   $valorX[] = $valor2['idGrupo'];	
		}
		
		$valorx2 = implode(', ',$valorX);
		?>
         <thead>
        <tr>
          <th>Empresa</th>
          <th>Grupo</th><th>Nível</th>
          <th>Plano de ação</th>
          
        </tr>
      </thead>
        <tbody>
        <?php

		echo $ClientePf->selectGrupoAluno($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where,1);
		}
		?>
      </tbody>
    </table>
  </div>
<div><button class="button gray" onclick="mostrar();"> Mostrar Grupos Antigos</button> </div>
<div class="lista" id="antigo" style='display:none;'>
<p><strong>Grupos antigos</strong></p>
  <div class="lista">
    <table id="tb_lista_grupos_antigos" class="registros">
   
        <?php
						
		if ($appN == 4) {
			?>
			  <thead>
      <tr>
        <th>Grupos</th>
      </tr>
    </thead>
    <tbody>
    <?php
			echo $Grupo->selectGrupoTr_Rh($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, " WHERE clientePj_idClientePj = ".$_SESSION['idClientePj_SS']." AND G.inativo = 1 ORDER BY G.idGrupo DESC", 1); 
		} else {
			$where = " WHERE C.idClientePf = ".$_SESSION['idClientePf_SS']." AND (I.dataSaida <= CURDATE() OR P.inativo = 1) AND G.idgrupo NOT IN ( ".$valorx2.")";
			?>
         <thead>
        <tr>
          <th>Empresa</th>
          <th>Grupo</th><th>Nível</th>
          <th>Plano de ação</th>
          
        </tr>
      </thead>
        <tbody>
        <?php
			echo $ClientePf->selectGrupoAluno($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where,1);
		}
		
		
		?>
      </tbody>
    </table>
  </div>
</div>
<script>
tabelaDataTable('tb_lista_grupos', 'simples');
tabelaDataTable('tb_lista_grupos_antigos', 'simples');

function mostrar() {
document.getElementById("antigo").style.display = "block";	
}
</script>