<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoCursoGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SubvencaoMaterialGrupo.class.php");	

$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div class="esquerda">
    <fieldset>
      <legend>Subvenção de curso</legend>
      <?php
			$caminhoAbrir = CAMINHO_REL."grupo/include/form/subvencaoCursoGrupo.php";
			$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/subvencao.php?idIntegranteGrupo=$idIntegranteGrupo";
			$ondeAtualiza = "";
			$where = " WHERE integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo;
			
			$rs = $SubvencaoCursoGrupo->selectSubvencaoCursoGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NULL");
			if( !$rs ){
			?>
        <div class="menu_interno">
        <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Nova subvenção" 
        onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."?idIntegranteGrupo=$idIntegranteGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
        </div>
      <?php }?>
      <div class="lista">
        
        <table id="tb_lista_SubvencaoCursoGrupo" class="registros">
          <thead>
            <tr>
              <th>Ordenar</th>
              <th>Subvenção</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th></th>
            </tr>
          </thead>
       
          <tbody>
            <?php 
		
		echo $SubvencaoCursoGrupo->selectSubvencaoCursoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where)?>
          </tbody>   
          <tfoot>
            <tr>
              <th>Ordenar</th>
              <th>Subvenção</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>
  </div>
  
  <div class="direita">
  
    <fieldset>
      <legend>Subvenção de material</legend>
      <?php
			$caminhoAbrir = CAMINHO_REL."grupo/include/form/subvencaoMaterialGrupo.php"; 
			$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/subvencao.php?idIntegranteGrupo=$idIntegranteGrupo";
			$ondeAtualiza = "";
			$where = " WHERE integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo;
			
			$rs = $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupo(" WHERE integranteGrupo_idIntegranteGrupo = $idIntegranteGrupo AND dataFim IS NULL");
			if( !$rs ){
				?>
				<div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Nova subvenção" 
				onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."?idIntegranteGrupo=$idIntegranteGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
				</div>
      <?php }?>
      <div class="lista">
        
        <table id="tb_lista_SubvencaoMaterialGrupo" class="registros">
          <thead>
            <tr>
              <th>Ordenar</th>
              <th>Subvenção</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th></th>
            </tr>
          </thead>
        
          <tbody>
            <?php 		
		echo $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where)?>
          </tbody>  <tfoot>
            <tr>
              <th>Ordenar</th>
              <th>Subvenção</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>
  </div>
  
</div>

<script>
tabelaDataTable('tb_lista_SubvencaoCursoGrupo', 'ordenaColuna');
tabelaDataTable('tb_lista_SubvencaoMaterialGrupo', 'ordenaColuna');

ativarForm();
</script> 
