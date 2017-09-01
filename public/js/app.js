$(function(){
	
	$('form[name="adrForm"] button[type="submit"]').on('click',function(e){
		e.preventDefault();
		//console.dir(JSON.stringify(document.forms['adrForm']));
		$.post('/address/set',$(document.forms['adrForm']).serialize(),function(data,status){
			console.dir(status);
			$('.form-block').slideToggle();
			adrGet();
		});
	});
	$('#adrGet').on('click',function(e){
		e.preventDefault();
		adrGet();
	});
	$('.login').on('click',function(e){
		e.preventDefault();
		$('div[name="loginForm"]').fadeToggle();
	});
	$('.register').on('click',function(e){
		e.preventDefault();
		$('div[name="registerForm"]').fadeToggle();
	});
	$('.auth').on('submit', function (e) {
		e.preventDefault();
		var data = {name:"none"};
		var inputs = this.getElementsByTagName('input');
		for(var i = 0; i < inputs.length; i++){
			data[inputs[i].name] = inputs[i].value;
			//console.log(inputs[i].name + ' ' +inputs[i].value + ' ' +data[inputs[i].name]);
		}
		var ref, host = 'http://marys.com.ua/';
		ref = (inputs.length > 2) ? 'register' : 'login';
		if(!verify(data,ref)) return false;
		if(data.cpassword)data.cpassword = null;
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState === 4 && this.status === 200) {
					console.dir(this.responseText);
					//if(this.responseText.err){
					var response = JSON.parse(this.responseText);
					//if (response.err !== null) document.querySelector('#alarm').innerHTML = response.err;//}
					//else window.location.href = href;
				}//	else console.dir(this.responseText);
			};
			xhttp.open("POST", host + ref, true);
			//xhttp.setRequestHeader('Authorization', 'Basic ' + data['email'] + ':' + data['pwd'])
			xhttp.setRequestHeader('Content-Type', 'application/json');
			//console.log(JSON.stringify(data));
			//console.dir(JSON.stringify(data));
			xhttp.send(JSON.stringify(data));
		function verify(data,ref){
			var err = null;
			for(i in data)
			{
				if(data[i].length < 3) {err="Please check " + ((i == "pwd")?'password':i) + ". It should be more 2 symbols.";break}
				if(data[i].length > 50) {err="Please check " + ((i == "pwd")?'password':i) + ". It should be less 50 symbols.";break}
				if(!data[i].match( /[a-zA-Z0-9@_.]/ )){err="Please check " + ((i == "pwd")?'password':i)
					+ ". It should consist of digits 0-9, characters a-z A-Z, may be symbols @_.";break}
			}
			if(!data.email.match( /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/ ))
			err="Please check email.";
			if(data.password.length < 6) err="Password should be more 6 symbols.";
			if(inputs.length > 2)
				if(data.password !== data.cpassword)err = "Password isn't equal to confirm password.";
			if(err) {document.querySelector('.alarm-' + ref).innerHTML = err;console.log(err); return false}
			return true;
			};
	});
	
	//adrGet();
});
function adrGet()
{
	$.ajax({
		type: 'GET',
		url: '/address/get',
		success:function(data){
			//console.log(data);
			$('.ref-list tbody').html(data);
			$('.ref-list .btn-delete').on('click',function(e){
				e.preventDefault();
				$.post('/address/del',{id:this.parentNode.parentNode.children['id'].innerHTML},
				function(data){
					console.dir(data);
					adrGet();
				});
			});
		}
	});
};