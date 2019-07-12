<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;

class CountryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.index', ['countries' => Country::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create', [
            'country' => [],
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
//        dd($request);
        $validated = $request->validated();
//        redirect()->back()->with([
//                'alert' => 'asdfafasdf',
//                'success' => 'fkgkkgkg'
//            ]);
//        dd($validated);
//        \Session::flash('key', 'value');
//        dd(\Session::all());
//        if (true) {
////            Session::
//        }
//        dd($validated);
        Country::create($validated);
        return redirect()
                        ->route('admin.country.index')
                        ->with('success', 'Успешно добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('admin.country.edit', [
            'country' => $country,
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->except('slug'));
        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->movies()->detach();
        $country->delete();
        return redirect()->route('admin.country.index');
    }

}
