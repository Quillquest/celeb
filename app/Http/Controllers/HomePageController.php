<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewNotification;
use App\Models\Booking;
use App\Models\Celebrity;
use Illuminate\Support\Facades\Mail;


class HomePageController extends Controller
{
    public function index()
    {
        $settings = Settings::where('id', '=', '1')->first();

        // Get featured celebrities for homepage (limit to 8 for better performance)
        $featuredCelebrities = Celebrity::featured()->limit(8)->get();

        return view('home.index')->with(array(
            'settings' => $settings,
            'title' => $settings->site_title,
            'featuredCelebrities' => $featuredCelebrities,
        ));
    }



    public function book()
    {
        $settings = Settings::where('id', '=', '1')->first();
        $celebrities = Celebrity::featured()->paginate(12); // 12 celebrities per page
        return view('home.book')->with(array(
            'settings' => $settings,
            'title' => $settings->site_title,
            'celebrities' => $celebrities,
        ));
    }

    //show booking page
    public function book_celebrity_now($id)
    {

        $settings = Settings::where('id', '=', '1')->first();
        $celebrity = Celebrity::find($id);
        $title =  "Book $celebrity->name";
        return view('home.booking')->with(
            array(
                'settings' => $settings,
                'title' => $title,
                'celebrity' => $celebrity,
            )
        );
    }
    //store bookings
    public  function bookingstore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required|string',
            'sex' => 'required|string',
            'purpose' => 'required',
            'celebrity_id' => 'required',
            'booking_type' => 'required',

        ]);


        Booking::create(
            $validatedData
        );

        //get celebrity
        $celebrity = Celebrity::where('id', $request->celebrity_id)->first();
        $name = stripcslashes($request->name);
        $phone = stripcslashes($request->phone);
        $address = stripcslashes($request->address);
        $sex = stripcslashes($request->sex);
        $purpose = stripcslashes($request->purpose);
        $email = stripcslashes($request->email);

        $msg = "";

        $msg .= "Client Name : " . $name . "\r\n\n";
        $msg .= "Phone Number: " . $phone . "\r\n\n";
        $msg .= "Client Email: " . $email . "\r\n\n";
        $msg .= "Client Address: " . $address . "\r\n\n";
        $msg .= "Client Gender: " . $sex . "\r\n\n";
        $msg .= "Celebrity Booked: " . $celebrity->name . "\r\n\n";
        $msg .= "Purpose: " . $purpose . "\r\n\n";
        $subject  = "Booking for $celebrity->name by $name";

        //mailling admin
        $recipient = "Admin";
        $settings = Settings::where('id', '1')->first();
        Mail::bcc($settings->contact_email)->send(new NewNotification($msg, $subject, $recipient));

        //mailling client
        $recipient = $name;
        $email = $email;
        $body = "Your submission has been received and is under review. You will be notified via email soon.";
        $subject = "Application Submission Received";

        Mail::bcc($email)->send(new NewNotification($body, $subject, $recipient));


        return redirect()->back()->with('success', 'Your Application has been received and is under review!');
    }
    // public function trackingresult(Request $request)
    // {

    //     $trackingnumber = trim($request->trackingnumber);
    //     $courier =  User::where('trackingnumber', $trackingnumber)->first();
    //     if (empty($courier->trackingnumber)) {
    //         return redirect()->back()->with('error', 'Error!! Tracking number does not exist');
    //     }
    //     return view('home.track-result')
    //         ->with(array(
    //             'tracks' => Tp_Transaction::where('user', $courier->id)->orderByDesc('id')
    //                 ->get(),
    //             'title' => 'Tracking Result',
    //             'courier' =>  $courier,
    //             'settings' => Settings::where('id', '=', '1')->first(),
    //             'latesttrack' => Tp_Transaction::where('user', $courier->id)->orderBy('created_at', 'desc')->first(),
    //         ));
    // }

    //submit application


    //send contact message to admin email
    public function sendcontact(Request $request)
    {

        $settings = Settings::where('id', '1')->first();
        $objDemo = new \stdClass();
        $objDemo->message = substr(wordwrap($request['message'], 70), 0, 350);
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "$request->subject,  my email $request->email";

        // Mail::bcc($settings->contact_email)->send(new NewNotification($objDemo));
        return  redirect()->route('homepage')->with('success', ' Your message was sent successfully!');
    }



    public function membership_card($id)
    {

        $settings = Settings::where('id', '=', '1')->first();
        $celebrity = Celebrity::find($id);
        $title =  "Purchase membership card for $celebrity->name";
        return view('home.membership')->with(
            array(
                'settings' => $settings,
                'title' => $title,
                'celebrity' => $celebrity,
            )
        );
    }


    //store bookings
    public  function apply_membership_card(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required',
            'method' => 'required|string',
            'purpose' => 'required',
            'celebrity_id' => 'required',
            'membership_plan' => 'required',
            'booking_type' => 'required',

        ]);


        Booking::create(
            $validatedData
        );

        //get celebrity
        $celebrity = Celebrity::where('id', $request->celebrity_id)->first();
        $name = stripcslashes($request->name);
        $phone = stripcslashes($request->phone);
        $method = stripcslashes($request->method);
        $membership_plan = stripcslashes($request->membership_plan);
        $purpose = stripcslashes($request->purpose);
        $email = stripcslashes($request->email);

        $msg = "";

        $msg .= "Client Name : " . $name . "\r\n\n";
        $msg .= "Phone Number: " . $phone . "\r\n\n";
        $msg .= "Client Email: " . $email . "\r\n\n";
        $msg .= "Client Membership card Type: " .  $membership_plan . "\r\n\n";
        $msg .= "Selected Payment method: " . $method . "\r\n\n";
        $msg .= "Celebrity Member Card : " . $celebrity->name . "\r\n\n";
        $msg .= "Purpose: " . $purpose . "\r\n\n";
        $subject  = "Membership Application Card for $celebrity->name by $name";



        //mailling admin
        $recipient = "Admin";
        $settings = Settings::where('id', '1')->first();
        Mail::bcc($settings->contact_email)->send(new NewNotification($msg, $subject, $recipient));

        //mailling client
        $recipient = $name;
        $email = $email;
        $body = "Your submission has been received and is under review. You will be notified via email soon.";
        $subject = "Application Submission Received";

        Mail::bcc($email)->send(new NewNotification($body, $subject, $recipient));


        return redirect()->back()->with('success', 'Your Application has been received and is under review!');
    }



    public function donate($id)
    {

        $settings = Settings::where('id', '=', '1')->first();
        $celebrity = Celebrity::find($id);
        $title =  "Donate to $celebrity->name Charity";
        return view('home.donate')->with(
            array(
                'settings' => $settings,
                'title' => $title,
                'celebrity' => $celebrity,
            )
        );
    }


    //store bookings
    public  function donate_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required',
            'method' => 'required|string',
            'purpose' => 'required',
            'celebrity_id' => 'required',
            'membership_plan' => 'required',
            'booking_type' => 'required',

        ]);


        Booking::create(
            $validatedData
        );

        //get celebrity
        $celebrity = Celebrity::where('id', $request->celebrity_id)->first();
        $name = stripcslashes($request->name);
        $phone = stripcslashes($request->phone);
        $method = stripcslashes($request->method);
        $membership_plan = stripcslashes($request->membership_plan);
        $purpose = stripcslashes($request->purpose);
        $email = stripcslashes($request->email);

        $msg = "";

        $msg .= "Client Name : " . $name . "\r\n\n";
        $msg .= "Phone Number: " . $phone . "\r\n\n";
        $msg .= "Client Email: " . $email . "\r\n\n";
        $msg .= "Donation Amount: " .  $membership_plan . "\r\n\n";
        $msg .= "Selected Payment method: " . $method . "\r\n\n";
        $msg .= "Celebrity Member Card : " . $celebrity->name . "\r\n\n";
        $msg .= "Purpose: " . $purpose . "\r\n\n";
        $subject  = "Doanation Application for $celebrity->name Charity by $name";



        //mailling admin
        $recipient = "Admin";
        $settings = Settings::where('id', '1')->first();
        Mail::bcc($settings->contact_email)->send(new NewNotification($msg, $subject, $recipient));

        //mailling client
        $recipient = $name;
        $email = $email;
        $body = "Your submission has been received and is under review. You will be notified via email soon.";
        $subject = "Application Submission Received";

        Mail::bcc($email)->send(new NewNotification($body, $subject, $recipient));


        return redirect()->back()->with('success', 'Your Application has been received and is under review!');
    }
}
