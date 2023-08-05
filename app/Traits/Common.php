<?php

namespace App\Traits;

trait Common {

   public function calculateAge($dateOfBirth){                
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
   }
  
}