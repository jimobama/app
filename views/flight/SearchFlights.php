

<?php
$list =new  ArrayIterator();

$model =  ContextManager::$Model;
if(is_a($model, "FlightModelView"))
{
   $list = $model->flightList;
  // print_r($list );
}
if($list ==null)
{
    $list = new  ArrayIterator();
}

$count=$list->count();
if($count>0){
echo "Search Results is $count\n";
}
 else {
    echo "No Search found , we may need more specific details please!";
}
if (Session::get("Searching") >0)
{
    
?>
 <table  class="table ob-table" style="margin:2px;">
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
                     <th>Price range</th> 
                     <th>Seats Left</th> 
                     <th colspan="2">op</th>
                      
                     </tr>
                
                <?php 
                include_once("models/PlaneModel.php");
                
                $plane = new PlaneModel();
                
                for($v=0; $v <  $list->count() ;$v++)
                {
                    $flight = new Flight();
                    $list->seek($v);
                    $flight = $list->current();
                    $highprice =  $plane->getHighestPrice($flight->planeID);
                    $lowPrice =  $plane->getLowerPrice($flight->planeID);
                    $range="£$lowPrice to £$highprice";
                    $arrparam=new ArrayIterator();
                   
                   $idflight= $flight->Id;
                    $link = "<a href='?url=Booking&action=Flight&id=$idflight'>Book Now</a>";
                    if($highprice ==$lowPrice  )
                    {
                        $range= "£$highprice";
                    }
                    $sn= $v +1;
                   $name =   $plane->GetName($flight->planeID);
                     echo "<tr>
                     <th>$sn</th>
                     <th>$name</th>
                     <th>$flight->from</th>
                     <th>$flight->to</th>
                     <th>$flight->deptureDate</th>
                     <th>$flight->landindDate</th> 
                     <th>$flight->boardingTime</th> 
                     <th>$flight->Landingtime</th> 
                     <th>$flight->stops</th> 
                     <th>$range</th> 
                     <th>Seats Left</th> 
                     <th colspan='2'>$link </th>
                      
                     </tr>";
                }
                ?>
    
</table>

<?php
Session::delete("seach_find");
}
// other page
?>