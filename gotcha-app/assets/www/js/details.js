$(document).ready(function() {
	alert("details");
			
	document.addEventListener("deviceready", onDeviceReady, false);
	
	function onDeviceReady() {
		var id = window.location.search;
		if (id.substring(0, 1) == '?') {
		    id = id.substring(1);
		  }
		getUsername(id);
	}
		
	function getUsername(id){		
		
		$.getJSON(
				"http://skrinpothe.ikdoeict.be/gotcha/api.php?method=get&format=json&id=1", function(data){
				    console.debug(data);
				    var username = data.body.username;
		            console.debug(username);
		            $("#who").append("<h3> Logged in as: " +username+"</h3>");
		            getTargetId(id);
				}
				);
		
	}
	 
	function getTargetId(id) {
		//alert("id: " + id);
		$.getJSON(
				"http://skrinpothe.ikdoeict.be/gotcha/api.php?method=selecttarget&format=json&id=1", function(data){
				    console.debug(data);
				    var target = data.body.target;	
			//	    alert(target);
				    getTargetPosition(target);
				});
	}
	
	function getTargetPosition(target) {
		//alert("target: " + target);
		$.getJSON(
				"http://skrinpothe.ikdoeict.be/gotcha/api.php?method=selecttargetinfo&format=json&id=1", function(data){
				    console.debug(data);
				    var targetname = data.body.username;
				    var longt = data.body.longti;
				    var lati = data.body.lati;
				    
				    console.debug(targetname);
				    console.debug(longt);
				    console.debug(lati);
		            $("#details").append("<ul><li> Targetname: " +targetname+"</li>" +
		            		"<li> Longtitude: " +longt+"</li>" +
		            				"<li> Latittude: " +lati+"</li></ul>");
		            var myLatlng = new google.maps.LatLng(lati,longt);
		            var mapOptions = {
		            	    zoom: 18,
		            	    center: myLatlng,
		            	    mapTypeId: google.maps.MapTypeId.HYBRID
		            	  };
		            	  var map = new google.maps.Map(document.getElementById('googleMap'),
		            	      mapOptions);
		            	  
		            	  var marker = new google.maps.Marker({
		            	      position: myLatlng,
		            	      map: map,
		            	      title: 'Target Spotted!'
		            	  });
		            
		            });
	}
	
});
