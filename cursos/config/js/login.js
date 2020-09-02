
function mostraSenha(e){
	if( $(e).is(':checked') ){
		$('#password').attr('type', 'text');
	}else{
		$('#password').attr('type', 'password');
	}
}
