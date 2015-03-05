Search Results(0)

<?php
if (Session::get("seach_find") >0)
{
    
?>
 <table width="100%">
                    <tr>
                     <th>S/N</th>
                     <th>Flight Name</th>
                     <th>Source</th>
                     <th>Destination</th>
                     <th>Boarding Date</th>
                     <th>Arrival Date</th> 
                     <th>Boarding Time</th> 
                     <th>Arrival Time</th> 
                     <th>Number of Stops</th> 
                     <th>Price Rate</th> 
                     <th>Seats Left</th> 
                     <th colspan="2">op</th>
                      
                </tr>
    
</table>

<?php
Session::delete("seach_find");
}
// other page
?>