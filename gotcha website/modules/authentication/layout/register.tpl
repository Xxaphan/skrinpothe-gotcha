<section id="sectionBox" class="clearfix">
<div class="box" id="boxLogin">
	
	<h2>Please register</h2>


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
		<form action="{$registerUrl|htmlentities}" method="post">
			<fieldset>
				<dl class="clearfix columns">

					<dt<label for="lastname">Last Name:</label></dt>
					<dd><input type="text" name="lastname" id="lastname" value="" /></dd>
					<dt><label for="firstname">First Name:</label></dt>
					<dd><input type="text" name="firstname" id="firstname" value="" /></dd>

					<dt<label for="email">Email:</label></dt>
					<dd><input type="text" name="email" id="email" value="" /></dd>
					<dt><label for="cellphone">Cellphone:</label></dt>
					<dd><input type="text" name="cellphone" id="cellphone" value="" /></dd>

					<dt<label for="username">Username:</label></dt>
					<dd><input type="text" name="username" id="username" value="" /></dd>
					<dt><label for="password">Password</label></dt>
					<dd><input type="text" name="password" id="password" value="" /></dd>					

					<dd>
						<label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Register" /></label>
						<input type="hidden" name="formAction" id="formAction" value="register" />
					</dd>
				</dl>
			</fieldset>
		</form>
		
	</div>
	
</div>
</section>