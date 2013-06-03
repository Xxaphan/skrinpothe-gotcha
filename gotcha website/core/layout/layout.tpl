<!DOCTYPE html>
<html>
<head>
	
	<title>{$pageTitle}</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="core/css/style.css" />	
	{$pageMeta}
	
	
</head>
<body>
        <div id="siteWrapper" class="clearfix">
		
		<!-- header -->
		<header>			
			<h1><a href="index.php?module=home">{$pageTitle}</a></h1>   
			<nav id="menu">
				<a href="index.php?module=home" title="home">Home</a>
				<a href="index.php?module=events&amp;view=events" title="events">Events</a>
				<a href="index.php?module=users&amp;view=myprofile" title="profile">Profile</a>
				<a href="index.php?module=users&amp;view=list" title="profile">Members</a>
				<a href="#">Contact</a>
				<a href="#">FAQ</a>
			</nav>   
                        <div id="loginLogout">
                            {option:oNotLogged}
                            <p>
                            <a href="index.php?module=authentication">login</a>
                            </p>
                            {/option:oNotLogged}
                            {option:oLogged}
                            <p>Welkom {$username}<br /><a href="index.php?module=authentication&amp;view=logout">logout</a></p>               
                            {/option:oLogged}
                        </div>
		<header>   
                     
        <!-- content -->
		<section id="content">			
			{$pageContent}			
		</section>        
		
		<!-- footer -->
		<footer>
		
		</footer>
		
	</div>
    
    
	
</body>
</html>
