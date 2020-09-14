<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ClientePf = new ClientePf();	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();	

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$valorX = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Folha de frequência</legend>
    <p>Grupo: <strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
    <div class="lista">
      <table id="tb_lista_grupos_Mes" class="registros">
        <thead>
          <tr>
          	<th></th>
          	<th>Professor</th>
            <th>Mes/ano</th>  
            <th>Status</th>          
          </tr>
        </thead>
        <tbody> 
		<?php		
		$caminhoAbrir = "modulos/ff/ff.php";
		$caminhoAtualizar = "modulos/ff/grupoMes.php";
		$where = " WHERE C.idClientePf = ".$_SESSION['idClientePf_SS']." AND P.idPlanoAcaoGrupo in (".$valorX.")";		
        echo $ClientePf->selectGrupoAlunoMes($caminhoAbrir, $caminhoAtualizar, "#centro", $where, 1)
        ?>
        </tbody>
       
       
      </table>
    </div>
  </fieldset>
  <script>
   // tabelaDataTable('tb_lista_grupos_Mes', 'ordenaColuna');
    </script> 
</div>
