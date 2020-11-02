<?php
//pagina contendo a listagem
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/StatusCobranca.class.php");

$StatusCobranca = new StatusCobranca();

?>

<div id="cadastro_StatusCobranca" class="">
  <fieldset>
    <legend>Status de Cobrança</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/statusCobranca/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/statusCobranca/index.php";?>', '#cadastro_StatusCobranca');" /> </div>
    <div class="lista">
      <table id="tb_lista_StatusCobranca" class="registros">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Cor</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoModulo= CAMINHO_MODULO."configuracoes/	/";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/statusCobranca/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE idStatusCobranca NOT IN (1) AND excluido = 0";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/statusCobranca/";		
		
		echo $StatusCobranca->selectStatusCobrancaTr($caminhoModulo, $caminhoAtualizar, $ondeAtualiza, $where);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>Cor</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_StatusCobranca');</script> 
</div>
