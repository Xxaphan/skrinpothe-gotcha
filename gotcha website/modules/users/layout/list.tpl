<section id="sectionBox" class="clearfix">
    <h2>Members</h2>  
    <article class="event" class="clearfix">
         
         <table>
             <tr>
                 <th>Username</th>
                 <th>Events Played</th>
                 <th>Events Won</th>                 
                 <th>Current Event</th>
                      
             </tr>
     {iteration:iUsers}
     
             <tr class="{$iColor}">
                 <td><a href="index.php?module=users&amp;view=profile&amp;userid={$iUserId}">{$iUsername}</a></td>
                 <td>{$iPlayed}</td>
                 <td>{$iWon}</td>                 
                 <td>{$iCurrent}</td>   
             </tr>              
     {/iteration:iUsers}
     </table>  
         
         
     </article>  
</section>   