<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$DemonstrativoCobrancaIntegranteGrupo = new DemonstrativoCobrancaIntegranteGrupo();	
$PlanoAcaoGrupo = new PlanoAcaoGrupo();	

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idClientePf = $_SESSION['idClientePf_SS'];

$camposSelect = array("CONCAT(D.mes, D.ano) AS periodo", "(CONCAT(D.mes, '/', D.ano)) AS periodo2");

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
    
  <fieldset>
      <legend>Demonstrativos</legend>
      <p><strong><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo)?></strong></p>
      <div class="lista">        
        <table id="tb_lista_demonstrativoCobranca" class="registros">
          <thead>
            <tr>
              <th></th>             
              <th>Período</th>
              <th>Total pago pelo aluno</th>
            </tr>
          </thead>
          <tbody>
            <?php 	            
           echo $DemonstrativoCobrancaIntegranteGrupo->selectDemonstrativoCobrancaIntegranteGrupoTr(
		   "modulos/demonstrativoCobranca/demonstrativoCobrancaForm.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo, 
		   "modulos/demonstrativoCobranca/resourceHTML/demonstrativoCobranca.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo", "",
		   " WHERE I.clientePf_idClientePf = $idClientePf AND D.planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo ",1);			
			?>
          </tbody>
          <tfoot>
            <tr>
              <th></th>             
              <th>Período</th>
              <th>Total aluno</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>
    
</div>   
<script>
//tabelaDataTable('tb_lista_demonstrativoCobranca', 'ordenaColuna');
</script>