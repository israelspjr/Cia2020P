<?php require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();

$gerente = " AND GCNPJ.clientePj_idClientePj =" .$_SESSION['idClientePj_SS'];
$dataAtual = date("Y-m-d");
$where .= " AND DATE(PIG.dataReferencia) BETWEEN '2018-09-01' AND '".$dataAtual."' ";

?>
<style>
.canvasG {
	width: 300px;
    height: 300px;
    margin-left: auto;
    margin-right: auto;
}
	</style>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Como está sua empresa hoje</h1>
				
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
            
            
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Grupos</div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Alunos 
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas2" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->
            </div>
            </div>
            
            
            <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="col-md-6">
				<div class="panel panel-default">
				<div class="panel-heading">Idiomas  <!--<button style="    background-color: blue; color: white;" disabled="disabled">Inglês</button> <button disabled="disabled" style="background-color: orange; color: white;">Espanhol</button> <button disabled="disabled" style="background-color: green; color: white;">Francês</button>--></div>
					<div class="panel-body">
                    <div class="canvasG" >
							<canvas id="canvas3" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->
             <div class="row" >
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:0px;padding-bottom:0px;    line-height: 30px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Professor*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['professor'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG" >
						<canvas id="PROFESSOR"  ></canvas>
						</div>
					</div>
				</div>
           </div>
            </div>
                       <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Gestão do curso*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['gestao'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
							<canvas id="GESTÃO DO CURSO" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->
             <div class="row" >
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Qualidade da aula*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
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
                       <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="col-md-6">
				<div class="panel panel-default">
				<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 16px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Resultado do curso*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['resultado'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
							<canvas id="RESULTADO DO CURSO" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->
             <div class="row" >
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 15px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>Compromisso com o aprendizado*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['compromisso'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
						<canvas id="COMPROMISSO COM O APRENDIZADO" width=250 height=250></canvas>
						</div>
					</div>
				</div>
           </div>
            </div>
                       <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding-top:8px;padding-bottom:0px;    line-height: 15px;text-align: center;">Pesquisa de Satisfação de aluno: <strong>NPS - Net Promoter Score*</strong> <br />
	<?php $retorno = $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito, 1);
echo $retorno['nps'];
	?></div>
					<div class="panel-body">
                    <div class="canvasG">
							<canvas id="NPS - Net Promoter Score" width=250 height=250></canvas>
						</div>
					</div>
				</div>
			</div><!--/.row-->
        </div>
  <div class="row" style="margin-left: 30px; margin-right: 30px;">
   
  <div>* Este gráfico leva em consideração a data inicial de 01/09/2019 para pesquisar outro período utilize o relatório de pesquisa de satisfação. </div>
  </div>
 
<script>

function grupos(x){
  var status, clientePj, retorno;
    if (x == 'canvas') {
    var url = "<?php echo "modulos/select_grupos.php"?>";
	  } else if (x == 'canvas2') {
	var url = "<?php echo "modulos/select_alunos.php"?>";	  
	  } 
  
  $("#grupo_idGrupo").empty();
  status = $("#statusG:checked").val();
  clientePj = <?php echo $_SESSION['idClientePj_SS']; ?>;
  gerente = $("#idGerente option:selected").val();
  quantidade = 1;
  retorno = $.ajax({
	url:url,
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente, quantidade:quantidade}   
  });
  retorno.done(function( html ) {
	//  console.log(html);
	  var result = html.split(',');
	
	var a = "Ativos: ";
	var b = "Inativos: ";
	  
	    var config = {
        type: 'pie',
        data: {
            labels: [a +parseInt(result[0]), b +parseInt(result[1])],
            datasets: [{
                backgroundColor: ['green',
                    '#bd3c4b'
                ],
                borderColor: ['green',
                    '#bd3c4b'
                  ],
                data: [parseInt(result[0]), parseInt(result[1])],
            }]
        },
        options: {
            responsive: true,
			showTooltips: false
         }
    };
        var ctx = document.getElementById(x).getContext('2d');
        window.myPie = new Chart(ctx, config);

});
}
grupos("canvas");
grupos("canvas2");


function idiomas(){
 var status, clientePj, retorno;
  
	var url = "<?php echo "modulos/select_idiomas.php"?>";	  
	
  
  $("#grupo_idGrupo").empty();
  status = $("#statusG:checked").val();
  clientePj = <?php echo $_SESSION['idClientePj_SS']; ?>;
  gerente = $("#idGerente option:selected").val();
  quantidade = 1;
  retorno = $.ajax({
	url:url,
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente, quantidade:quantidade}   
  });
  retorno.done(function( html ) {
	  var result = html.split(',');
	
	var a = "Inglês: ";
	var b = "Espanhol: ";
	var c = "Francês: ";
	var d = "PLE: ";
	  
	    var config = {
        type: 'pie',
        data: {
            labels: [a +parseInt(result[1]), b +parseInt(result[0]), c +parseInt(result[2]), d +parseInt(result[3])],
            datasets: [{
                backgroundColor: ['blue',
                    'orange',
                    'green',
                    'rgb(250, 255, 0)',
					'#D2B4DE'
               ],
                borderColor: ['blue',
                    'orange',
                    'green',
                    'rgb(250, 255, 0)',
					'#D2B4DE'
                ],
                data: [parseInt(result[1]), parseInt(result[0]), parseInt(result[2]), parseInt(result[3])],
            }]
        },
        options: {
            responsive: true,
			showTooltips: false
  
        }
    };
        var ctx = document.getElementById('canvas3').getContext('2d');
        window.myPie = new Chart(ctx, config);

});
}
idiomas();


function psa2(x) {
	 var status, clientePj, retorno, resultado, data, data2;
  $("#grupo_idGrupo").empty();
  status = $("#statusG:checked").val();
  clientePj = <?php echo $_SESSION['idClientePj_SS']; ?>;
  gerente = $("#idGerente option:selected").val();
  quantidade = 1;
  retorno = $.ajax({
    url:"<?php echo "modulos/select_psa.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente, quantidade:quantidade, x:x}   
  });
  retorno.done(function( html ) {
	  console.log(html);
	 var result = html.trim(); 
     result = result.substring(",", result.length - 1); 
 	 var result2 = result.split(',');
	 
	 result2.forEach(myFunction);
	 
	 function myFunction(item, index, arr=[]) {
		var result3 = item.split(/\s*:\s*/);
//		console.log(result3);
	
		if (parseInt(result3[0]) == 10) {
	//		alert(result3[0]);
	//		alert(result3[1]);
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
	 }
	  
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
            responsive: true,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: "black",
                    boxWidth: 20,
                    padding: 20
                }
            }
        }
    };
        var ctx = document.getElementById(x).getContext('2d');
        window.myPie = new Chart(ctx, config);

	});
}

psa2("PROFESSOR");
psa2("GESTÃO DO CURSO");
psa2("QUALIDADE DA AULA");
psa2("RESULTADO DO CURSO");
psa2("COMPROMISSO COM O APRENDIZADO");
psa2("NPS - Net Promoter Score");
</script>	

