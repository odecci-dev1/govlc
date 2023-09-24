<?php

namespace App\Traits;

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