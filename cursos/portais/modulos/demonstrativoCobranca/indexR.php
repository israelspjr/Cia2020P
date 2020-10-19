<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$StatusCobranca = new StatusCobranca();
$gerente = new Gerente();
$ClientePj = new ClientePj();
$mes = date('m');
$ano = date('Y');
$IdClientePj = $_SESSION['idClientePj_SS'];

?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos', true);" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_DemonstrativoCobranca_data" class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
           <?php echo $a."<br />".$b."<br />".$c;?>
  
      <p>
        <label>Mês:</label>
        <select name="mes" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2015; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
      </div>
      <div class="direita">
         <p>
            <label>Empresa:</label>
            <?php echo $ClientePj->getNome($IdClientePj);?>
          </p>
          
        <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-"  onchange="grupos();">Ambos      
        </p>
          <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
      </div>
      <div class="linha-inteira">
        <button class="bBlue" onclick="filtro_postForm('img_form_Grupos', 'form_DemonstrativoCobranca_data', '<?php echo "modulos/demonstrativoCobranca/demonstrativoCobrancaR.php"?>', '', 'lista_DemonstrativoCobranca')">Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Demonstrativos de cobrança</legend>
  <?php //echo $StatusCobranca->selectStatusCobranca_legenda();?>
  <div id="lista_DemonstrativoCobranca" class="lista">
    
  </div>
</fieldset>
<script>
    $(function(){

        $("input[name=nome").keyup(function(){
            var nome = $(this).val();
            if(nome != ""){
                var dados = {
                    tabela:'clientePf',
                    nome:nome,
                    campo:'nome'
                }
                $.post('<?php echo "modulos/busca_nome.php";?>', dados, function(retorno){
                    $("#nomeList").html($.parseJSON(retorno));
                });
            }
        });
        $("input[name='Typelist']").on('input', function(e){
            alert('oi');
            var grupos = $(this).data('grupos');
            var empr = $(this).data('empr');
            alert(empr);
        })

    });

function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = <?php echo $IdClientePj?>; //$( "#clientePj_idClientePj" ).val();
  retorno = $.ajax({
    url:"<?php echo "modulos/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}
grupos();
</script>