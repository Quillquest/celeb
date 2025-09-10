<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Images;
use App\Models\Content;
use App\Models\TermsPrivacy;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{





    public function saveimg(Request $request)
    {

        $String = $this->RandomStringGenerator(6);

        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png|image',
        ]);

        if ($request->hasfile('image')) {
            $filef = $request->file('image');
            $path = $filef->store('photos', 'public');
        }

        $img = new Images();
        $img->title = $request['img_title'];
        $img->ref_key = $String;
        $img->description = $request['img_desc'];
        $img->img_path = $path;
        $img->save();
        return redirect()->back()->with('success', 'Image Added Sucessfully!');
    }







    public function updateimg(Request $request)
    {
        $settings = Settings::where('id', '=', '1')->first();
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|image',
        ]);

        $imgs = Images::where('id', '=', $request->id)->first();
        $String = $this->RandomStringGenerator(6);

        if (empty($request->file('image'))) {
            $filePathf = $imgs->img_path;
        } else {
            if ($request->hasfile('image')) {
                $filef = $request->file('image');
                if (Storage::disk('public')->exists($imgs->img_path)) {
                    Storage::disk('public')->delete($imgs->img_path);
                }
                $path = $filef->store('photos', 'public');
            }
        }

        Images::where('id', $request['id'])
            ->update([
                'title' => $request['img_title'],
                'description' => $request['img_desc'],
                'img_path' => $path,
            ]);
        return redirect()->back()->with('success', 'Image Updated Sucessfully!');
    }




    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }

    public function termspolicy()
    {

        return view('admin.Settings.FrontendSettings.privacy', [
            'title' => "Privacy Policy",
            'terms' => TermsPrivacy::find(1),
        ]);
    }

    public function savetermspolicy(Request $request)
    {
        $terms = TermsPrivacy::find(1);

        $terms->description = $request->termsprivacy;
        $terms->useterms = $request->terms;
        $terms->save();
        return redirect()->back()
            ->with('success', 'Terms and Privacy Policy Updated Successfully!');
    }
}
