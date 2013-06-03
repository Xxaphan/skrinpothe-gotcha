$(document).ready(function() {
	//alert("Geolocation");
		
	document.addEventListener("deviceready", onDeviceReady, false);
	
	var longt;
	var lat;
	var user = 1;
	var geo = cordova.require('cordova/plugin/geolocation');
	
	
	function onDeviceReady() {
	   setInterval(function(){
		   var options = { enableHighAccuracy:true, timeout: 60000 };
		   
		   var watchID = geo.watchPosition(onSuccess, onError,options);
		   
		   function onSuccess(position) {
			   longt = position.coords.longitude;
			   lat = position.coords.latitude;
			   
			   pushToDB();
			   
			   
			   if(watchID != null){
				   geo.clearWatch(watchID);
		           watchID = null;
			   }
			}
			
			function onError(error) {
				if(watchID != null){
					   geo.clearWatch(watchID);
			           watchID = null;
				   }
			}
			
			function pushToDB(){
				
				$.ajax({
					type:"POST",
					url: "http://skrinpothe.ikdoeict.be/gotcha/insertLocation.php",
					data: {'longt': longt, 'lat': lat, 'userid':user},
					cache: false,
					succes: function() {
					}
				});
			}
	   }, 10000);

	}	
	
});
