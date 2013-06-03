<section id="sectionBox" class="clearfix">
   {option:oHasStarted}
    <p>Your event has been succesfully created </p>
    {/option:oHasStarted}
    {option:oHasNotStarted}
    <p>Your event hasn't been started because some participants didn't accept/declined yet. </p>
    <table>
             <tr>
                 <th>Participants</th>
                 <th>State</th>                  
                 
             </tr>
             
        {iteration:iAcceptDecline}     
             <tr class="{$iColor}">
                 <td>{$iParticipant}</td>
                 <td>{$iState}</td>                
                 
             </tr>              
        {/iteration:iAcceptDecline}
         </table>
    {/option:oHasNotStarted}
</section>   