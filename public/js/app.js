$(function(){

	$('.admin-block-card').on('click',()=>{
		$('.admin-block-card').removeClass('card-active');
		$(this).addClass('card-active');
	});
	$('form[name="adrForm"] button[type="submit"]').on('click',function(e){
		e.preventDefault();
		//console.dir(JSON.stringify(document.forms['adrForm']));
		$.post('/address/set',$(document.forms['adrForm']).serialize(),function(data,status){
			console.dir(status);
			$('.form-block').fadeOut();
			adrGet();
		});
	});
	$('.container button[name="test"]').on('click',function(e){
		e.preventDefault();
		adrGet();
	});
    $('.container button[name="edit"]').on('click',function(e){
        e.preventDefault();
        let card = document.querySelector('.admin-container .card-active');
        if(card) {
            let fg = document.querySelector('.address-form-block');
            fg.querySelector('p[name="id"]').innerText = card.querySelector('div[name="id"] p').innerText;
            fg.querySelector('input[name="code"]').value = card.querySelector('div[name="code"] p').innerText.slice(0, card.querySelector('div[name="code"] p').innerText.length - 1);
            fg.querySelector('input[name="country"]').value = card.querySelector('div[name="country"] p').innerText.slice(0, card.querySelector('div[name="country"] p').innerText.length - 1);
            fg.querySelector('input[name="city"]').value = card.querySelector('div[name="city"] p').innerText.slice(0, card.querySelector('div[name="city"] p').innerText.length - 1);
            fg.querySelector('input[name="region"]').value = card.querySelector('div[name="region"] p').innerText.slice(0, card.querySelector('div[name="region"] p').innerText.length - 1);
            fg.querySelector('input[name="street"]').value = card.querySelector('div[name="street"] p').innerText.slice(0, card.querySelector('div[name="street"] p').innerText.length - 1);
            fg.querySelector('input[name="appartment"]').value = card.querySelector('div[name="appartment"] p').innerText.slice(0, card.querySelector('div[name="appartment"] p').innerText.length - 1);
            $('.address-form-block').fadeIn();
        }
    });
    $('.container button[name="delete"]').on('click',function(e){
        e.preventDefault();
        sendToServer({
            url: '/address/del',
            method: 'POST',
            headers: {},
            data: {id:this.parentNode.parentNode.children['id'].innerHTML},
            callback: function(response){
                adrGet();
            }
        });
    });
	$('.address-form-block button[name="apply"]').on('click',(e)=>{
		e.preventDefault();
		let data = {};
		data.id = $('.address-form-block p[name="id"]').text();
        $('.address-form-block input').serializeArray().map(e=>data[e.name] = e.value);
		console.dir(JSON.stringify(data));
		sendToServer({
            url: '/address/update',
			method: 'POST',
			headers:{},
			data : data,
			callback: (response)=>{

			},
        });
	});
	$('.login').on('click',function(e){
		e.preventDefault();
		$('div[name="loginForm"]').fadeToggle();
        document.querySelector('.alarm-login, .alarm-register').innerHTML = '';
	});
	$('.register').on('click',function(e){
		e.preventDefault();
		$('div[name="registerForm"]').fadeToggle();
        document.querySelector('.alarm-login, .alarm-register').innerHTML = '';
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
					var response = JSON.parse(this.responseText);
					if (response.err !== null) document.querySelector('.alarm-login, .alarm-register').innerHTML = response.err;
					else window.location.href = '';
				}
			};
			xhttp.open("POST", '/' + ref, true);
			xhttp.setRequestHeader('Content-Type', 'application/json');
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
	$('.modalYesNo .marys-btn').on('click',(e)=>{
		e.preventDefault();$('.modalYesNo').fadeToggle(100);
	});
	
	//adrGet();
	responsive();
	$(window).on('resize orientationchange',function(){responsive();});
});
function responsive()
{
	const winh = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    const winw = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    const screenProp = winw/winh;
	
	//if($('body').outerHeight() < winh)$('body').outerHeight(winh);
	//else $('body').outerHeight($('html').outerHeight());
}
function adrGet()
{
	$.ajax({
		type: 'GET',
		url: '/address/get',
		success:function(data){
			$('.admin-container').html(data);
			$('.admin-container .admin-block-card').on('click',function(){
                $('.admin-block-card').removeClass('card-active');
                $(this).addClass('card-active');
			});
		}
	});
}
/************************************************************************
* MODAL CRUD FORM
* **********************************************************************
 * @data{
 * 			url: string,
 * 		 method: get|post,
 * 		 params: json,
 * 	    headers: json,
 * 	       data: json,
 * 	   callback: function
 * 		}
 * */
let sendToServer = function(data){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) data.callback(this.responseText);
        else data.callback(null);
    };
    let strParams = (typeof data.params === 'object' && data.params.length)?'?':'';
    for (el in data.params) strParams += el + '=' + data.params[el];
    xhttp.open(data.method, 'http://marys.com.ua/' + data.url + strParams, true);
    xhttp.setRequestHeader('Content-Type', 'application/json');
    for (h in data.headers) xhttp.setRequestHeader(h,data.headers[h]);
    xhttp.send(JSON.stringify(data.data));
};