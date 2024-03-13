<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReleaseExport;

class ExportsController extends Controller
{
    public function exportReleaseReport(){
        return Excel::download(new ReleaseExport, 'Release_Report.xlsx');
    }
}
