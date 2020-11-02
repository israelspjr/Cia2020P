<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Prova.class.php");

$Prova = new Prova();

?>

<div id="cadastro_Prova" class="">
  <fieldset>
    <legend>Prova</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/prova/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/prova/index.php";?>', '#cadastro_Prova');" /> </div>
    <div class="lista">
      <table id="tb_lista_Prova" class="registros">
        <thead>
          <tr>
            <th>idProva</th>
            <th>Nome</th>
            <th>Ordem</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/prova/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/prova/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/prova/";		
		
		echo $Prova->selectProvaTrLista($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idProva</th>
            <th>Nome</th>
            <th>Ordem</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Prova', 'config');</script> 
</div>
