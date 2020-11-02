<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$CertificadoCurso = new CertificadoCurso();

?>
<div id="cadastro_CertificadoCurso" class="">
 
<fieldset>
  <legend>Certificado Curso</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/certificadocurso/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/certificadocurso/index.php";?>', '#cadastro_CertificadoCurso');" /> </div>
<div class="lista"><table id="tb_lista_CertificadoCurso" class="registros">
    <thead>
      <tr>
	  <th>id</th><th>Título</th><th>Obs</th><th>Nivel</th><th>Area</th><th>Certificação</th><th>Formação</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/certificadocurso/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/certificadocurso/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/certificadocurso/";		
		
		echo $CertificadoCurso->selectCertificadoCursoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>id</th><th>Título</th><th>Obs</th><th>Nivel</th><th>Area</th><th>Certificação</th><th>Formação</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_CertificadoCurso', 'config');</script> 
</div>