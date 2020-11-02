<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$Relatorio = new Relatorio();

require_once "../acao/filtros.php";
?>

<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_rel', '<?php echo CAMINHO_RELAT."NF/include/acao/nfe.php"?>')"> Exportar relatório</button>
</div>
<fieldset>
<legend>Relatório de Recebiveis</legend>   
  <div class="lista">
    <p><img src="<?php echo CAMINHO_IMG."mais2.png";?>" title="Adicionar Horas" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/bancoHoras_lancamentos.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/bancoHoras.php?id=".$idPlanoAcaoGrupo?>', '#div_bancoHoras');" /> 
    <table id="tb_lista_credeb" class="registros">
    <thead>
        <tr>          
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Obs</th>
          <th>Editar</th> 
          <th></th>      
        </tr>
      </thead>
      <tbody>
        <?php       
            echo $DiaAulaFF->CreditosDebitosBH(CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/resourceHTML/bancoHoras.php?id=".$idPlanoAcaoGrupo, '#div_bancoHoras', $idPlanoAcaoGrupo, $podeExcluir = false);
        ?>
      </tbody>
      <tfoot>
        <tr>            
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Obs</th>
          <th>Editar</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_credeb');
</script>
<fieldset>
<legend>Relatório NFE</legend>   
  <div class="lista">
    <p><img src="<?php echo CAMINHO_IMG."mais2.png";?>" title="Adicionar Horas" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/bancoHoras_lancamentos.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/bancoHoras.php?id=".$idPlanoAcaoGrupo?>', '#div_bancoHoras');" /> 
    <table id="tb_lista_credeb" class="registros">
    <thead>
        <tr>          
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Obs</th>
          <th>Editar</th> 
          <th></th>      
        </tr>
      </thead>
      <tbody>
        <?php       
            echo $DiaAulaFF->CreditosDebitosBH(CAMINHO_REL."grupo/include/", CAMINHO_REL."grupo/include/resourceHTML/bancoHoras.php?id=".$idPlanoAcaoGrupo, '#div_bancoHoras', $idPlanoAcaoGrupo, $podeExcluir = false);
        ?>
      </tbody>
      <tfoot>
        <tr>            
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Obs</th>
          <th>Editar</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_credeb');
</script>
