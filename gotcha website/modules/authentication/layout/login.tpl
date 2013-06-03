<section id="sectionBox" class="clearfix">
<div class="box" id="boxLogin">
	
	<h2>Please login</h2>


{option:oErrors}
<div class="box" id="boxError">
	<p>One or more errors occured whilst processing your action:</p>
	<ul class="errors">
		{iteration:iErrors}
		<li>{$error|htmlentities}</li>
		{/iteration:iErrors}
	</ul>	
</div>
{/option:oErrors}
	
	
	<div class="boxInner">
		<form action="{$formUrl|htmlentities}" method="post">
			<fieldset>
				<dl class="clearfix columns">
					<dt<label for="username">Username:</label></dt>
					<dd><input type="text" name="username" id="username" value="" /></dd>
					<dt><label for="password">Password</label></dt>
					<dd><input type="password" name="password" id="password" value="" /></dd>
					<dd>
						<label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Log in" /></label>
						<input type="hidden" name="formAction" id="formAction" value="login" />                                                
					</dd>
                                        <dt>Not yet a member? <a href="index.php?module=authentication&amp;view=register" title="home">Click here to register!</a></dt>
				</dl>
			</fieldset>
		</form>
		
	</div>
	
</div>
</section>