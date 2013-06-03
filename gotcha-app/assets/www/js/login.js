$(document).ready(function() {
	//alert("login");
	
			
	document.addEventListener("deviceready", onDeviceReady, false);
	
	function onDeviceReady() {
		$("#loginForm").submit(function(event) {
			  $("input[type=submit]").attr("disabled", "disabled");
			
			 event.preventDefault();
			 var u = $("#username").val();
			 var p = $("#password").val();
			 
			 if(u != '' || p != ''){

				 $.ajax({
					 type:"POST",
					 url: "http://skrinpothe.ikdoeict.be/gotcha/validate.php",
					 data: {'username': u, 'password': p},
					 cache:false,
				     success:function(data) {
				         var userId = data;
				         if(userId != -1){
				        	 var url='details.html?'+userId;
				        	 window.location.href = url;
				         }else{
				        	 alert("wrong username/password");
				        	 var url='index.html';
				        	 window.location.href = url;
				         }
				     }
				   });		
				
			 }
			
		 });
	}

	 
	
});
