<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RegistroDeAnotacoes.class.php");

$RegistroDeAnotacoes = new RegistroDeAnotacoes();

$idPlanoAcao = $_REQUEST['id'];
?>

<fieldset>
  <legend>Registro de anotações</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."registroDeAnotacoes/include/form/registroDeAnotacoes.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/registroDeAnotacoes.php?id=".$idPlanoAcao?>', '#div_lista_registroDeAnotacoes');" /> </div>
  <div class="lista">
    <table id="tb_lista_registroDeAnotacoes" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Título</th>
          <th>Anotação</th>      
          <th>Data de abertura</th>
          <th>Data para novo contato</th>
          <th>Financeiro</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $RegistroDeAnotacoes->selectRegistroDeAnotacoesTr(CAMINHO_CAD."registroDeAnotacoes/include/form/registroDeAnotacoes.php", CAMINHO_VENDAS."planoAcao/include/resourceHTML/registroDeAnotacoes.php?id=".$idPlanoAcao, "#div_lista_registroDeAnotacoes", " WHERE planoAcao_idPlanoAcao = ".$idPlanoAcao, "&idPlanoAcao=".$idPlanoAcao); ?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Título</th>
          <th>Anotação</th>
          <th>Data de abertura</th>
          <th>Data para novo contato</th>
           <th>Financeiro</th>         
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_registroDeAnotacoes', 'ordenaColuna');</script> 
