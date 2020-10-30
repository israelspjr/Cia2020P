<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupoAjudaCusto = new PlanoAcaoGrupoAjudaCusto();

$idPlanoAcaoGrupo = $_GET['id'];

$caminhoAbrir = CAMINHO_REL."grupo/include/";
$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/planoAcaoGrupoAjudaCusto.php?id=".$idPlanoAcaoGrupo;
$ondeAtu = "#div_planoAcaoGrupoAjudaCusto";
?>

<fieldset>
  <legend>Ajuda de custo para professor</legend>
  
  <div class="menu_interno">
  
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Inserir ajuda de custo" onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."form/planoAcaoGrupoAjudaCusto.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtu?>');" />
  
  </div>
  
  <div class="lista">
    <table id="tb_lista_PlanoAcaoGrupoAjudaCusto" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Professor</th>
          <th>Inicio</th>
          <th>Fim</th>
          <th>Valor por dia de aula</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
			$where = " AND PAG.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;	
			echo $PlanoAcaoGrupoAjudaCusto->selectPlanoAcaoGrupoAjudaCustoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtu, $where);
			?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Professor</th>
          <th>Inicio</th>
          <th>Fim</th>
          <th>Valor por dia de aula</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_PlanoAcaoGrupoAjudaCusto', 'ordenaColuna_simples');
</script> 
