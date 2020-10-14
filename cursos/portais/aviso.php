<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$NewsProfessor = new NewsProfessor();
$Professor = new Professor();
$Prova = new Prova();
$Relatorio = new Relatorio();
$TextoEmailPadrao = new TextoEmailPadrao();
$Configuracoes = new Configuracoes();

$texto = $TextoEmailPadrao->selectTextoEmailPadrao(" WHERE excluido = 0 and candidato = 1");

$config = $Configuracoes->selectConfig();

?>

<style>
.canvasG {
	width: 300px;
    height: 300px;
    margin-left: auto;
    margin-right: auto;
}
	</style>

		

    <fieldset>
        
        <?php if ($_SESSION['idProfessor_SS'] == -1) {
			$candidato = 1;	?>

        <p><center><strong><span style="font-size:20px">Venha trabalhar com a <?php echo $config[0]['nomeEmpresa'];?></span></strong></center></p>

<?php echo $texto[0]['texto']?>

<p>Clique no link abaixo para iniciar o seu processo de registro: </p>
<p><strong>Não esqueça de cadastrar um email válido </strong></p>
<p><a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/professor.php', '#centro');">
							<svg class="glyph stroked chevron-right" style="    width: 28px;  height: 37px;"><use xlink:href="#stroked-chevron-right"></use></svg> Cadastro
						</a>
                        </p>
			
			
		<?php } ?>
			
			
<?php if (($_SESSION['idProfessor_SS'] != -1) &&  ($_SESSION['grafico'] != 1)){ 
			$candidato = 1; ?> 

<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Como está a satisfação dos alunos</h1>
				
			</div>
		</div><!--/.row-->


         <div class="row" >
			<div class="esquerda">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:0px;padding-bottom:0px;    line-height: 30px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Professor*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $_SESSION['idProfessor_SS'], 4, $idNotasTipoNota, $quesito, 1);
	
//	Uteis::pr($retorno);
echo $retorno['professor'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG" >
						<canvas id="PROFESSOR"  ></canvas>
						</div>
					</div>
				</div>
      </div>
      
			<div class="direita">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Qualidade da aula*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $_SESSION['idProfessor_SS'], 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['qualidade'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
						<canvas id="QUALIDADE DA AULA" width=250 height=250></canvas>
						</div>
					</div>
				</div>
           </div>
            </div>
         
			<div class="linha-inteira">
				<div class="panel panel-default">
				<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Resultado do curso*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $_SESSION['idProfessor_SS'], 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['resultado'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
							<canvas id="RESULTADO DO CURSO" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->     
                    <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="linha-inteira">
            <div class="panel panel-default">
				<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Comentários</strong> <br />
            
<?php
	$dataAtual = date("Y-m-d");

    $where = " AND PIG.finalizado = 1  AND DATE(PIG.dataReferencia) BETWEEN '2018-09-01' AND '".$dataAtual."' " .$where;

 //   $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG WHERE " . $where;

    $sql_corpo = " FROM psaIntegranteGrupo AS PIG  
    LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj  AND GER.dataExclusao IS NULL
    INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
    INNER JOIN respostaPsaProfessor AS RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
	AND RPP.professor_idProfessor = ". $_SESSION['idProfessor_SS'];
	
	
 $sql = "SELECT SQL_CACHE PIG.idPsaIntegranteGrupo, G.nome AS Grupo, CPF.nome AS nomeAluno, PIG.dataReferencia, CPF.idClientePf, GER.gerente_idGerente, RPP.obs " . $sql_corpo . $where.$gerente;

     $result2 = Uteis::executarQuery($sql);
	 $html = "";
	  foreach ($result2 as $value) {
		  if ($value['obs'] != '') {
		  	$html .= "<div><strong>".$value['nomeAluno']."</strong>:".$value['obs']."</div>";
		  }
	  }

?>			</div>
					<div class="panel-body">
              <div>
						<?php echo $html; ?>	
						</div>
					</div>
				</div>
			</div>
            </div>
</div>
<!--<legend>ÚLTIMOS AVISOS</legend>
-->

<?php


    $sql = " SELECT SQL_CACHE DISTINCT(G.idGrupo), PAG.idPlanoAcaoGrupo, PAG.planoAcao_idPlanoAcao ,G.nome, N.nivel , P.idProfessor, PAG.dataPrevisaoTerminoEstagio
			FROM professor AS P
                    INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
                    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
                    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
               /*     LEFT JOIN diaaulaff as DAFF ON DAFF.folhaFrequencia_idFolhaFrequencia=FF.idFolhaFrequencia*/
                    INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND
                        (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
                    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo 
					INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PAG.nivelEstudo_IdNivelEstudo
                    WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor = " . $_SESSION['idProfessor_SS']."  AND P.candidato = 0 AND G.inativo = 0 AND P.terceiro = 0 GROUP BY PAG.idPlanoAcaoGrupo";
//			echo $sql;
            $qGrupos = Uteis::executarQuery($sql);
            $idGrupos = '';
//			Uteis::pr($qGrupos);
if ($qGrupos == '') {
$add = " AND grupo = 0";	
	
}
     	$not = array();
		 foreach ($qGrupos as $value) {
			 $add = " AND grupo = 1";
                $not[] = $value['idPlanoAcaoGrupo'];
		}

$add .= " OR (popup = 1 AND portal = 1)";
$candidato = $Professor->getCandidato($_SESSION['idProfessor_SS']);

if ($candidato == 0) {
$valor = $NewsProfessor->selectNewsProfessor(" WHERE portal = 1 AND inativo = 0 ".$add. " ORDER BY idNewsProfessor DESC");

}

foreach ($valor as $value) {

if ($value['popup'] == 1) {

	?>


<?php 
} else {
	echo $value['news'];
}
echo "<hr>";

	
}

echo '<div class=\"linha-inteira\">"<div><h3>Provas Agendadas para o proximo mês</h3></div>';
  $rs = $Prova->selectProvaTr_professor();	
Uteis::pr($rs);
echo '</div>';
} 

if ($_SESSION['grafico'] == 1) { ?>
<script>
	zerarCentro();
	carregarModulo('/cursos/portais/modulos/ff/indexProf.php', '#centro');
</script>		
        
<?php } ?>

</fieldset>
<?php if (($candidato ==0) && ($_SESSION['grafico'] != 1)) {?>
<script>
function psa2(x) {
	 var status, clientePj, retorno, resultado, data, data2, idProfessor, total3;
  $("#grupo_idGrupo").empty();
  status = $("#statusG:checked").val();
  idProfessor = <?php echo $_SESSION['idProfessor_SS']; ?>;
  gerente = 0; //$("#idGerente option:selected").val();
  quantidade = 1;
  retorno = $.ajax({
    url:"<?php echo "modulos/select_psaProf.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,idProfessor:idProfessor,gerente:gerente, quantidade:quantidade, x:x}   
  });
  
  retorno.done(function( html ) {
	  
	//  console.log(html);
	 var result = html.trim(); 
     result = result.substring(",", result.length - 1); 
 	 var result2 = result.split(',');
	 total2=[];
	 result2.forEach(myFunction);
	 
	 function myFunction(item, index, arr=[] ) {
		 	var result3 = item.split(/\s*:\s*/);
	//	console.log(result3);
		total2.push(parseInt(result3[1]));
		
		if (parseInt(result3[0]) == 10) {
			arr[100] = result3[1];
		} else if (parseInt(result3[0]) == 9) {
			arr[99] = result3[1];	
		} else if (parseInt(result3[0]) == 8) {
			arr[88] = result3[1];	
		} else if (parseInt(result3[0]) == 7) {
			arr[77] = result3[1];	
		} else if (parseInt(result3[0]) == 6) {
			arr[66] = result3[1];	
		} else if (parseInt(result3[0]) == 5) {
			arr[55] = result3[1];	
		} else if (parseInt(result3[0]) == 4) {
			arr[44] = result3[1];	
		} else if (parseInt(result3[0]) == 3) {
			arr[33] = result3[1];	
		} else if (parseInt(result3[0]) == 2) {
			arr[22] = result3[1];	
		} else if (parseInt(result3[0]) == 1) {
			arr[11] = result3[1];	
		} else if (parseInt(result3[0]) == 0) {
			arr[00] = result3[1];	
		}
		data2 = arr;
		total3 = total2;
	 }
	  var total = 0;
	  for (let i = 0; i < total3.length; ++i) {
		  total += total3[i];
}
//	  console.log(total);
	  var config = {
        type: 'pie',
        data: {
            labels: ["Nota 0 ", "Nota 1 ", "Nota 2 ", "Nota 3 ", "Nota 4 ", "Nota 5 ", "Nota 6 ", "Nota 7 ", "Nota 8 ", "Nota 9 ", "Nota 10 "],
            datasets: [{
                backgroundColor: ['red',
                    'black',
                    '#85929E',
                    'blue',
					'brown',
					'#D2B4DE',
					'orange',
					'pink',
					'yellow',
					'green',
					'#bd3c4b'
               ],
                borderColor: ['red',
                    'black',
                    '#85929E',
                    'blue',
					'brown',
					'#D2B4DE',
					'orange',
					'pink',
					'yellow',
					'green',
					'#bd3c4b'
               ],
                data: [data2[00], data2[11], data2[22], data2[33], data2[44], data2[55], data2[66], data2[77], data2[88], data2[99], data2[100]],
            }]
        },
        options: {
			tooltips: {
  callbacks: {
    label: function(tooltipItem, data) {
      var dataset = data.datasets[tooltipItem.datasetIndex];
      //get the current items value
      var currentValue = dataset.data[tooltipItem.index];
    //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      var percentage = Math.floor(((currentValue/total) * 100)+0.5);

      return percentage + "%";
    }
  }
},
            responsive: true,
            legend: {
				display: false,
                position: 'bottom',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 10,
					filter: function(legendItem, chartData) {
                		if (legendItem.datasetIndex === 0) {
                 			 return false;
               			}
               	return true;
                }
            }
        }
    };
        var ctx = document.getElementById(x).getContext('2d');
        window.myPie = new Chart(ctx, config);

	});
}

psa2("PROFESSOR");
psa2("QUALIDADE DA AULA");
psa2("RESULTADO DO CURSO");

</script>
<?php } ?>