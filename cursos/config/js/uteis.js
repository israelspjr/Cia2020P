//MARCA QUAL NIVEL (janela) ATUAL
var nivel = 0;

//CAMINHO GLOBAL PARA A PASTA config
var caminhoCfg = '/cursos/config/';
var caminhoImg = '/cursos/images/';

//REFERENCIA DO CLICK, PARA ROLAR A PG AO FECHER O NIVEL
var trNivel = [0];

//VALORES PARA SEREM REFILTRADOS NO DATABLES APÓS ATUALIZAR O NIVEL
var dtb_Pagina, dtb_Buscar, dtb_QtdPagina;

//SETAR A VARIAVEL DE nivel
function contaNivel(soma) {
	if ($.isNumeric(soma)) {
		var novoNivel = parseInt(nivel) + parseInt(soma);
		if (novoNivel < 0)
			novoNivel = 0;
		nivel = novoNivel;
	}
}

//MANDAR CONTEUDO SER IMPRESSO
function imprimirDiv(div, titulo) {
	var opt = {
		mode : 'popup',
		popTitle : titulo,
		extraCss : caminhoCfg+'css/estilo.css'
	};
	$(div).printArea(opt);
}

//REMOVER ACENTOS DE UM SETRING
function removeAcento(strToReplace) {
	str_acento = "áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ";
	str_sem_acento = "aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC";
	var nova = "";
	for (var i = 0; i < strToReplace.length; i++) {
		if (str_acento.indexOf(strToReplace.charAt(i)) != -1) {
			nova += str_sem_acento.substr(str_acento.search(strToReplace.substr(i, 1)), 1);
		} else {
			nova += strToReplace.substr(i, 1);
		}
	}
	return nova;
}

function abrirNivelPagina(e, pagina, atualizaPg, localAtu) {
//	alert(e);

	contaNivel(1);

	trNivel[nivel] = e || undefined;

	$('<div></div>').hide().addClass('camada').css({
		'z-index' : (nivel * 1000) + 1,
		'width' : parseInt(100 - (nivel * 2)) + '%',
		'margin-left' : nivel + '%'
	}).attr('nivel', nivel).data('atualizaPg', atualizaPg).data('localAtu', localAtu).appendTo('#divs_jquery');
	//.fadeIn('fast');

	$('<div></div>').hide().addClass('camada_fundo').css({
		'z-index' : nivel * 1000
	}).attr('nivel', nivel).appendTo('#divs_jquery');
	//.fadeIn('fast');

	carregarModulo(pagina, '.camada[nivel=' + nivel + ']', '{"nivelInteiro":true}');

	eventRolarParaTopo();

}

function showLoad() {

	var divCamada = $('<div></div>').addClass('camadaFundo_load');

	var divLoad = $('<div></div>').html('<center><img class="img_loading" src="' + caminhoImg + 'loading.gif" /></center>');

	$('<div></div>').addClass('camada_load').css({
		'z-index' : (nivel + 1) * 1000
	}).hide().append(divCamada).append(divLoad).appendTo('#divs_jquery').fadeIn('fast');
}

function fecharNivel_load() {
	$('.camada_load').fadeOut('fast', function() {
		$(this).remove();
	});
}

function fecharNivel() {

	var liNivel = $('.camada[nivel=' + nivel + ']');
	var liNivelFundo = $('.camada_fundo[nivel=' + nivel + ']');

	//ATRIBUTOS VINDOS DO NIVEL ACIMA P MANTER FILTRAGEM DO DATATABLES
	dtb_Pagina = liNivel.data('pagina');
	//PAGINA
	dtb_QtdPagina = liNivel.data('qtdPagina');
	//QUANTIDADE POR PAGINA
	dtb_Buscar = liNivel.data('buscar');
	//TEXTO BUSCADO

	var nivelAtu = liNivel.data('atualizaPg');
	var localAtu = liNivel.data('localAtu');

	if (nivelAtu != '' && nivelAtu != undefined) {

		//ATUALIZA DE ACORDO COM OS PARAMETRO PASSADOS
		retornoPadrao(localAtu, nivelAtu);

	}

	//ROLAR A PAGINA ATÉ O ELEMENTO QUE ABRIU O NIVEL
	if (nivel >= 1) {
		$('body,html').animate({
			scrollTop : $(trNivel[nivel]).offset().top - 15
		});
	}

	liNivel.fadeOut('fast', function() {
		$(this).remove();
	});

	liNivelFundo.fadeOut('fast', function() {
		$(this).remove();
	});

	trNivel.splice(nivel, 1);

	contaNivel(-1);

}

function carregarModulo(arquivo, destino, depoisDeCarregar) {

	showLoad();

	if (destino == undefined || destino == '')
		destino = '.camada[nivel=' + nivel + ']';

	$(destino).load(arquivo, function() {

		//JOGAR NIVEL NA FRENTE DAS ABAS
		var conteudo = $('.camada[nivel=' + nivel + ']').find('.conteudo_nivel');
	
		if (conteudo.length > 0)
			conteudo.css('z-index', ('z-index') + 1);//zIndex(parseInt(conteudo.zIndex()) + 1);

		//EXECUTAR APENAS APÓS CARREGAR
		if (depoisDeCarregar != undefined) {
			acaoJson(depoisDeCarregar);
		}

		fecharNivel_load();
	});
}

function viraEditor(id) {
	
	// Remove all editors
	tinymce.remove();

	tinymce.init({
		selector : '#' + id + '_base',
		language : "pt_BR",
		images_upload_url: '/cursos/upload/upload.php',
 	//    images_upload_base_path: '/cursos/upload/outros',
	    images_upload_credentials: true,
				relative_urls : false,
		remove_script_host : false,
		document_base_url : "/cursos/upload/outros",

		
		file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
			if (meta.filetype == 'file') {
      callback('/cursos/upload/upload.php', {text: 'My text'});
    }

    // Provide image and alt text for the image dialog
    if (meta.filetype == 'image') {
      callback('myimage.jpg', {alt: 'My alt text'});
    }

    // Provide alternative source and posted for the media dialog
    if (meta.filetype == 'media') {
      callback('movie.mp4', {source2: 'alt.ogg', poster: 'image.jpg'});
    }
        });
      }
    },
	 plugins: [
    'advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools '
  ],
		toolbar1 : "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect | bullist numlist | undo redo | link unlink | forecolor backcolor | subscript superscript | table | hr removeformat | cut copy paste | print fullscreen code preview | image imagetools",
		menubar : false,
		toolbar_items_size : 'small',
		image_advtab: true,
		 templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
		content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
	});
	$('#' + id).hide();

}

function viraEditor_lacuna(id) {
	
		// Remove all editors
	tinymce.remove();

	tinymce.init({
		selector : '#' + id + '_base',
		language : "pt_BR",
		
		file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onload = function(e) {
            callback(e.target.result, {
              alt: ''
            });
          };
          reader.readAsDataURL(file);
        });
      }
    },
		toolbar1 : "botaoLacuna",
		menubar : false,
		image_advtab: true,
		 templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
		content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  setup : function(editor) {
			editor.addButton('botaoLacuna', {
				text : 'Definir lacuna',
				icon : false,
				onclick : function() {
					if ($.trim(editor.selection.getContent({
						format : 'text'
					})) != '') {
						$('#lacuna_respLacuna:first').val($.trim(editor.selection.getContent({
							format : 'text'
						})));
						editor.insertContent('#_' + $('#ordem').val() + '_#');
						var x = $('#ordem').val();
						x++;
						
						$('#bt_confirmarGravarLacuna').click();
						$('#ordem').val(x);
					}
				}
			});
		}
	});
	$('#' + id).hide();
}

function postForm_editor(editor, idForm, pagina, param, onde) {
	$('#' + editor).val(tinymce.get(editor + '_base').getContent());
	postForm(idForm, pagina, param, onde);
}

function postFileForm(idForm) {

	var form = $('#' + idForm);
	showLoad();

	form.ajaxForm({
		type : 'POST',
		success : function(e) {
			acaoJson(e);
		},
		error : function(data) {
			alerta('Erro durante o processamento');
		},
		complete : function(data) {
			fecharNivel_load();
		}
	}).submit();

}

function postForm(idForm, pagina, param, onde) {
	
	var submitForm;
	
	if (onde != undefined && onde != '') {
		var n = onde.indexOf("#");
		if (n > -1) {
			var ondeR = $(onde);	
		} else {
			var ondeR = $('#' + onde);
		}
	}
	
	if (idForm) {
		var form = $('#' + idForm);
	//} else {
	//	var form = "";	
	//}
	

	if (form.length > 0) {
		form.submit();
	} else {
		submitForm = true;
	}

	//if (submitForm) {
		var parametros = form.serialize() + (param != undefined ? param : '');
		showLoad();
		$.post(pagina, parametros, function(e) {
			if (ondeR != undefined && ondeR != '') {
				$(ondeR).html(e);
			} else {
				acaoJson(e);
			}
			fecharNivel_load();
		}).fail(function() {
			alerta('Erro durante o processamento');
			fecharNivel_load();
		}).always(function() {
			submitForm = false;
		});
	//}
	} else {
		submitForm = true;	
		
		var parametros = (param != undefined ? param : '');
		showLoad();
		$.post(pagina, parametros, function(e) {
			if (ondeR != undefined && ondeR != '') {
				$(ondeR).html(e);
			} else {
				acaoJson(e);
			}
			fecharNivel_load();
		}).fail(function() {
			alerta('Erro durante o processamento');
			fecharNivel_load();
		}).always(function() {
			submitForm = false;
		});	
	}
	return false;

}

function postForm2(idForm, pagina, param, onde) {
	

	var form = /*$('#' +*/ idForm/*)*/;
//	console.log(form);
	if (form.length > 0) {
		form.submit();
	} else {
		submitForm = true;
	}

	if (submitForm) {
		var parametros = ""; //form.serialize() + (param != undefined ? param : '');
		showLoad();
		$.post(pagina, parametros, function(e) {
			if (onde != undefined && onde != '') {
				$(onde).html(e);
			} else {
				acaoJson(e);
			}
			fecharNivel_load();
		}).fail(function() {
			alerta('Erro durante o processamento');
			fecharNivel_load();
		}).always(function() {
			submitForm = false;
		});
	}

	return false;

}

//Atualização para sortear data
(function($) {
 
    function parseFormatToUnix(value, format, locale) {
	    return value === '' || value === null ?
		    -Infinity :
		    parseInt( moment (value, format, locale, true ).format( 'x' ), 10 );
    }

    function getSpecialValueAndFormat(value) {
    
        //Remove tags, then remove \n and whitespaces
        value = value.replace ? value.replace(/<.*?>/g, '').replace(/(\r\n|\n|\r)/gm,'').trim(): value;
    
        if(/^[a-zA-Z]/.test(value.trim())) {
            return {value: value, format: "MMMM YYYY"};
        } else {
            value = value.trim().split(" - ")[0];
            return {value: value, format: "DD/MM/YYYY"};
        }
    }

    $.fn.dataTableExt.oSort['custom-date-asc']  = function(x,y) {
    
        var specialFormatX = getSpecialValueAndFormat(x);
        var specialFormatY = getSpecialValueAndFormat(y);
    
        var parsedX = parseFormatToUnix(specialFormatX.value, specialFormatX.format, "en");
        var parsedY = parseFormatToUnix(specialFormatY.value, specialFormatY.format, "en");
    
        return parsedX - parsedY;
    };
    
    $.fn.dataTableExt.oSort['custom-date-desc'] = function(x,y) {
        var specialFormatX = getSpecialValueAndFormat(x);
        var specialFormatY = getSpecialValueAndFormat(y);
    
        var parsedX = parseFormatToUnix(specialFormatX.value, specialFormatX.format, "en");
        var parsedY = parseFormatToUnix(specialFormatY.value, specialFormatY.format, "en");
    
        return parsedY - parsedX ;
    };
    
}(jQuery));


function tabelaDataTable(idTable, tipo, optAdd) {

	var opt;
	if ( typeof optAdd == 'object') {
		opt = optAdd;
	} else {
		opt = {};
	}

	//OPÇOES PADRAO
	opt.oLanguage = {
		"sUrl" : caminhoCfg + "js/dataTables.ptbr.txt"
	};
	opt.bJQueryUI = true;
	opt.bAutoWidth = true;
	opt.aLengthMenu = [50, 100, -1],[50, 100, "Todos"];
	opt.pageLength = 100;

	if (tipo == 'simples') {

		opt.bPaginate = false;
		opt.bInfo = true;
		opt.bFilter = true;
		opt.aaSorting = [[0, 'desc']];
		opt.pageLength = 100;
		
	} else if (tipo == 'ordenaColuna') {

		opt.bPaginate = true;
		opt.sPaginationType = "full_numbers";
		opt.aaSorting = [[0, 'desc']];
		opt.aoColumnDefs = [{
			"bVisible" : false,
			"aTargets" : [0]
		}];

	} else if (tipo == 'ordenaColuna_psa') {

		opt.bPaginate = false;
		opt.bInfo = false;
		opt.bFilter = false;
		opt.aaSorting = [[0, 'asc']];	
		opt.aoColumnDefs = [{
			"bVisible" : false,
			"aTargets" : [0]
		}];	

	}else if (tipo == 'ordenaColuna_simples') {

		opt.bPaginate = false;
		opt.bInfo = false;
		opt.bFilter = false;
		opt.aaSorting = [[0, 'desc']];
		opt.aoColumnDefs = [{
			"bVisible" : false,
			"aTargets" : [0]
		}];

	} else if (tipo == 'config') {

		opt.bPaginate = true;
		opt.sPaginationType = "full_numbers";
		opt.aoColumnDefs = [{
			"bVisible" : false,
			"aTargets" : [0]
		}];

	}else if (tipo == 'colspan'){
		opt.bPaginate = false;
		opt.bInfo = false;
		opt.bFilter = false;
		orderCellsTop = true;
		
	} else if(tipo == 'fixo') {
		opt.bPaginate = false;
		opt.bInfo = true;
		opt.bFilter = true;
		opt.aaSorting = [[0, 'desc']];
		opt.pageLength = 100;
		opt.stateSave = true;
	} else {

		opt.bPaginate = true;
		opt.sPaginationType = "full_numbers";

	}

	var $table = $('#' + idTable);
	var oTable = $table.dataTable(opt);
	
	carregaParametros($table);

	$table.find('tr').off('click').on('click', function() {

		var oSettings = oTable.fnSettings();

		var dtb_Pagina = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength);
		var dtb_Buscar = oSettings.oPreviousSearch.sSearch;
		var dtb_QtdPagina = oSettings._iDisplayLength;

		$('.camada[nivel=' + nivel + ']').data('pagina', dtb_Pagina);
		$('.camada[nivel=' + nivel + ']').data('buscar', dtb_Buscar);
		$('.camada[nivel=' + nivel + ']').data('qtdPagina', dtb_QtdPagina);

	});

}

function carregaParametros($table) {

	if ($table.length > 0) {

		var oCarrega = $table.dataTable();

		var temReg = oCarrega.fnSettings().fnRecordsTotal();

		if (temReg > 0 && dtb_Buscar != undefined && dtb_Buscar != '')
			oCarrega.fnFilter(dtb_Buscar);

		if (temReg > 0 && dtb_Pagina != undefined && dtb_Pagina != '' && dtb_QtdPagina != undefined && dtb_QtdPagina != '') {
			oCarrega._iDisplayLength = parseInt(dtb_QtdPagina);
			oCarrega.fnPageChange(parseInt(dtb_Pagina));
		}

	}

	zeraParametros();

}

function zeraParametros() {
	dtb_Buscar = '';
	dtb_QtdPagina = 0;
	dtb_Pagina = 0;
}

function abrirFormulario(div, img, apenasFecha) {
	var obj_div = $('#' + div);
	if (img != undefined && img != '')
		var obj_img = $('#' + img);

	if (obj_div.css('display') == "block") {
		if (obj_img != undefined)
			obj_img.attr('src', caminhoImg + 'mais.png');
		obj_div.slideUp();
	} else {
		if (obj_img != undefined)
			obj_img.attr('src', caminhoImg + 'menos.png');
		obj_div.slideDown();
	}
}

function deletaRegistro(arquivoDeleta, idDeletar, arquivoListar, destinoListar) {
	if (idDeletar == undefined) {
		alert('Não é possível deletar.');
	} else {
		if (confirm('Deseja realmente excluir esse registo? \n\n Observação: Todos seus vínculos também serão removidos(esse processo é irreversível).')) {
			showLoad();
			$.post(arquivoDeleta, {
				acao : "deletar",
				id : idDeletar
			}, function(e) {
				if (destinoListar == '')
					destinoListar = '.camada[nivel=' + parseInt(nivel) + ']';
				//SE NÃO DEFINIR O LOCAL, ATUALIZARÁ O NIVEL INTEIRO
				retornoPadrao(destinoListar, arquivoListar);
				acaoJson(e);
				fecharNivel_load();
				return false;
			});
		}
	}
}

function acaoJson(val) {

	if (val !== undefined && val !== '') {

		var jsonR = $.parseJSON(val);
		
		//EXPORTA P EXCEL 
		if (jsonR.excel != '' && jsonR.excel != undefined) {
			window.open('data:application/vnd.ms-excel;charset=iso-8859-1, ' + encodeURIComponent(jsonR.excel));
		}

		//ATUALIZAR APENAS A LINHA
		if (jsonR.tabela != '' && jsonR.tabela != undefined && jsonR.ordem != '' && jsonR.ordem != undefined) {

			var oUpdate = $(jsonR.tabela).dataTable();

			if (jsonR.updateTr == '' || jsonR.updateTr == undefined || jsonR.updateTr == null) {

				//deleta
				oUpdate.fnSettings().aoData[ parseInt(jsonR.ordem)].nTr.hidden = true;

			} else {

				oUpdate.fnUpdate(jsonR.updateTr, parseInt(jsonR.ordem));

			}

		}

		//ADICIONAR UMA LINHA
		if (jsonR.addLinha != undefined && jsonR.addLinha == true) {
			if (jsonR.tabela != '' && jsonR.tabela != undefined && jsonR.updateTr != '' && jsonR.updateTr != undefined) {

				var oTb = $(jsonR.tabela).dataTable();
				var a = oTb.fnAddData(jsonR.updateTr);
				var oRow = oTb.fnSettings().aoData[a[0]].nTr;

				if (jsonR.class != '' && jsonR.class != undefined)
					oRow.className = jsonR.class;

				if (jsonR.align != '' && jsonR.align != undefined)
					oRow.align = jsonR.align;

			}
		}

		//NOVO AVISO
		if (jsonR.novoAviso == true)
			novoAviso();

		//ENVIA MENSAGEM
		if (jsonR.mensagem != undefined && jsonR.mensagem != '') {
			alerta(jsonR.mensagem);
		}

		//PAGINA A SER CARREGADA
		if (jsonR.pagina != '' && jsonR.pagina != undefined) {

			//ATUALIZAR NIVEL INTEIRO
			if (jsonR.atualizarNivelAtual === true) {
				if (jsonR.depoisDeCarregar) {
					//alert( jsonR.depoisDeCarregar );
					carregarModulo(jsonR.pagina, '.camada[nivel=' + nivel + ']', jsonR.depoisDeCarregar);
				} else {
					carregarModulo(jsonR.pagina, '.camada[nivel=' + nivel + ']');
				}
			}

			//ATUALIZAR ELEMENTO ESPECIFICO
			if (jsonR.ondeAtualizar != '' && jsonR.ondeAtualizar != undefined)
				retornoPadrao(jsonR.ondeAtualizar, jsonR.pagina);

		}

		if (jsonR.nivelInteiro != undefined && jsonR.nivelInteiro === true)
			$('.camada[nivel=' + nivel + '], .camada_fundo[nivel=' + nivel + ']').fadeIn('fast');

		//VALOR A SER CARREGADO - DEVE SER UM ARRAY DE VALORES
		if (jsonR.valor != undefined) {
			for (var i = 0, j = jsonR.valor.length; i < j; i++) {
				//ELEMENTO ONDE SERA CARREGADO O ARRAY .val()
				if (jsonR.campoAtualizar[i] != '' && jsonR.campoAtualizar[i] != undefined)
					$(jsonR.campoAtualizar[i]).val(jsonR.valor[i]);
			}
		}

		//VALOR A SER CARREGADO - DEVE SER UM ARRAY DE VALORES
		if (jsonR.valor2 != undefined) {
			for (var i = 0, j = jsonR.valor2.length; i < j; i++) {
				//ELEMENTO ONDE SERA CARREGADO O ARRAY .html()
				if (jsonR.elementoAtualizar[i] != '' && jsonR.elementoAtualizar[i] != undefined)
					$(jsonR.elementoAtualizar[i]).html(jsonR.valor2[i]);
			}
		}

		//CLICAR NA ABA OU OTROS
		if (jsonR.mudarAba != '' && jsonR.mudarAba != undefined)
			$(jsonR.mudarAba).click();

		//FECHAR O NIVEL ATUAL
		if (jsonR.fecharNivel != undefined && jsonR.fecharNivel != '') {
			if (jsonR.fecharNivel === true) {
				fecharNivel();
			} else if (parseInt(jsonR.fecharNivel) && jsonR.fecharNivel > 0) {
				for (var x = 0; x < jsonR.fecharNivel; x++)
					fecharNivel();
			}
		}

	}
}

function geraSenha(obj, obj2) {
	
	var text = redefSenha();
	
	$('#' + obj).val(text);
	$('#' + obj2).val(text);

	alerta('Nova senha gerada.');
}

function redefSenha() {
	var text = "";
	var possible = "abcdefghijklmnopqrstuvwxyz0123456789@#!?";

	for (var i = 0; i < 8; i++) {
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	}

	return text;
}


function alerta(msg) {

	if (msg != undefined && $.trim(msg) != '') {

		var $alertas, segundos = 0, len;

		len = msg.length;

		segundos = len * 50;
		if (segundos < 3000)
			segundos = 3000;

		mostraDivAlerta();

		$('<div ></div>').addClass('alerta').html(msg).appendTo('#alertas').fadeIn(500).delay(segundos).fadeOut(500, function() {
			escondeDivAlerta();
			$(this).remove();
		});
	}

}

function verificaNovoAviso(caminho) {

	$.post(caminho, function(e) {
		acaoJson(e);
	});

	setTimeout(function() {
		verificaNovoAviso(caminho);
	}, 60000);

}

function novoAviso() {
	mostraDivAlerta();
	$('<div ></div>').addClass('novoAviso').html('Você têm novo(s) aviso(s)').fadeIn(500, function() {
		var $obj = $(this);
		setTimeout(function() {
			$obj.fadeOut(500, function() {
				escondeDivAlerta();
				$(this).remove();
			});
		}, 5000);
	}).appendTo('#alertas');
}

function enviarSenha(senha, doc, origem) {
	var valor = $(doc).val();
	if (valor == undefined || valor == null || valor == '') {
		$(doc).focus();
		alerta('Preencha o documento principal.');
	} else {
		postForm('', '/cursos/'+origem+'/recuperaSenha.php', 'senha=' + senha + '&doc=' + valor + '&origem=' + origem,'#div_login');
	}
}

function abrirLink(link) {
	window.open(link);
}

function retornoPadrao(onde, pg) {

	if (onde == 'tr') {

		postForm2('', pg);
		//ATUALIZARA APENAS A LINHA

	} else if (pg == 'click') {

		$(onde).click();
		//CLICAR EM UM ELEMENTO

	} else {

		if (onde == '')
			onde = '.camada[nivel=' + parseInt(nivel - 1) + ']';
		//SE NÃO DEFINIR O LOCAL, ATUALIZARÁ O NIVEL INTEIRO
		carregarModulo(pg, onde);
		//ATUALIZARA TODA TB

	}
}

function tipoDocumentoUnico(form) {

	var eForm = $('#' + form);

	var tipoDocumentoUnico = eForm.find('#tipoDocumentoUnico_idTipoDocumentoUnico');
	var documentoUnico = eForm.find('#documentoUnico');

	if (tipoDocumentoUnico.val() != '' && tipoDocumentoUnico.val() != undefined) {
		var novaClass = tipoDocumentoUnico.find('option').filter(':selected').attr('item');
		tipoDocumentoUnico.find('option[item]').filter(':not(:selected)').each(function() {
			documentoUnico.removeClass($(this).attr('item'));
		});
		documentoUnico.addClass(novaClass);
	}
	//ativarForm();
}

function filtro_postForm(clicar, idForm, pagina, param, onde) {
	postForm(idForm, pagina, param, onde);
	$('#' + clicar).click();
}

function postForm_relatorio(img, obrigatorio, form, pagina, onde) {

	var valor;

	if (obrigatorio != undefined && obrigatorio != '') {

		var $tipo = $('input[type=radio][name=' + obrigatorio + ']');

		if ($tipo.length > 0) {
			valor = $tipo.filter(':checked').val();
			if (valor == '' || valor == undefined) {
				alerta('Escolha o tipo do relatório');
				return false;
			}
		}

		var $select = $('select#' + obrigatorio);

		if ($select.length > 0) {
			var valor = $select.find(':selected').val();
			if (valor == '' || valor == undefined) {
				alerta('Selecione os campos que aparecerão no relatório');
				return false;
			}
		}

	}

	filtro_postForm(img, form, pagina, '', onde);
	eventRolarParaTopo();

}

function selecionaTudoSelect() {
	var arg = arguments.length;
	for (var i = 0; i < arg; i++)
		$('#' + arguments[i]).find('option').attr('selected', true);

}

function addIten(de, para) {
	var valor, texto;
	$(de + ' option:selected').each(function() {
		valor = $(this).val();
		texto = $(this).html();
		$(para).append($('<option>').text(texto).val(valor));
		$(this).remove();
	});
}

function addItenPersonalizado(de, para) {
	var texto;
	$(para + ' option').each(function() {
		$(this).remove();
	});

	$(de + ' option').each(function() {
		texto = $(this).html();
		$(para).append($('<option>').val(texto).text(texto));
	});
}

function mostraDivAlerta() {
	$('#alertas').css({
		'z-index' : (nivel * 1000) + 10
	});
}

function escondeDivAlerta() {

	if ($('.alerta').length <= 1)
		$('#alertas').delay(500).css({
			'z-index' : 0
		});
}

function ajax(url){
	req = null;
	if(window.XmlhttpRequest){
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
		req.send(null);
	}else if(window.ActiveXObject){
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if(req){
		req.onreadystatechange = processReqChange;
		req.open("GET", url, true);
		req.send();
		}
	}			
}

function processReqChange(){
	if(req.readyState == 4){
		if(req.status == 200){
			$("#nomeList").append = req.responseText;			
		}else{
			alerta("Houve um problema ao realizar a solicitação. Tente de novo mais tarde. Caso o erro persista entre em contato com o suporte");
		}
	}
}

function mostrarTitle($origem) {

	var top = $($origem).offset().top + $($origem).height();
	var left = $($origem).offset().left + $($origem).width();
	var txt = $($origem).attr('mostrarTitle');

	var $divExcluir = $('<div></div>').html('<strong>[x]</strong>').css({
		'float' : 'left',
		'cursor' : 'pointer'
	}).on('click', function() {
		$('.mostrarTitle').remove();
	});
	var $divConteudo = $('<div></div>').html(txt).css({
		'padding-left' : '1.5em'
	});

	$('<div></div>').addClass('mostrarTitle').css({
		'top' : top + 'px',
		'left' : left + 'px'
	}).append($divExcluir).append($divConteudo).appendTo('body');
}

// Cores demonstrativo
function changeStyle(var1, var2) {

 $('#TRstyle'+var1).css('background-color', var2);
}


zeraParametros();

function enviadoOK() {
	alert("Conteúdo inserido/alterado com sucesso!");
}

function fecharMenu(x) {
	if (x == 0) {
$('#sidebar-collapse').hide();
$('#img_form_Menu').attr("onclick", "fecharMenu(1)");
//abrirFormulario('menu_area', 'img_form_Menu')";
$('.main').css("width", "100%");
$('.col-lg-10').css("margin-left","15px");
$('.col-lg-10').css("max-width","100%");
$('.col-lg-10').css("float","none");
$('#menu_area').show();
	} else {
$('#sidebar-collapse').show();	
$('#img_form_Menu').attr("onclick", "fecharMenu(0)");
//abrirFormulario('menu_area', 'img_form_Menu')");
$('.main').css("width", "");
$('.main').css("margin-left","");
$('.col-lg-10').css("max-width","70%");
$('.col-lg-10').css("float","right");

$('#menu_area').show();
	}
}

function Encripta(dados){
	var mensx="";
	var l;
	var i;
	var j=0;
	var ch;
	ch = "assbdFbdpdPdpfPdAAdpeoseslsQQEcDDldiVVkadiedkdkLLnm";	
	for (i=0;i<dados.length; i++){
		j++;
		l=(Asc(dados.substr(i,1))+(Asc(ch.substr(j,1))));
		if (j==50){
			j=1;
		}
		if (l>255){
			l-=256;
		}
		mensx+=(Chr(l));
	}
	return mensx;
}


function Asc(String){
	return String.charCodeAt(0);
}
 
function Chr(AsciiNum){
	return String.fromCharCode(AsciiNum)
}

function Descripta(dados){
	var mensx="";
	var l;
	var i;
	var j=0;
	var ch;
	ch = "assbdFbdpdPdpfPdAAdpeoseslsQQEcDDldiVVkadiedkdkLLnm";	
	for (i=0; i<dados.length;i++){
		j++;
		l=(Asc(dados.substr(i,1))-(Asc(ch.substr(j,1))));
		if (j==50){
			j=1;
		}
		if (l<0){
			l+=256;
		}
		mensx+=(Chr(l));
	}	
	return mensx;
}