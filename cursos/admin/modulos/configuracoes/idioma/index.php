<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();

?>

<div id="cadastro_Idioma" class="">
  <fieldset>
    <legend>Idioma</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/idioma/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/idioma/index.php";?>', '#cadastro_Idioma');" /> </div>
    <div class="lista">
      <table id="tb_lista_Idioma" class="registros">
        <thead>
          <tr>
            <th>idIdioma</th>
            <th>Idioma</th>
            <th>Status</th>
            <th>Disponivel Aula</th>
            <th>Link Teste</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/idioma/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/idioma/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/idioma/";		
		
		echo $Idioma->selectIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idIdioma</th>
            <th>Idioma</th>
            <th>Status</th>
            <th>Disponivel Aula</th>
            <th>Link Teste</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Idioma', 'config');</script> 
</div>
