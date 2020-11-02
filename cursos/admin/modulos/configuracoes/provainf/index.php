<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProvaINF.class.php");

$ProvaINF = new ProvaINF();

?>

<div id="cadastro_ProvaINF" class="">
  <fieldset>
    <legend>Prova I.N.F.</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/provainf/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/provainf/index.php";?>', '#cadastro_ProvaINF');" /> </div>
    <div class="lista">
      <table id="tb_lista_ProvaINF" class="registros">
        <thead>
          <tr>
            <th>idProvaINF</th>
            <th>Prova</th>
            <th>Relacionamento I.N.F.</th>
            <th>Unidade</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/provainf/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/provainf/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE p.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/provainf/";		
		
		echo $ProvaINF->selectProvaINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idProvaINF</th>
            <th>Prova</th>
            <th>Relacionamento I.N.F.</th>
            <th>Unidade</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ProvaINF', 'config');</script> 
</div>
