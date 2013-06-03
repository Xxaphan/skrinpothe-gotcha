<section id="sectionBox" class="clearfix">
    <h2>Events</h2>  
    <article class="event" class="clearfix">
         
         <table>
             <tr>
                 <th>Eventname</th>
                 <th>State</th>
                 <th>Organizer</th>                 
                 <th>Start date</th>
                 <th>Finished on</th>     
             </tr>
     {iteration:iEvents}
     
             <tr class="{$iColor}">
                 <td><a href="index.php?module=events&amp;view=detailevent&amp;eventid={$iEventId}">{$iName}</a></td>
                 <td class="{$iStatusColor}" >{$iStatus}</td>
                 <td><a href="index.php?module=users&amp;view=profile&amp;userid={$iOrganizerId}">{$iOrganizer}</a></td>                 
                 <td>{$iStart}</td>
                 <td>{$iEnd}</td>     
             </tr>              
     {/iteration:iEvents}
     </table>  
         
         
     </article>  
</section>   