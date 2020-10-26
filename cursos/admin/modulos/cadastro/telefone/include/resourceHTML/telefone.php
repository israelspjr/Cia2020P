<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Telefone = new Telefone();

$param .= "idClientePf=$idClientePf";
$param .= "&idClientePj=$idClientePj";
$param .= "&idProfessor=$idProfessor";
$param .= "&idFuncionario=$idFuncionario";
$param .= "&idContatoAdicional=$idContatoAdicional";

$nomeTb = "tb_lista_telefone_".date('His');
?>

<fieldset>
  <legend>Telefone</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."form/telefone.php?".$param?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" /> </div>
  <div class="lista">
    <table id="<?php echo $nomeTb?>" class="registros">
      <thead>
        <tr>
          <th>DDD</th>
          <th>Número do telefone</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Telefone->selectTelefoneTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>DDD</th>
          <th>Número do telefone</th>
          <th>Descrição</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('<?php echo $nomeTb?>', 'simples');</script> 
