<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguistico.class.php");

$NivelLinguistico = new NivelLinguistico();

?>
<div id="cadastro_NivelLinguistico" class="">
<fieldset>
  <legend>Nível Linguístico</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/nivellinguistico/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/nivellinguistico/index.php";?>', '#cadastro_NivelLinguistico');" /> </div>
<div class="lista"><table id="tb_lista_NivelLinguistico" class="registros">
    <thead>
      <tr>
	  <th>idNivelLinguistico</th><th>Nível</th><th>Descrição</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/nivellinguistico/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/nivellinguistico/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/nivellinguistico/";		
		
		echo $NivelLinguistico->selectNivelLinguisticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idNivelLinguistico</th><th>Nível</th><th>Descrição</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_NivelLinguistico', 'config');</script> 
</div>