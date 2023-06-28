<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    //http://localhost:8081/api = put in .env
    public function test(){
        $data = Http::withToken(getenv('APP_API_TOKEN'))->get('http://localhost:8081/api/Member/MemberList');
        // dd($data->json());
        foreach($data->json() as $d){
            echo $d['fname'] . '<br>';
        }
    }

    public function posttest(){
        // {
        //     "id": 0,
        //     "fname": "string",
        //     "lname": "string",
        //     "mname": "string",
        //     "suffix": "string",
        //     "age": "string",
        //     "barangay": "string",
        //     "city": "string",
        //     "civil_Status": "string",
        //     "cno": "string",
        //     "country": "string",
        //     "dob": "2023-07-07 00:00:00.000",
        //     "emailAddress": "string",
        //     "gender": "string",
        //     "houseNo": "string",
        //     "house_Stats": "string",
        //     "pob": "string",
        //     "province": "string",
        //     "yearsStay": "1",
        //     "zipCode": "string",
        //     "status": "1"
        //   }

        $data = ['fname' => 'testfname2'];

        $data = Http::withToken(getenv('APP_API_TOKEN'))->post('http://localhost:8081/api/Member/SaveMember', $data);
        dd($data);

    }
}
