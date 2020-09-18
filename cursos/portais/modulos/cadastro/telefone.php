<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Telefone = new Telefone();

$idClientePf = $_SESSION['idClientePf_SS'];
?>
<div id="div_lista_telefone">
<fieldset>
  <legend>Telefones</legend>
  
  <div class="menu_interno"> 
  
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo telefone" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/telefoneForm.php?idClientePf=".$idClientePf?>', '#centro');" /> 
  
  </div>

<table id="tb_lista_telefone" class="registros">
  <thead>
    <tr>
      <th>DDD</th>
      <th>Número do telefone</th>
      <th>Descrição</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $Telefone->selectTelefoneTr("modulos/cadastro/", "modulos/cadastro/telefone.php", "#div_lista_telefone", " WHERE clientePf_idClientePf = ".$idClientePf);?>
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
</fieldset>
</div>
<script> //tabelaDataTable('tb_lista_telefone', 'simples');</script> 
