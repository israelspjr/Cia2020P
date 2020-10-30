<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$SubvencaoCursoGrupo = new SubvencaoCursoGrupo();
$SubvencaoMaterialGrupo = new SubvencaoMaterialGrupo();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();

$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);

$ids = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE grupo_idGrupo = ".$idGrupo);

//echo $idGrupo;

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$ValorIntegrante = $IntegranteGrupo->selectIntegranteGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");

foreach($ValorIntegrante AS $valor) {
$valorXx[] = $valor['idIntegranteGrupo'];		
}

$valorx3 = implode(', ',$valorXx);



?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>-->
  <div class="linha-inteira">
    <fieldset>
      <legend>Coparticipação do curso</legend>
      <?php
			$caminhoAbrir = CAMINHO_REL."grupo/include/form/subvencaoGrupo.php";
			$caminhoAbrir2 = CAMINHO_REL."grupo/include/form/subvencaoCursoGrupo2.php";
		    $caminhoAtualizar = CAMINHO_REL."grupo/cadastro.php?id=$idPlanoAcaoGrupo";
			$ondeAtualiza = "";
			$where = " WHERE SC.integranteGrupo_idIntegranteGrupo in (".$valorx3.")";
		?>
        <div class="menu_interno">
        <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Nova subvenção" 
        onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
        </div>
      <?php // }?>
      <div class="lista">
        
        <table id="tb_lista_SubvencaoCursoGrupo2" class="registros">
          <thead>
            <tr>
              
              <th>Aluno</th>
              <th>Coparticipação</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Nivel</th>
              <th>Data Entrada</th>
              <th>Data Saida</th>
              <th></th>
            </tr>
          </thead>
       
          <tbody>
            <?php 
		
		echo $SubvencaoCursoGrupo->selectSubvencaoCursoGrupoTrTotal($caminhoAbrir2, $caminhoAtualizar, $ondeAtualiza, $where)?>
          </tbody>   
          <tfoot>
            <tr>
             <th>Aluno</th>
              <th>Coparticipação</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Nivel</th>
              <th>Data Entrada</th>
              <th>Data Saida</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>
  </div>
  
  <!--<div class="direita">-->
  
    <fieldset>
      <legend>Coparticipação de material</legend>
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
        
        <table id="tb_lista_SubvencaoMaterialGrupo2" class="registros">
          <thead>
            <tr>
             <th>Aluno</th>
              <th>Coparticipação</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Nivel</th>
              <th>Data Entrada</th>
              <th>Data Saida</th>
              <th></th>
            </tr>
          </thead>
        
          <tbody>
            <?php 		
		echo $SubvencaoMaterialGrupo->selectSubvencaoMaterialGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where)?>
          </tbody>  <tfoot>
            <tr>
             <th>Aluno</th>
              <th>Coparticipação</th>
              <th>Teto</th>
              <th>Quem paga</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Nivel</th>
              <th>Data Entrada</th>
              <th>Data Saida</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>
<!--  </div>
  
</div>-->

<script>
tabelaDataTable('tb_lista_SubvencaoCursoGrupo2'); //, 'ordenaColuna');
tabelaDataTable('tb_lista_SubvencaoMaterialGrupo2'); //, 'ordenaColuna');

ativarForm();
</script> 
