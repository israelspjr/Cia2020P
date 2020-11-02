<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$Gerente =  new Gerente();

$mes = date('m');
$ano = date('Y');

$mesI = $mes - 2;
$anoI = date('Y');
?>

<fieldset>
  <legend>Mudanças de estágio / Grupos Batizados</legend>
  <div class="esquerda">
    <form id="form_Mudanca" class="validate" method="post" action="" onsubmit="return false" >
     De:
     <p> <select name="mesI" id="mesI" class="required">
        <?php for($x=1; $x <= 12; $x++){ ?>
        <option value="<?php echo $x?>" <?php echo ($mesI == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
        <?php }?>
      </select> 
      <select name="anoI" id="anoI" class="required">
        <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
        <option value="<?php echo $x?>" <?php echo ($anoI == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
        <?php } ?>
      </select></p>
      Até:
     <p> <select name="mes_Mudanca" id="mes_Mudanca" class="required">
        <?php for($x=1; $x <= 12; $x++){ ?>
        <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
        <?php }?>
      </select> 
     <select name="ano_Mudanca" id="ano_Mudanca" class="required">
        <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
        <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
        <?php } ?>
      </select></p>
       <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
      <button class="button blue" onclick="carregaMudancaEstagio()">Buscar</button>
    </form>
  </div>
  <div id="lista_Mudanca" class="lista">
 <!--   <center>
      Selecione um periodo e clique em buscar.
    </center>-->
  </div>
</fieldset>
<script>
function carregaMudancaEstagio(){
	var ano = $('#ano_Mudanca').val();
	var mes = $('#mes_Mudanca').val();
	var anoI = $('#anoI').val();
	var mesI = $('#mesI').val();
	var gerente = $('#idGerente').val();
	carregarModulo('<?php echo CAMINHO_MODULO?>relacionamento/mudanca/include/resourceHTML/mudanca.php?mes='+mes+'&ano='+ano+'&mesI='+mesI+'&anoI='+anoI+'&gerente='+gerente, '#lista_Mudanca');
}

ativarForm();
</script>