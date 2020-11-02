<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoBaixaPagamento.class.php");

$TipoBaixaPagamento = new TipoBaixaPagamento();

?>
<div id="cadastro_TipoBaixaPagamento" class="">
<fieldset>
  <legend>Tipo Baixa Pagamento</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/tipobaixapagamento/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/tipobaixapagamento/index.php";?>', '#cadastro_TipoBaixaPagamento');" /> </div>
<div class="lista"><table id="tb_lista_TipoBaixaPagamento" class="registros">
    <thead>
      <tr>
	  <th>idTipoBaixaPagamento</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/tipobaixapagamento/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/tipobaixapagamento/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/tipobaixapagamento/";		
		
		echo $TipoBaixaPagamento->selectTipoBaixaPagamentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idTipoBaixaPagamento</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_TipoBaixaPagamento', 'config');</script> 
</div>