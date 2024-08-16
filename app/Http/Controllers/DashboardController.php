<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{ 
    public function getActiveMembers(Request $request){
        // $getactivemembers =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/DashboardGraph', ['days' => $request['days'], 'category' => $request['area']]);  
       
       
        $getactivemembers=[];
        $getArea = Area::where('Id',8)->first();
        $currentDate = date_create(date_format(Carbon::now(),'Y-m-d'));
        //date_sub($currentDate ,date_interval_create_from_date_string("30 days"));
        $newDate = $currentDate;
        for($i = 30;$i<=0;$i++){
        //for($i = 0;$i<=30;$i++){
            
            //date_sub($newDate,date_interval_create_from_date_string($i."days"));
             $members = Members::where('Status',1)->whereDate('DateCreated','=',date_format($newDate,'Y-m-d'))->get();
        
             $locations = explode("|",$getArea->City);
             $count=0;
             foreach($locations as $location){
                 $location = explode(',', $location);
                 $barangay = trim($location[0],' ');
                 $city = trim($location[1],' ');
                 
               
                 foreach($members as $member){
                   
                     if($member->Barangay == $barangay && $member->City == $city){
                         $count +=1;
                     }
                 }
             }
            $areamember=[];
            $areamember['count'] = $count;
            $areamember['areaName'] = $getArea->Id;
            $areamember['date'] = date_format($newDate,'Y-m-d');
            $getactivemembers[] = $areamember;
            
        }
    
      
      
  
        return json_encode($getactivemembers);   
        //return json_encode($getactivemembers->json());   
        
    }
}
