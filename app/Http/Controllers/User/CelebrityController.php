<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Celebrity;
use Illuminate\Http\Request;

class CelebrityController extends Controller
{
    /**
     * Display listing of all celebrities available for booking
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Celebrity::query();

        // Search functionality
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('known_for', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        // Filter by country
        if ($request->country) {
            $query->where('country', $request->country);
        }

        // Sort by price
        if ($request->sort === 'price_low') {
            $query->orderByRaw('CAST(booking_fee AS UNSIGNED) ASC');
        } elseif ($request->sort === 'price_high') {
            $query->orderByRaw('CAST(booking_fee AS UNSIGNED) DESC');
        } else {
            $query->orderBy('name', 'asc');
        }

        $celebrities = $query->paginate(12)->appends($request->all());
        
        // Get unique countries for filter
        $countries = Celebrity::whereNotNull('country')
                              ->distinct()
                              ->pluck('country')
                              ->sort();

        return view('user.celebrities', [
            'celebrities' => $celebrities,
            'countries' => $countries,
            'filters' => $request->all(),
            'title' => 'Browse Celebrities'
        ]);
    }

    /**
     * Show a specific celebrity's details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $celebrity = Celebrity::findOrFail($id);
        
        // Get similar celebrities (same country or similar booking fee)
        $similarCelebrities = Celebrity::where('id', '!=', $id)
            ->where(function($query) use ($celebrity) {
                $query->where('country', $celebrity->country)
                      ->orWhereBetween('booking_fee', [
                          max(0, (int)$celebrity->booking_fee - 500),
                          (int)$celebrity->booking_fee + 500
                      ]);
            })
            ->limit(4)
            ->get();

        return view('user.celebrity-details', [
            'celebrity' => $celebrity,
            'similarCelebrities' => $similarCelebrities,
            'title' => $celebrity->name
        ]);
    }
}