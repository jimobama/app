<?php
include_once("entities/Flight.php");
include_once("models/FlightModel.php");
   $model= new FlightModel();
   $flightList= $model->GetAllDistinctFlights();
 $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");  

 
 function displayDaysOptionByMouth($intMonth,$year =null)
 {
     if($year==null)
        $year= date("Y",time());     
   $number = cal_days_in_month(CAL_GREGORIAN, $intMonth, $year);
   return intval($number);
 }
 
 
 ?>


<div class="row">
    <div class="col-sm-5 search-panel">
     <?php
      $object=new ArrayIterator();
      $object->offsetSet("class", "form form-horizontal");
     
      $object->offsetSet("method", "post");
      ContextManager::BeginForm("Flight", "TimesTable", $object);
     ?>
           
           
           <div class='title'>Search Flights's Time Table</div>
            <div class="form-group inline-fields sm-1">
                <label for="txtFrom">Location From:</label>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                     <option value="">source...</option>
                     
                      <?php
                            foreach($flightList as $flight)
                            {
                               echo "<option value='$flight->from' >$flight->from</option>";
                            }
                   ?>
                </select>
                
                
            </div>
            
            <div class="form-group inline-fields sm-1">
               
                <label for="txtFrom">To:</label>
                <select  id='txtTo' name='txtTo' class='form-control'>
                    <option value="">destination's...</option>
                  
                    
                      <?php
                            foreach($flightList as $flight)
                            {
                                echo "<option value='$flight->to' >$flight->to</option>";
                            }
                           ?>
                </select>
            </div>
          
            <div class="form-group inline-fields sm-2 date-control">
                <label>Date From: </label>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                      <option value="">day</option>
                      <?php                      
                        $numberofdays =   displayDaysOptionByMouth(intval(date("m",time())));
                        for($i = 1; $i <= $numberofdays ; $i++ )
                        {
                         echo " <option value='$i'> $i </option>"; 
                        }
                     
                      ?>
                </select>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                      <option value="">mouth...</option>
                       <?php 
                       $month_year = intval(date("m",time()));
                       echo $month_year;
                       for($month =  $month_year ; $month  <=  12 ; $month++)
                       {
                           $monthname=$mons[$month];
                           echo " <option value=' $month'> $monthname</option>";
                       }
                      ?>
                      
                </select>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                      <option value="">yyyy</option>
                       <?php 
                       $current_year = intval(date("Y",time()));
                       
                       for($year = $current_year ; $year <=  $current_year +10;  $year++)
                       {
                           echo " <option value=' $year'> $year</option>";
                       }
                      ?>
                </select>
                
            </div>
            
              <div class="form-group inline-fields sm-2 date-control">
                <label>Date to: </label>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                      <option value="">day...</option>
                      <?php                      
                        $numberofdays =   displayDaysOptionByMouth(intval(date("m",time())));
                        for($i = 1; $i <= $numberofdays ; $i++ )
                        {
                         echo " <option value='$i'> $i </option>"; 
                        }
                     
                      ?>
                      
                </select>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                       <option value="">mouth...</option>
                        <?php 
                       $month_year = intval(date("m",time()));
                       echo $month_year;
                       for($month =  $month_year ; $month  <=  12 ; $month++)
                       {
                           $monthname=$mons[$month];
                           echo " <option value=' $month'> $monthname</option>";
                       }
                      ?>
                      
                </select>
                <select  id='txtFrom' name='txtFrom' class='form-control'>
                      <option value="">yyyy</option>
                      <?php 
                       $current_year = intval(date("Y",time()));
                       
                       for($year = $current_year ; $year <=  $current_year +10;  $year++)
                       {
                           echo " <option value=' $year'> $year</option>";
                       }
                      ?>
                </select>
                
            </div>
           
           <div class='form-group inline-fields button '>
              <input class='btn btn-primary' type='submit' value='Search' name='btnFindTimeTable'/>
           </div>
            
        </form>
    </div>
    
     <div class="col-sm-6">
      
       <!-- Here -->  
         
         
    </div>
</div>