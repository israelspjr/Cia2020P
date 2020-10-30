<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idIntegranteGrupo = (int) $_REQUEST['idIntegranteGrupo'];
$aluno = new IntegranteGrupo();
$relatorio = new Relatorio();
$data = new DateTime();

$ano_ini = date("Y");
$mes_ini = date("m");
$ano_fim = date("Y");
$mes_fim = date("m");

$NomeAluno = $aluno->getNomePF($idIntegranteGrupo);
if ($_POST['idIntegranteGrupo']){

    $where = " WHERE G.inativo = 0 AND CPF.inativo = 0 ";
    $ano_ini = $_POST['ano_ini'];
    $mes_ini = $_POST['mes_ini'];
    if($mes_ini<10):
        $d1 = "01-0".$mes_ini."-".$ano_ini;
    else:
        $d1 = "01-".$mes_ini."-".$ano_ini;
    endif;
    $data_ini = new DateTime($d1);

    $ano_fim = $_POST['ano_fim'];
    $mes_fim = $_POST['mes_fim'];
    if($mes_fim<10):
        $d2 = "01-0".$mes_fim."-".$ano_fim;
    else:
        $d2 = "01-".$mes_fim."-".$ano_fim;
    endif;
    $data_fim = new DateTime($d2);

    $dInicial = $data_ini->format('Y-m-d');
    $dFinal = $data_fim->format('Y-m-d');

    if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
        $where .= " AND FF.dataReferencia >= '{$data_ini->format('Y-m-d')}'
	 AND FF.dataReferencia <= '{$data_fim->format('Y-m-d')}' ";
    }

    if($idIntegranteGrupo) {
        $valor = $aluno->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
        $idClientePf = $valor[0]['clientePf_idClientePf'];

        $where .= " AND CPF.idClientePf IN (".$idClientePf.")";
    }
    //$rel = $relatorio->relatorioFrequenciaGrafico($where, 'mensal', true, '', '-', 0, $dInicial, $dFinal);
    $rel = $relatorio->relatorioFrequencia_mensal($where, "", "", "");
    //var_dump($rel);
}
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body style="padding: 50px;">
  <form action="<?php echo CAMINHO_REL."grupo/include/resourceHTML/grafico.php?idIntegranteGrupo=".$idIntegranteGrupo;?>" method="post">
      <p>
          <label>De:
              <select name="mes_ini" id="mes_ini" >
                  <?php for($x=1; $x <= 12; $x++){ ?>
                      <option value="<?php echo $x?>" <?php echo ($mes_ini == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                  <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                  <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                      <option value="<?php echo $x?>" <?php echo ($ano_ini == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                  <?php } ?>
              </select>
          </label>
      </p>
      <p>
          <label>Até:
              <select name="mes_fim" id="mes_fim" >
                  <?php for($x=1; $x <= 12; $x++){ ?>
                      <option value="<?php echo $x?>" <?php echo ($mes_fim == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                  <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                  <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                      <option value="<?php echo $x?>" <?php echo ($ano_fim == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                  <?php } ?>
              </select>
          </label>
      </p>
      <input name="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo; ?>" type="hidden"/>
      <input type="submit" value="ENVIAR"/>
  </form>
  <p>&nbsp;</p>
  <?php if ($_POST['idIntegranteGrupo']){ ?>
  <div id="chart_div"></div>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
          var data = google.visualization.arrayToDataTable([
                ['Mês', 'Horas Programadas', 'Horas Realizadas'],
                <?php foreach($rel as $r){
                    //$programadas = '['.number_format(($r['horasProgramadas']/60),'1','.','').',"'.Uteis::exibirHoras($r['horasProgramadas']).'"]';
                    //$realizadas = '['.number_format(($r['horasRealizadasPeloGrupo']/60),'1','.','').',"'.Uteis::exibirHoras($r['horasRealizadasPeloGrupo']).'"]';
                   $programadas = number_format(($r['horasProgramadas']/60),2,'.','');
                   $realizadas = number_format(($r['horasRealizadasPeloGrupo']/60),2,'.','');
                   $datatxt = substr(Uteis::retornaNomeMes($r['mes']),0,3).'/'.$r['ano'];
              ?>
                   ['<?php echo $datatxt; ?>', {v:<?php echo $programadas; ?>,f:'<?php echo Uteis::exibirHoras($r['horasProgramadas']);?>'}, {v:<?php echo $realizadas; ?>,f:'<?php echo Uteis::exibirHoras($r['horasRealizadasPeloGrupo']);?>'}],
               // ['<?php echo $datatxt; ?>', <?php echo $programadas; ?>, <?php echo $realizadas; ?>],
                <?php } ?>

          ]);

          var options = {
              chart: {
                  title: '<?php echo $NomeAluno; ?>',
                  subtitle: 'Periodo: <?php echo $mes_ini.'/'.$ano_ini; ?> - <?php echo $mes_fim.'/'.$ano_fim; ?>'
              },
              bars: 'vertical',
              vAxis: {format: 'decimal'},
              height: 500
          };

          var chart = new google.charts.Bar(document.getElementById('chart_div'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
      }
  </script>
  <?php }else{ ?>
      <p>- Selecione um periodo para exibir o gráfico</p>
  <?php } ?>
  </body>
</html>