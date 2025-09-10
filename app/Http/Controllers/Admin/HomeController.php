<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\User;
use App\Models\Admin;
use App\Models\forms;
use App\Models\Images;
use App\Models\Deposit;
use App\Models\Settings;
use App\Models\Wdmethod;
use App\Models\Withdrawal;

use App\Models\SettingsCont;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Celebrity;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sum total deposited
        return redirect()->route('mwithdrawals');
        $userlist = User::count();
        $blockedusers = User::where('status', 'blocked')->count();

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',

            'numberOfUsers' => $userlist,
            'blockedusers' => $blockedusers,

            'active_users' => User::where('status', 'active')->count(),
            'usersData' => $this->getUsersData(),
            'latestUsers' => User::latest()->take(5)->get(),

        ]);
    }

    public function getUsersData(): array
    {
        $usersInJan = $this->usersMonthlyCount('1');
        $usersInFeb = $this->usersMonthlyCount('2');
        $usersInMar = $this->usersMonthlyCount('3');
        $usersInApr = $this->usersMonthlyCount('4');
        $usersInMay = $this->usersMonthlyCount('5');
        $usersInJun = $this->usersMonthlyCount('6');
        $usersInJul = $this->usersMonthlyCount('7');
        $usersInAug = $this->usersMonthlyCount('8');
        $usersInSep = $this->usersMonthlyCount('9');
        $usersInOct = $this->usersMonthlyCount('10');
        $usersInNov = $this->usersMonthlyCount('11');
        $usersInDec = $this->usersMonthlyCount('12');

        // return as array of users
        return [
            $usersInJan,
            $usersInFeb,
            $usersInMar,
            $usersInApr,
            $usersInMay,
            $usersInJun,
            $usersInJul,
            $usersInAug,
            $usersInSep,
            $usersInOct,
            $usersInNov,
            $usersInDec,
        ];
    }

    public function usersMonthlyCount(string $month): int
    {
        $numberOfUsers = DB::table('users')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', now()->format('Y'))
            ->count();

        return $numberOfUsers;
    }


    public function createnewuser()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $subtxn = substr(strtoupper($settings->site_name), 0, 3);
        $number_gen = $this->RandomStringGenerator(8);
        $trackingnumber = "$subtxn-$number_gen";

        return view('admin.createnewuser')
            ->with(array(
                'title' => 'Create a Shipment',
                'trackingnumber' => $trackingnumber,


            ));
    }





    //Return manage users route
    public function manageusers()
    {
        return view('admin.Users.users')
            ->with(array(
                'title' => 'All Shipping',

            ));
    }





    //Return search route for Withdrawals
    public function searchWt(Request $request)
    {
        $dp = Withdrawal::all();
        $searchItem = $request['wtquery'];

        $result = Withdrawal::where('user', $searchItem)
            ->orwhere('amount', $searchItem)
            ->orwhere('payment_mode', $searchItem)
            ->orwhere('status', $searchItem)
            ->paginate(10);

        return view('admin.celebrity.mcelebrities')
            ->with(array(
                'dp' => $dp,
                'title' => 'Withdrawals search result',
                'withdrawals' => $result,

            ));
    }


    //Return manage Applications submitted
    public function mwithdrawals()
    {
        return view('admin.celebrity.mcelebrities')
            ->with(array(
                'title' => 'Manage All Celebrities',
                'celebrities' => Celebrity::orderBy('id', 'desc')->get(),
                'settings' => Settings::where('id', 1)->first(),

            ));
    }


    public function ViewApplication($id)
    {
        $celebrity =  Celebrity::where('id', $id)->first();
        return view('admin.celebrity.editcelebrity', [
            'celebrity' => $celebrity,
            'title' => "Edit  $celebrity->name Profile",
            'settings' => Settings::where('id', 1)->first(),

        ]);
    }


    public function deleteApplication($id)
    {
        Celebrity::destroy($id);
        return redirect('admin/dashboard/manage_celebrities')->with('success', 'Celebrity deleted successfully');
    }



    public function aboutonlinetrade()
    {
        return view('admin.about')
            ->with(array(
                'title' => 'About remedy',

            ));
    }

    public function emailServices()
    {
        return view('admin.email.index', [
            'title' =>  "Email services"
        ]);
    }

    //Return view agent route
    public function viewagent($agent)
    {
        return view('admin.viewagent')
            ->with(array(
                'title' => 'Agent record',
                'agent' => User::where('id', $agent)->first(),
                'ag_r' => User::where('ref_by', $agent)->get(),

            ));
    }

    //return settings form
    public function settings(Request $request)
    {
        include 'currencies.php';
        return view('admin.settings')->with(array(

            'wmethods' => Wdmethod::where('type', 'withdrawal')->get(),

            'currencies' => $currencies,
            'title' => 'System Settings'
        ));
        //return view('settings')->with(array('title' =>'System Settings'));
    }





    public function adduser()
    {
        return view('admin.referuser')->with(array(
            'title' => 'Add new Users',
            'settings' => Settings::where('id', '=', '1')->first()
        ));
    }

    public function addmanager()
    {
        return view('admin.addadmin')->with(array(
            'title' => 'Add new manager',
            'settings' => Settings::where('id', '=', '1')->first()
        ));
    }
    public function madmin()
    {
        return view('admin.madmin')->with(array(
            'admins' => Admin::orderby('id', 'desc')->get(),
            'title' => 'Add new manager',


        ));
    }

    //Return KYC route
    public function kyc()
    {
        return view('admin.kyc', [
            'title' => 'KYC Applications',
            'kycs' => Kyc::orderByDesc('id')->with(['user'])->get(),
        ]);
    }

    public function viewKycApplication($id)
    {

        return view('admin.kyc-applications', [
            'title' => 'View KYC Application',
            'kyc' => Kyc::where('id', $id)->with(['user'])->first(),
        ]);
    }

    public function adminprofile()
    {
        return view('admin.Profile.profile')
            ->with(array(
                'title' => 'Admin Profile',


            ));
    }

    public function managecryptoasset()
    {

        return view('admin.Settings.Crypto.pageview', [
            'title' => 'Manage Crypto Asset',
            'moresettings' => SettingsCont::find(1),
        ]);
    }


    public function p2pView()
    {
        return view('admin.p2p.show', [
            'title' => 'Manage P2P transactions',
        ]);
    }


    public function showtaskpage()
    {
        return view('admin.task')
            ->with(array(
                'admin' => Admin::orderby('id', 'desc')->get(),
                'title' => 'Create a New Task',

            ));
    }



    public function leads()
    {
        return view('admin.leads')
            ->with(array(
                'admin' => Admin::orderBy('id', 'desc')->get(),
                'users' => User::orderby('id', 'desc')->where('cstatus', NULL)->get(),
                'title' => 'Manage New Registered Clients',
            ));
    }
    public function leadsassign()
    {
        return view('admin.lead_asgn')
            ->with(array(
                'usersAssigned' => User::orderby('id', 'desc')->where([
                    ['assign_to', Auth('admin')->User()->id],
                    ['cstatus', NULL]
                ])->get(),

                'title' => 'Manage New Registered Clients',

            ));
    }


    public function customer()
    {
        return view('admin.customer')
            ->with(array(
                'users' => User::orderby('id', 'desc')->where('cstatus', 'Customer')->get(),
                'title' => 'Manage shipments',

            ));
    }


    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "12345678900123456789023456789034567890456789056789067890890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}
