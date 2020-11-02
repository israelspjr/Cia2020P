<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/MeioLocomocao.class.php");

$MeioLocomocao = new MeioLocomocao();

?>
<div id="cadastro_MeioLocomocao" class="">

<fieldset>
  <legend>MeioLocomocao</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/meiolocomocao/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/meiolocomocao/index.php";?>', '#cadastro_MeioLocomocao');" /> </div>
<div class="lista"><table id="tb_lista_MeioLocomocao" class="registros">
    <thead>
      <tr>
	  <th>idMeioLocomocao</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/meiolocomocao/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/meiolocomocao/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/meiolocomocao/";		
		
		echo $MeioLocomocao->selectMeioLocomocaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idMeioLocomocao</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_MeioLocomocao', 'config');</script> 
</div>