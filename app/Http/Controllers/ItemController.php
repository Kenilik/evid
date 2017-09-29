<?php

namespace App\Http\Controllers;

use App\Investigation;
use App\Item;
use App\Contact;

use Illuminate\Http\Request;
use Cookie;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Investigation $investigation)
    {
        $searchCriteria = array("sText", "sKeywords", "sMsg", "sCall", "sDataset", "sContacts");
        $iCookieLive = 99;
        $aCriteria = array();
        $aCookies = array();
        $aRequests = array();
        $sDebug = array();
        
        // initially treat every load as though the user has come from the investigation landing page.
        $bTreatAsRequest = false;
        foreach ($searchCriteria as $criteria) {
            // add the cookie and request values to arrays
            $aCookies[$criteria] = Cookie::get($criteria);
            $aRequests[$criteria] = $request->input($criteria);
            if ($aRequests[$criteria] != null) {
                // if any of the requests are not null then the user has come from the items propccessing page and are filtering the items in some way
                $bTreatAsRequest = true;
            }
        }
        
        // if the user is filtering items then 
        if ($bTreatAsRequest) {
            // use the requests as the criteria for the search
            $aCriteria = $aRequests;
        } else { // otherwise use any existing cookies to search and set up the page.
            $aCriteria = $aCookies;
        }



        // update the cookies
        foreach ($searchCriteria as $criteria) {
            Cookie::queue($criteria, $aCriteria[$criteria], $iCookieLive);
        }
        //dd($sDebug);
       //dd($aCriteria);

        $sText = $aCriteria['sText'];
        // change the value of the checkbox criteria back to checked so that the view can easily render the checkbox whether checked or not.
        if ($aCriteria['sMsg'] == 'on') { $sMsg = true; $aCriteria['sMsg'] = 'checked';} else { $sMsg = false; $aCriteria['sMsg'] = ''; }
        if ($aCriteria['sCall'] == 'on') { $sCall = true; $aCriteria['sCall'] = 'checked';} else { $sCall = false; $aCriteria['sCall'] = ''; }

        if ($aCriteria['sContacts'] == null) {
            $aCriteria['sContacts'] = array();
        } else {
            $aCriteria['sContacts'] = explode(',', $aCriteria['sContacts']);
        }
        
        //dd($aCriteria);

        $datasets = $investigation->datasets()->get();

        if ($aCriteria['sDataset'] == null) {
            if ($datasets->isNotEmpty()) {
                $aCriteria['sDataset'] = $datasets->first()->id;
            }
        }

        $contacts = Contact::withCount(['from_items', 'to_items'])
            ->where('dataset_id', '=', $aCriteria['sDataset'])
            ->get();

        $c = $aCriteria['sContacts'];

        $items = $investigation->items()->OfType($sMsg, $sCall)
            ->where('dataset_id', '=', $aCriteria['sDataset'])
            ->when((empty($c) == false) , function($query) use ($c) {
                    return $query->whereIn('from_contact_id', $c)
                                    ->orWhereIn('to_contact_id', $c);
                })
            ->when($sText, function ($query) use ($sText) {
                    return $query->where('text_content', 'like', '%' . $sText . '%');
                })
            ->paginate(10);
                
        return view('items', compact('investigation', 'items', 'datasets', 'contacts', 'aCriteria'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
