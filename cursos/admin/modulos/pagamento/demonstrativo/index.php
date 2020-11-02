<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$StatusCobranca = new StatusCobranca();
$Professor = new Professor();

$mes = date('m');
$ano = date('Y');	
?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_Demonstrativo_data" class="validate" method="post" action="" onsubmit="return false" >
      <p>
        <label>Mês:</label>
        <select name="mes" id="mes_Demonstrativo" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano_Demonstrativo" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
      <p>
      <label>Professor: </label>
      <?php echo $Professor->selectProfessorSelect("",""," AND candidato = 0"); ?>
      </p>
      
    <!--  <p><label><input type="checkbox" name="tipo" id="tipo"  value="1"/> Professor com débito/crédito 
      </label></p>-->
      <p><label> <input type="checkbox" name="zerado" id="zerado"  value="1"/> Mostrar Professor com saldo zerado. 
      </label></p>
      <p><label> <input type="checkbox" name="terceiro" id="terceiro"  value="1"/> Mostrar Professor Terceirizado 
      </label></p>
      
            <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_Demonstrativo_data', '<?php echo CAMINHO_PAG."demonstrativo/include/resourceHTML/demonstrativo.php"?>', '', '#lista_Demonstrativo')">Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Demonstrativo de pagamento</legend>
  <div id="lista_Demonstrativo" class="lista">
    
  </div>
</fieldset>
<script>
ativarForm();
</script>