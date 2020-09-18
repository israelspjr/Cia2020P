<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$EnderecoVirtual = new EnderecoVirtual();

$idClientePf = $_SESSION['idClientePf_SS'];
?>
<div id="div_lista_enderecoVirtual">
<fieldset>
  <legend>Endereços Virtuais</legend>
  <div class="menu_interno">
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo endereço virtual" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/enderecoVirtualForm.php?idClientePf=".$idClientePf?>', '#centro');" /> 
  </div>


<table id="tb_lista_enderecoVirtual" class="registros">
  <thead>
    <tr>
      <th>Tipo</th>
      <th>Endereço</th>
      <th>Principal</th>
       <th></th>
    </tr>
  </thead>
  <tbody>
    <?php echo $EnderecoVirtual->selectEnderecoVirtualTr("modulos/cadastro/", "modulos/cadastro/enderecoVirtual.php?id=".$idClientePf, "#div_lista_enderecoVirtual", " WHERE clientePf_idClientePf = ".$idClientePf);?>
  </tbody>
  <tfoot>
    <tr>
       <th>Tipo</th>
       <th>Endereço</th>
       <th>Principal</th>
        <th></th>
    </tr>
  </tfoot>
</table>
</fieldset>
</div>
<script> //tabelaDataTable('tb_lista_enderecoVirtual', 'simples');</script> 
