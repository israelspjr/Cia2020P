<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DisponibilidadeProfessor = new DisponibilidadeProfessor();

$idProfessor = $_SESSION['idProfessor_SS'];

?>

<fieldset>
  <legend>Disponibilidade do professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/cadastro/disponibilidadeProfessorForm.php?idProfessor=".$idProfessor?>',  '#centro');" /> </div>
  <div class="lista">Legenda das cores de fundo: 
  <font color="#FF0000" style="font-size:16px">Indisponível</font>&nbsp;&nbsp;<font color="#00FF00" style="font-size:16px;font-weight:bold">Disponível somente presencial</font>&nbsp;&nbsp;<font color="#660000" style="font-size:16px">Disponível somente On-line</font>&nbsp;&nbsp;<font color="#0000FF" style="font-size:16px">Disponível On-line e Presencial</font> <br />
  Legenda das cores dos grupos:
  <font color="#00FF00" style="font-size:16px;font-weight:bold">Curso Presencial</font>&nbsp;&nbsp;<font color="#660000" style="font-size:16px">Curso On-line</font>
    <table id="tb_lista_disponibilidadeProfessor" width="100%">
      <thead>
        <tr>
          <th>Horário</th>
          <th>Domingo</th>
          <th>Segunda-feira</th>
          <th>Terça-feira</th>
          <th>Quarta-feira</th>
          <th>Quinta-feira</th>
          <th>Sexta-feira</th>
          <th>Sábado</th>
        </tr>
      </thead>
      <tbody>
        <?php echo  $DisponibilidadeProfessor->selectDisponibilidadeProfessorTr("modulos/cadastro/", "modulos/cadastro/disponibilidadeProfessor.php?id=".$idProfessor, "#centro", $idProfessor,1);?>
      </tbody>
    
    </table>
  </div>
</fieldset>
<script> 
//tabelaDataTable('tb_lista_disponibilidadeProfessor', 'simples');
</script> 
