$(document).ready(function() {	
	alert("myApp");
	document.addEventListener("deviceready", onDeviceReady, false);
	
	function checkPreAuth() {
		alert("checkPreAuth");
	    var form = $("#loginForm");
	    if(window.localStorage["username"] != undefined && window.localStorage["password"] != undefined) {
	        $("#username", form).val(window.localStorage["username"]);
	        $("#password", form).val(window.localStorage["password"]);
	        handleLogin();
	    }
	}

	function handleLogin() {
	    var form = $("#loginForm");    
	    //disable the button so we can't resubmit while we wait
	    $("#submitButton",form).attr("disabled","disabled");
	    var u = $("#username", form).val();
	    var p = $("#password", form).val();
	    console.log("click");
	    if(u != '' && p!= '') {
	        $.post("http://192.168.0.134/service/Webservice/Webservice/WebServiceGotcha.asmx?op=login&returnformat=json", {uname=u&pwd=p}, function(res) {
	            if(res == true) {
	                //store
	                window.localStorage["username"] = u;
	                window.localStorage["password"] = p;             
	                $.mobile.changePage("some.html");
	            } else {
	                navigator.notification.alert("Your login failed", function() {});
	            }
	         $("#submitButton").removeAttr("disabled");
	        },"json");
	    } else {
	        //Thanks Igor!
	        navigator.notification.alert("You must enter a username and password", function() {});
	        $("#submitButton").removeAttr("disabled");
	    }
	    return false;
	}

	function onDeviceReady() {
	    
	$("#loginForm").on("submit",handleLogin);

	}
		
	function geolocation() {
		var options = { enableHighAccuracy:true, timeout: 60000 };
	    var geo = cordova.require('cordova/plugin/geolocation');
	    geo.watchPosition(onSuccess, onError,options);
	}
	
	function onSuccess(position) {
	    document.getElementById('geolocation').innerHTML = "Latitude:  " + position.coords.latitude  + "</br>" +
	    												   "Longitude: " + position.coords.longitude;
	}
	
	function onError(error) {
		document.getElementById('geolocation').innerHTML = "code:  " + error.code + "</br>" +
		   												   "message: " + error.message;
	}
	
	
		
});




