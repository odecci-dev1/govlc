<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Members;
use App\Models\LoanDetails;
use App\Models\CoMaker;
use App\Models\CoMakerFileUpload;
use App\Models\FileUpload;
use App\Models\TermsOfPayment;

use App\Models\JobInfo;
use App\Models\CoMakerJobInfo;
use App\Models\Appliances;
use App\Models\Assets;
use App\Models\BankAccounts;
use App\Models\BusinessInformation;
use App\Models\BusinessFileUpload;
use App\Models\ChildInfo;
use App\Models\FamBackground;
use App\Models\MonthlyBills;
use App\Models\Notification;
use App\Models\Properties;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function notifications()
    {
        $userId = session()->get('auth_userid');
        $noti = Notification::where('UserId', $userId)
            ->where('isRead', 0)
            ->get();
        return view('notifications', ['noti' => $noti]);
    }

    public function getnoticount()
    {
        $userId = session()->get('auth_userid');
        $notiCount = Notification::where('UserId', $userId)
            ->where('isRead', false)
            ->count();

        session()->put('noti_count', $notiCount);
        return $notiCount;
    }

    public function viewNotification($ref, $id)
    {
        $notification = Notification::where('Id', $id);
        $notification->update(['isRead' => 1]);

        $notiCount = session()->get('noti_count');
        session()->put('noti_count', $notiCount - 1);

        return redirect()->to('/tranactions/application/view/' . $ref);
    }

    public function markNotification($notiid)
    {
        $notification = Notification::where('Id', $notiid);
        $notification->update(['isRead' => 1]);

        $notiCount = session()->get('noti_count');
        session()->put('noti_count', $notiCount - 1);
        return redirect()->back();
    }

    public function testMe(){
        // try {
        //     DB::connection()->getPdo();
        //     dd('okds');
        // } catch (\Exception $e) {
        //     die("Could not connect to the database.  Please check your configuration. error:" . $e );
        // }

        // DB::connection('sqlsrv')->table('tbl_Application_Model')->where('id', 1)->get();
        return Members::get();
   
        // $users = DB::select('select * from tbl_Application_Model ');
    }

    public function corectRelation(){
        DB::beginTransaction();             
        try {  
            $memids = [];
            $famids = [];
            $members = Members::with('familybackground')->get();
            if($members->isNotEmpty()){
                foreach($members as $mem){
                    $memids[] = $mem->Id;
                    $famids[] = $mem->familybackground->Id;
                    Application::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);
                    LoanDetails::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);
                    CoMaker::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);
                    FileUpload::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]); 
                    Assets::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);        
                    BankAccounts::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);   
                    BusinessInformation::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);
                    FamBackground::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);     
                    ChildInfo::where('FamId', $mem->MemId)->update(['FamId' => $mem->familybackground->Id]); 
                    JobInfo::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);      
                    MonthlyBills::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);       
                    Properties::where('MemId', $mem->MemId)->update(['MemId' => $mem->Id]);                   
                }          
            }
            Application::whereNotIn('MemId', $memids)->delete();
                                                                                  
                    // use App\Models\BusinessFileUpload;                                                          
                    // use App\Models\Properties;

            $appids = [];
            $applications = Application::with('member')->get();
            if($applications->isNotEmpty()){
                foreach($applications as $app){
                    $appids[] = $app->Id;                    
                    LoanDetails::where('NAID', $app->NAID)->update(['NAID' => $app->Id]);
                    Appliances::where('NAID', $app->NAID)->update(['NAID' => $app->member->Id]);
                }          
            }
            LoanDetails::whereNotIn('NAID', $appids)->delete();

            //update LoanTypeID manually
            
            // $apploantype = Application::with('loantype')->get();
            // if($apploantype->isNotEmpty()){
            //     foreach($apploantype as $appl){                       
            //         LoanDetails::where('NAID', $appl->Id)->update(['LoanTypeID' => $appl->loantype->Id]);                  
            //     }          
            // }

            $topids = [];
            $terms = TermsOfPayment::get();
            if($terms){
                foreach($terms as $trmds){
                    $topids[] = $trmds->Id;
                    LoanDetails::where('TermsOfPayment', $trmds->TopId)->update(['TermsOfPayment' => $trmds->Id]);
                }
            }

            $coids = [];
            $comaker = CoMaker::get();
            if($comaker->isNotEmpty()){
                foreach($comaker as $com){
                    $coids[] = $com->Id;                   
                    CoMakerFileUpload::where('CMID', $com->CMID)->update(['CMID' => $com->Id]);
                    CoMakerJobInfo::where('CMID', $com->CMID)->update(['CMID' => $com->Id]);
                }          
            }

          
          
            Appliances::whereNotIn('MemId', $memids)->delete();
            Assets::whereNotIn('MemId', $appids)->delete();
            BankAccounts::whereNotIn('MemId', $appids)->delete();
            BusinessInformation::whereNotIn('MemId', $appids)->delete();
            FamBackground::whereNotIn('MemId', $appids)->delete();
            ChildInfo::whereNotIn('FamId', $famids)->delete();
            JobInfo::whereNotIn('MemId', $appids)->delete();
            MonthlyBills::whereNotIn('MemId', $appids)->delete();
            Properties::whereNotIn('MemId', $appids)->delete();

            CoMaker::whereNotIn('MemId', $appids)->delete();
            CoMakerFileUpload::whereNotIn('CMID', $coids)->delete();
            CoMakerJobInfo::whereNotIn('CMID', $coids)->delete();
            
            DB::commit();
            return 'done';

            //termsofpayment
        }
        catch (\Exception $e) {           
            DB::rollback();        
            dd($e);               
        }
    }
}
