<section id="sectionBox" class="clearfix">
    
    <h2>{$username}</h2>
    
    <article id="profilestats" class="profileStyle">
        <h3>INFO</h3>
        <dl>
            <dt>Real name:</dt><dd> {$firstname} {$lastname}</dd>
            <dt>Email:</dt><dd> {$email}</dd>
            <dt>Cellphone:</dt><dd> {$cellph}</dd>
        </dl>
        <br />
        <h3>Organized Events</h3>
        <table>
             <tr>
                 <th>Eventname</th>
                 <th>State</th>  
                 <th>Participating</th>
                 <th></th>
                 
             </tr>
             
        {iteration:iOrgEvents}     
             <tr class="{$iColor}">
                 <td><a href="index.php?module=events&amp;view=detailevent&amp;eventid={$iEventId}">{$iName}</a></td>
                 <td class="{$iStatusColor}" >{$iStatus}</td>  
                 <td>{$iParMem}</td>
                 <td id="actions">                     
                     {option:oGo}<a href="index.php?module=events&amp;view=startevent&amp;eventid={$iEventId}"><img src="/Gotcha/core/images/go.png" height="15px"/></a>{/option:oGo}
                     {option:oEdi}<a href="#"><img src="/Gotcha/core/images/edit.png" height="15px"/></a>{/option:oEdi}
                     {option:oDel}<a href="#"><img src="/Gotcha/core/images/del.png" height="15px" /></a>{/option:oDel}                    
                 </td>
                 
             </tr>              
        {/iteration:iOrgEvents}
         </table>
         
        <br />        
        <h3>Participating Events</h3>
         <table>
             <tr>
                 <th>Eventname</th>
                 <th>State</th>  
                 <th>Participating</th>
                 
             </tr>
        {iteration:iPartEvents}     
             <tr class="{$iColor}">
                 <td><a href="index.php?module=events&amp;view=detailevent&amp;eventid={$iEventId2}">{$iName2}</a></td>
                 <td class="{$iStatusColor}" >{$iStatus2}</td>   
                 <td>{$iParMem}</td>
             </tr>              
        {/iteration:iPartEvents}
       </table>
        <br />
        
    </article>
    
    <article id="profilepic" class="profileStyle">
        <img src="{$url}" alt="" />
    </article>
    
    
    <article id="profileedit" class="profileStyle">
        <h3>Options</h3>
        <ul>
            <li><a href="#">Edit profile</a></li>
            <li><a href="index.php?module=events&amp;view=eventcreate&amp;id={$userid}">Create event</a></li>            
        </ul>
    </article>
    
    
</section>
