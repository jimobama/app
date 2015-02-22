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
   
   
}//end class

