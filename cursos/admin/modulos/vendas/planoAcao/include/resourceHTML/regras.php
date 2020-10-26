<?php
//pagina contendo a listagem
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Regras = new Regras();

?>

<div id="cadastro_Regras" class="">
  <fieldset>
    <legend>Regras Personalizadas</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/regras.php?idPlanoAcao=".$idPlanoAcao;?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/regras.php";?>', '#cadastro_Regras');" /> </div>
    <div class="lista">
      <table id="tb_lista_Regras" class="registros">
        <thead>
          <tr>
            <th>idRegras</th>
            <th>Título Regra</th>
            <th> TipoCurso</th>
            <th>Status</th>
            <th>Padrão</th>
            <th>B2B</th>
            <th>B2C</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_VENDAS."planoAcao/include/form/regras.php";
		$caminhoAtualizar= CAMINHO_VENDAS."planoAcao/include/resourceHTML/regras.php";
		$ondeAtualiza= "#cadastro_Regras";
		$where = " WHERE excluido = 0 AND planoAcao_idPlanoAcao = ".$idPlanoAcao;
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/regras/";		
		
		echo $Regras->selectRegrasTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idRegras</th>
            <th>Título Regra</th>            
            <th> TipoCurso</th>
            <th>Status</th>
            <th>Padrão</th>
            <th>B2B</th>
            <th>B2C</th>
             <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Regras', 'config');</script> 
</div>
