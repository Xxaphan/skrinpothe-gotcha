<section id="sectionBox" class="clearfix">
<h2> {$eventname} </h2>

<article id="eventdetail">
    <h3>Event Info: </h3>
    <ul>
        <li>Organizer: {$organizer}</li>
        <li>State: <span class="{$statusColor}">{$status}</span></li>
        <li>Start date: {$start}</li>
        <li>End date: {$end}</li>
    </ul>
     
     
     
</article>

<article id="eventdetail" class="event">
    <h3>Participating Members: </h3>
     <table>
        <tr>
            <th>Username</th>
            <th>Events Played</th>
            <th>Events Won</th>   
        </tr>
        
        {iteration:iUsers}
        <tr class="{$iColor}">
            <td><a href="index.php?module=users&amp;view=profile&amp;userid={$iUserId}">{$iUsername}</a></td>
            <td>{$iPlayed}</td>
            <td>{$iWon}</td> 
        </tr>              
        {/iteration:iUsers}
     </table>  
</article>
</section>   