<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoCarreirra.class.php");

$PlanoCarreirra = new PlanoCarreirra();

?>
<div id="cadastro_PlanoCarreirra" class="">
<fieldset>
  <legend>Plano Carreira</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/planocarreirra/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/planocarreirra/index.php";?>', '#cadastro_PlanoCarreirra');" /> </div>
<div class="lista"><table id="tb_lista_PlanoCarreirra" class="registros">
    <thead>
      <tr>
	  <th>idPlanoCarreira</th><th>Plano</th><th>Valor</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/planocarreirra/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/planocarreirra/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/planocarreirra/";		
		
		echo $PlanoCarreirra->selectPlanoCarreirraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idPlanoCarreira</th><th>Plano</th><th>Valor</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_PlanoCarreirra', 'config');</script> 
</div>