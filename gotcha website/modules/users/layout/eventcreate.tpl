<section id="sectionBox" class="clearfix">    
    <h2>Create Event</h2>
    <form action="{$formUrl|htmlentities}" method="post">
        <fieldset>
            <dl class="clearfix columns">
                <dt<label for="eventname">Event Name:</label></dt>
                <dd><input type="text" name="eventname" id="eventname" value="" /></dd>
                <dt><label for="eventmaker">Event Maker:</label></dt>
                <dd><input type="text" name="eventmaker" id="eventmaker" value="" /></dd>
                <dt<label for="email">Your Email:</label></dt>
                <dd><input type="text" name="email" id="email" value="" /></dd>

                <dt><label for="contester1">Contester1:</label></dt>
                <dd><input type="text" name="contester1" id="contester1" value="" /></dd>
                <dt<label for="contester2">Contester2:</label></dt>
                <dd><input type="text" name="contester2" id="contester2" value="" /></dd>
                <dt><label for="contester3">Contester3</label></dt>
                <dd><input type="text" name="contester3" id="contester3" value="" /></dd>					

                <dd>
                        <label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Create Event" /></label>
                        <input type="hidden" name="formAction" id="formAction" value="create" />
                </dd>
            </dl>
        </fieldset>
    </form>
</section>