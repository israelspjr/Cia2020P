<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$MaterialDidaticoINF = new MaterialDidaticoINF();

?>

<div id="cadastro_MaterialDidaticoINF" class="">
  <fieldset>
    <legend>Material Didático I.N.F.</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/materialdidaticoinf/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/materialdidaticoinf/index.php";?>', '#cadastro_MaterialDidaticoINF');" /> </div>
    <div class="lista">
      <table id="tb_lista_MaterialDidaticoINF" class="registros">
        <thead>
          <tr>
            <th>idMaterialDidaticoINF</th>
            <th>Relacionamento I.N.F.</th>
            <th>Material Didático</th>
            <th>Unidade Inicial</th>
            <th> Unidade Final</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/materialdidaticoinf/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/materialdidaticoinf/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE m.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/materialdidaticoinf/";		
		
		echo $MaterialDidaticoINF->selectMaterialDidaticoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idMaterialDidaticoINF</th>
            <th>Relacionamento I.N.F.</th>
            <th>Material Didático</th>
            <th>Unidade Inicial</th>
            <th> Unidade Final</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_MaterialDidaticoINF', 'simples');</script> 
</div>
