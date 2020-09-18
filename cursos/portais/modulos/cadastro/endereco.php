<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Endereco = new Endereco();

$idClientePf = $_SESSION['idClientePf_SS'];
?>
<div id="div_lista_endereco">
<fieldset>
  <legend>Endereços</legend>
  <div class="menu_interno"> 
  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo endereço" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/enderecoForm.php?idClientePf=".$idClientePf?>', '#centro');" /> 
  </div>
  
<table id="tb_lista_endereco" class="registros">
  <thead>
    <tr>
      <th>Endereço</th>
      <th>Link do mapa</th>
      <th>Principal</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php echo $Endereco->selectEnderecoTr("modulos/cadastro/", "modulos/cadastro/endereco.php?id=".$idClientePf, "#div_lista_endereco", " AND clientePf_idClientePf = ".$idClientePf);
?>
  </tbody>
  <tfoot>
    <tr>
      <th>Endereço</th>
      <th>Link do mapa</th>
      <th>Principal</th>
      <th></th>
    </tr>
  </tfoot>
</table>

</fieldset>
</div>
<script> //tabelaDataTable('tb_lista_endereco', 'simples');</script> 
