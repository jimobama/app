<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validators
 *
 * @author jimobama
 */
class Validator {
  
    
    static function UniqueKey()
    {
        $id= (Integer) ((microtime() * time()));
        return $id;
    }
    
static private $months=array( 1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                 5 => 'May',     6 => 'June',     7 => 'July',  8 => 'August',
                 9 => 'September', 10 => 'October', 11 => 'November',
                 12 => 'December');

    static function isEmail($aEmail) {
        $ePattern = "/^[a-zA-Z0-9\_\.]+@[a-zA-Z\.\_0-9]+\.[a-zA-Z0-9]{2,3}$/";

        if (preg_match($ePattern, $aEmail) == true) {
            return true;
        } else {
            return false;
        }
        return true;
    }

//end function 

    
    static function isPaymentNameMatched($strMatchedName,$customerName)
    {
      $isMatched=false;
      
      //break matchName into an array and find if any of the name acth the card name
      $arrMatchName=explode(" ",$strMatchedName);//get words name
      
      foreach($arrMatchName as $strWord)
      {
          
          if(self::isFound($customerName,$strWord))
          {
              $isMatched=true;
              //echo "Is found";
              break;//no search any more
          }
      }
      
      return $isMatched;
       
    }
    
   private static function isFound($customerName,$strWord)
   {
       if(strstr($customerName,$strWord) !=false)
       {
           return true;
       }
       return false;
   }
static function isNumber($aStringValue) {
        $pattern = "/^[0-9\.]+$/";
        if (preg_match($pattern, $aStringValue)) {
            return true;
        }
        return false;
    }

    static function isWord($word) {
        $pattern = "/^[a-zA-Z\_]+[a-zA-Z0-9\.\_]+$/";
        if (preg_match($pattern, trim($word))) {
            
            return true;
        }
        return false;
    }

    static final function isPostcode($postcode) {

        //UK post validator
         $pattern="/^[a-zA-Z]{2}[ ]{0,1}[0-9]{1,2}[ ]{0,1}[A-Za-z0-9]+$/";
          if (preg_match($pattern,$postcode)) {
            return true;
        }
        return false;
    }
    
    
   static final function isStringDate($txtExpiredate)
   {
       $okay=false;
       $dateArray=explode("/",$txtExpiredate);
       $date=Date("d/m/Y",time());
       $nowarray=explode("/",$date);
      //check if it is an array
       if(is_array($dateArray))
       {
           //check if the array size is two as suppose
           if(count($dateArray)==2)
           {
            //check if the first number is integer value of just two
            $mm=$dateArray[0];
            $yyyy=$dateArray[1];
           //check if the values are numeric
            if(is_numeric($mm) && is_numeric($yyyy) && ($mm<=12 && $mm>=1))
            {
               //check if the date is valid
                if(checkdate($mm, $day=1, $yyyy))
                {
                  //is date so check if the card expired
                    if($yyyy > $nowarray[2])
                    {
                        $okay=true;//the card expired date is valid
                    }//end if
                    
                }//end if
            }//end if
               
           }//end if
           
       }////end if array
       
   
       
       return $okay;
   }

static public function getStringFrom($keywords,$startPos,$endPos)
{
    $newKeywords="";
    $keywords=Rtrim($keywords,",");    
    for($startPos;$startPos<$endPos;$startPos++)
    {
     $newKeywords.= $keywords[$startPos] ;
    }
    $newKeywords=Rtrim($newKeywords,",");
    
    return $newKeywords;
}
     private static function removeCharacter($time1,$char)
        {
            $time1 = trim($time1);
            $result="";
            for($var=0; $var < strlen($time1); $var++)
            {
                $char = $time1[$var];
                if($char != $char)
                {
                    if(is_numeric($char)){
                    $result = $result.$char;
                    }
                }
            }
            
            return $result;
        }
 
    public static function TimeDifferent($time1, $time2) {
        
        $time1= intval(self::removeCharacter($time1,":"));
        $time2=intval(self::removeCharacter($time2,":"));         
        return $time1-$time2;
        
    }

    public static function DateDifferent($param0, $param1) {
        $date1 =intval(self::removeCharacter($param0,"/"));
        $date2 =intval(self::removeCharacter($param1,"/"));
        return ($date1- $date2);
    }
    
    PUBLIC static function IsDate($date)
    {
        $okay=false;
        $dd="";
        $mm="";
       $yyyy="";
        if(is_string($date))
        {
          //language dd/mm/yyyy
            $parseStr = trim($date);
            $type =0;
          
            for($var=0;$var < strlen($date); $var++)
            {
                $char =  $parseStr[$var];
                switch($char)
                {
                    case "/":
                    {
                         $type++;
                    }break;
                    default:
                    {
                        
                        switch($type)
                        {
                            case 0:
                            {
                                if(strlen(trim($dd))<=1)
                                {
                                    $dd = $dd.$char;
                                }
                            }break;
                            case 1:
                            {
                                 if(strlen(trim($mm))<=1)
                                {
                                    $mm = $mm.$char;
                                }
                            }break;
                            case 2:
                            {
                                if(strlen(trim($yyyy))<=3)
                                {
                                    $yyyy = $yyyy.$char;
                                }
                            }break;
                            default:
                            break;
                        }
                    }break;
                    
                }
            }
        }
        
        if((strlen($dd)==2) && ((strlen($mm))==2) && ( (strlen($yyyy) ==2) ||(strlen($yyyy) ==4) ))
        {
            $okay=true;
        }
        return $okay;
    }
    
    public static function IsTime($time)
    {
        $okay=false;
        //Grammar syntax hh:mm:ss
         $hh="";
        $mm="";
        $ss="";
        if(is_string($time))
        {
            //0= hh , 1= mm, 2 mm
            $current=0;
           
            $parserStr= trim($time);
            for($var=0; $var < strlen($parserStr);$var++)
            {
                $char = $parserStr[$var];
               switch ($char)     
               {
                   case ':':
                   {
                       $current++;  
                   }break;
                   default:
                   {
                       switch($current)
                       {
                           case 0:
                           {
                               if(strlen($hh) <=2)
                               {
                                   $hh =$hh.$char;
                               } 
                           }break;
                           case 1:
                           {
                                if(strlen($mm) <=2)
                               {
                                   $mm =$mm.$char;
                               } 
                           }break;
                           case 2:
                           { 
                               if(strlen($ss) <=2)
                               {
                                   $ss =$ss.$char;
                               }
                           }break;
                           default:
                           {
                            
                           }break;
                       }
                   }break;
               }
            }
        
        }
        
        if(strlen($hh)==2 | strlen($mm)==2)
        {
            if(strlen($ss)== 2 | (strlen($ss)==0))
            {
                $okay=true;
            }
        }
        
        return $okay;
        
    }

    
    static function IsDateInFuture($date)
    { 
      $now = date("d/m/Y");
      $dformat = date_create_from_format("d/m/Y",$date);
      $dformat2 = date_create_from_format("d/m/Y", $now);   
    
     $interval = $dformat2->diff($dformat);
     
     $interval =intval($interval->format("%R%a"));
     return  $interval;   
     
                          
    }
}//end class

