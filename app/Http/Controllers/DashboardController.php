<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{ 
    public function getActiveMembers(Request $request){
        $getactivemembers =  Http::withToken(getenv('APP_API_TOKEN'))->get(getenv('APP_API_URL').'/api/Dashbaord/DashboardGraph', ['days' => $request['days'], 'category' => $request['area']]);  
        return json_encode($getactivemembers->json());   
        //test/
    }
}
