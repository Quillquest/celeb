<?php

namespace App\Http\Controllers;

use App\Models\CelebrityBooking;;
use App\Models\Celebrity;
use App\Models\Settings;
use Illuminate\Http\Request;

class CelebrityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Create  Celebrity';
        return view('admin.create_celebrity', ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'known_for' => 'required',
            'booking_fee' => 'required',
            'years_active' => 'required',
            'dob' => 'required',
            'featured' => 'required',
            'country' =>  'required',
            'photo' => 'image|mimes:jpg,jpeg,png|max:3000',
        ]);


        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->extension();
            $whitelist = array('pdf', 'doc', 'jpeg', 'jpg', 'png');

            if (in_array($extension, $whitelist)) {
                $path = $file->store('uploads', 'public');
            } else {
                return redirect()->back()
                    ->with('message', 'Unaccepted Image Uploaded');
            }
        }
        Celebrity::create(

            [
                'name' => $request->name,
                'known_for' => $request->known_for,
                'booking_fee' => $request->booking_fee,
                'years_active' => $request->years_active,
                'dob' => $request->dob,
                'featured' => $request->featured,
                'country' => $request->country,
                'photo' => $path,
            ]
        );

        return redirect()->back()->with('success', 'Celebrity created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Celebrity  $celebrity
     * @return \Illuminate\Http\Response
     */
    public function show(Celebrity $celebrity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Celebrity  $celebrity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'known_for' => 'required',
            'booking_fee' => 'required',
            'years_active' => 'required',
            'dob' => 'required',
            'featured' => 'required',
            'country' => 'required',
        ]);
        $celebrity = Celebrity::where('id', $request->celebrity_id)->first();

        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->extension();
            $whitelist = array('pdf', 'doc', 'jpeg', 'jpg', 'png');

            if (in_array($extension, $whitelist)) {
                $path = $file->store('uploads', 'public');
            } else {
                return redirect()->back()
                    ->with('message', 'Unaccepted Image Uploaded');
            }
        }
        if ($request->photo == null) {
            $path  = $celebrity->photo;
        }

        Celebrity::where('id', $request->celebrity_id)->update([

            'name' => $request->name,
            'known_for' => $request->known_for,
            'booking_fee' => $request->booking_fee,
            'years_active' => $request->years_active,
            'dob' => $request->dob,
            'featured' => $request->featured,
            'country' => $request->country,
            'photo' => $path,
        ]);

        return redirect()->back()->with('success', "$request->name profile updated successfully");
    }



    //Return All Bookinngs
    public function booking()
    {


        return view('admin.celebrity.booking')
            ->with(array(
                'title' => 'All Bookings',
                'bookings' => CelebrityBooking::with('celebrity')->orderBy('id', 'desc')->get(),
                'settings' => Settings::where('id', 1)->first(),

            ));
    }
    //view individual bookings

    public function Viewbooking($id)
    {
        $booking =   CelebrityBooking::where('id', $id)->first();
        return view('admin.celebrity.editbooking', [
            'booking' => $booking,
            'title' => "Edit  $booking->name Application",
            'settings' => Settings::where('id', 1)->first(),

        ]);
    }


    //delete booking
    public function deletebooking($id)
    {
         CelebrityBooking::destroy($id);
        return redirect('admin/dashboard/booking')->with('success', 'Booking deleted successfully');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Celebrity  $celebrity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Celebrity $celebrity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Celebrity  $celebrity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Celebrity $celebrity)
    {
        //
    }
}
