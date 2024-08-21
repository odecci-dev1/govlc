<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Members;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{ 
    public function getActiveMembers(Request $request){
        // $getactivemembers =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/DashboardGraph', ['days' => $request['days'], 'category' => $request['area']]);  
       
       try{
        $getactivemembers=[];
        if($request->area == 'All'){
            $getArea = Area::all()->whereNotNull('Area');
        }else{
            
            $getArea = Area::where('Id',$request['area'])->first();
        }

        $currentDate = date_create(date_format(Carbon::now(),'Y-m-d'));
        //date_sub($currentDate ,date_interval_create_from_date_string("30 days"));
        $newDate = $currentDate;
        $days = ($request['days'] == 1) ? 12:$request['days'];
        for($i = 0;$i<=$days;$i++){
        //for($i = 0;$i<=30;$i++){
            
             if($request['days'] == 1){
                date_sub($newDate,date_interval_create_from_date_string("1 month"));
                $members = Members::where('Status',1)->whereMonth('DateCreated','=',date_format($newDate,'m'))->get();
             }else{
                date_sub($newDate,date_interval_create_from_date_string("1 days"));
                $members = Members::where('Status',1)->whereDate('DateCreated','=',date_format($newDate,'Y-m-d'))->get();
             }

             $count=0;
             if($request->area == 'All'){
                foreach($getArea as $area){
                    $locations = explode("|",$area->City);
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
                }
            }else{
                $locations = explode("|",$getArea->City);
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
            }
            
            $areamember=[];
            $areamember['count'] = $count;
            $areamember['areaName'] = ($request->area == 'All') ? 'All':$getArea->Id;
            $areamember['date'] = $request['days'] == 1 ? date_format($newDate,'F'):date_format($newDate,'m/d/Y');
            $getactivemembers[] = $areamember;
            
        }
    
        return json_encode($getactivemembers);   
    }catch(Exception $e){
        return json_encode(array('error'=> $e->getMessage()));
    }
  
     
        //return json_encode($getactivemembers->json());   
        
    }
}
