<?php

namespace App\Http\Controllers;

use App\Models\Surname;
use Illuminate\Http\Request;

class SurnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surname.index', ['surnames' => Surname::class]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function searchSurname(Request $request)
    {
        echo 'Success';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surname.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['english_word'] = strtoupper($request->english_word);
        Surname::create($request->all());
        return redirect()->back()->with('success','Surname Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function show(Surname $surname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function edit(Surname $surname)
    {
        return view('surname.edit',['surname' => $surname]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surname $surname)
    {
        $request['english_word'] = strtoupper($request->english_word);
        $surname->english_word = $request->english_word;
        $surname->gujarati_word = $request->gujarati_word;
        $surname->save();
        return redirect()->back()->with('success','Surname Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surname  $surname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surname $surname)
    {
        $surname->delete();
        return redirect()->back()->with('success','Surname Deleted.');
    }
}
