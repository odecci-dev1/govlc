<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use DateTime;

trait Common {

   public $showDialog = 0;
   public $showAskingDialog = 0;
   public $showAlert = 0;
   public $mid = '';

   public function calculateAge($dateOfBirth){                
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
   }

   public function calculateTimeDifference($start, $end){     
      $datestart = $start; 
      $dateend = $end; 
      
      $start_datetime = new DateTime($datestart); 
      $diff = $start_datetime->diff(new DateTime($dateend)); 

      return ['years' => $diff->y, 'months' => $diff->m, 'days' => $diff->d, 'hours' => $diff->h, 'minutes' => $diff->i, 'seconds' => $diff->s];
      
      // echo $diff->days.' Days total<br>'; 
      // echo $diff->y.' Years<br>'; 
      // echo $diff->m.' Months<br>'; 
      // echo $diff->d.' Days<br>'; 
      // echo $diff->h.' Hours<br>'; 
      // echo $diff->i.' Minutes<br>'; 
      // echo $diff->s.' Seconds<br>';
   }

   public function getUserName($userid){     
      $user_name = 'User not found';
      if( $userid != ''){
         $getuser = Http::withToken(getenv('APP_API_TOKEN'))->post(getenv('APP_API_URL').'/api/UserRegistration/PostUserSearching', [['column' => 'userId', 'values' => $userid]]); 
         // dd( $userid );
         $getuser = $getuser->json();
         if(isset($getuser[0])){
            $user_name = $getuser[0]['fname'] .' '. $getuser[0]['lname'];
         }
     }
     return $user_name;
   }

   public function showDialog($mid){
      $this->mid = $mid;     
      $this->showDialog = 1;
   }

   public function showAskingDialog($message = '', $header = ''){
      $this->showAskingDialog = 1;
   }


   public function closeDialog(){
      $this->showDialog = 0;
      $this->mid = '';
   }

   public function showAlert($mid){    
      $this->showAlert = 1;
   }

   public function closeAlert(){
      $this->showAlert = 0;
   }
   
  
}