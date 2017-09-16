window.fbAsyncInit = function() {
    FB.init({
        appId      : '170302263538571',
        xfbml      : true,
        version    : 'v2.10'
    });
    //FB.AppEvents.logPageView();
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    let btnFB = document.querySelector('#btnFB');
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        btnFB.innerText = btnFB.querySelector('span').innerText;
        window.res = response;
    }
}
function loginFB()
{
    if(window.hasOwnProperty('res') && window.res.status === 'connected')
    {
        console.log('press LoginFB');
        FB.api("/" + window.res.authResponse.userID + "?fields=email,friends,name&access_token="+
            window.res.authResponse.accessToken,
            function (response) {
            console.dir(response);
                if (response && !response.error) {
                    /* handle the result */
                    //console.dir(response);
                }
            });
    }else{
        FB.login(function(response) {
            // handle the response
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                console.dir(response);
                FB.api("/" + response.authResponse.userID + "/friendlists",
                    function (response) {
                        if (response && !response.error) {
                            /* handle the result */
                            console.dir(response);
                        }
                    });
            } else {
                // The person is not logged into this app or we are unable to tell.
            }
        }, {scope: 'public_profile,email,user_friends'});
    }
}