<section id="sectionBox" class="clearfix">    
    <h2>Create Event</h2>
    <form action="{$formUrl|htmlentities}" method="post">
        <fieldset>
            <dl class="clearfix columns">
                <dt<label for="eventname">Event Name:</label></dt>
                <dd><input type="text" name="eventname" id="eventname" value="" /></dd>
                <dd>
                    <input type="hidden" name="organizer" id="organizer" value="{$organizer}" />
                </dd>
                    
                
                <dt>Participants Email:</dt>

                <dd><input type="text" id="parti01" name="parti01" placeholder="participator 1" /></dd>
                <dd><input type="text" id="parti02" name="parti02" placeholder="participator 2" /></dd>
                <dd><input type="text" id="parti03" name="parti03" placeholder="participator 3" /></dd>
                <dd><input type="text" id="parti04" name="parti04" placeholder="participator 4" /></dd>
                <dd><input type="text" id="parti05" name="parti05" placeholder="participator 5" /></dd>
                <dd><input type="text" id="parti06" name="parti06" placeholder="participator 6" /></dd>
                <dd><input type="text" id="parti07" name="parti07" placeholder="participator 7" /></dd>
                <dd><input type="text" id="parti08" name="parti08" placeholder="participator 8" /></dd>
                <dd><input type="text" id="parti09" name="parti09" placeholder="participator 9" /></dd>
                <dd><input type="text" id="parti10" name="parti10" placeholder="participator 10" /></dd>
                        
                <dd>
                        <label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Create Event" /></label>
                        <input type="hidden" name="formAction" id="formAction" value="create" />
                </dd>
            </dl>
        </fieldset>
    </form>
</section>
