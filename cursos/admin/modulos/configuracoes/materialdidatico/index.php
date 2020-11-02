<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$MaterialDidatico = new MaterialDidatico();

?>

<div id="cadastro_MaterialDidatico" class="">
  <fieldset>
    <legend>Material Didático</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/materialdidatico/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/materialdidatico/index.php";?>', '#cadastro_MaterialDidatico');" /> </div>
    <div class="lista">
      <table id="tb_lista_MaterialDidatico" class="registros">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Material Didático Tipo</th>
            <th>Editora Material Didático</th>
            <th>Idioma</th>
            <th>Valor</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/materialdidatico/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/materialdidatico/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE m.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/materialdidatico/";		
		
		echo $MaterialDidatico->selectMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>Material Didático Tipo</th>
            <th>Editora Material Didático</th>
            <th>Idioma</th>
            <th>Valor</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_MaterialDidatico', 'simples');</script> 
</div>
