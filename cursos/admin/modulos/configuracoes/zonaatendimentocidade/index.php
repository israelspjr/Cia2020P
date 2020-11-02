<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ZonaAtendimentoCidade.class.php");
 
$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();

?>

<div id="cadastro_ZonaAtendimentoCidade" class="">
  <fieldset>
    <legend>Zona Atendimento Cidade</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO CADASTRO" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/zonaatendimentocidade/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/zonaatendimentocidade/index.php";?>', '#cadastro_ZonaAtendimentoCidade');" /> </div>
    <div class="lista">
      <table id="tb_lista_ZonaAtendimentoCidade" class="registros">
        <thead>
          <tr>
            <th>idZonaAtendimentoCidade</th>
            <th>Cidade</th>
            <th>País</th>
            <th>Zona</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/zonaatendimentocidade/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/zonaatendimentocidade/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/zonaatendimentocidade/";		  
		
		echo $ZonaAtendimentoCidade->selectZonaAtendimentoCidadeTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idZonaAtendimentoCidade</th>
            <th>Cidade</th>
            <th>País</th>
            <th>Zona</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ZonaAtendimentoCidade', 'config');</script> 
</div>
