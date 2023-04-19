<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Surname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->peopleSearchString)) {
            $people = Person::where('name','like',"%{$request->peopleSearchString}%");
            $people->each(function(Person $person){
                if ($person->relation == 0) {
                    $person['relation'] = 'SELF';
                } elseif($person->relation == 1) {
                    $person['relation'] = 'FATHER';
                }elseif ($person->relation == 2) {
                    $person['relation'] = 'HUSBUND';
                }else {
                    $person['relation'] = 'WIFE';
                }
                
            });
            return view('person.index',['people' => $people->with('parent')->paginate(20), 'data_count' => $people->count()]);
        }
        return view('person.index',['people' => Person::with('parent')->paginate(20), 'data_count' => Person::count()]);
    }

    public function searchParent(Request $request)
    {
        $people = Person::where('name','like',"%{$request->parentSearchString}%")->get();
        Log::info($people);
        $table = '
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th class="py-3 px-6">
                            Name
                        </th>
                        <th class="py-3">
                            Address
                        </th>
                        <th class="py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
        ';
        if ($people->count() == 0){
            $table .= '
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td colspan="3" class="py-4 px-6 text-center">No data found</td>
                </tr>
            ';
        }
        foreach ($people as $person) {
            $personName= "'".$person->name." ".$person->surname->gujarati_word."'";
           $table .= '
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-4 px-6">
                                '.$person->name.' '.$person->surname->gujarati_word.'
                            </td>
                            <td class="py-4">
                                '.$person->address.'
                            </td>
                            <td class="py-4">
                                <button onclick="setParent('.$personName.','.$person->id.');" class="text-white absolute bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Select</button>
                            </td>
                        </tr>
           ';
        }
        $table .= '
                    </tbody>
                </table>
        ';
        echo $table;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create', ['surnames' => Surname::class, 'person' => Person::class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'surname_id'=>'required',
            'relation'=>'required',
            'gender'=>'required',
        ]);
        try {
            $request['name'] = strtoupper($request->name);
            $request['address'] = strtoupper($request->address);
            Person::create($request->all());
        } catch (\Throwable $th) {
            $error = Validator::make([], []);
            $error->getMessageBag()->add('person', 'Error while creating person.');
            return redirect()->back()->withErrors($error);
        }
        return redirect()->back()->with('success','Person Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return view('person.edit', ['surnames' => Surname::class, 'person' => Person::class, 'person' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        try {
            $request['name'] = strtoupper($request->name);
            $request['address'] = strtoupper($request->address);
            $person->update($request->all());
            $person->save();
        } catch (\Throwable $th) {
            $error = Validator::make([], []);
            $error->getMessageBag()->add('person', 'Error while updating person.');
            return redirect()->back()->withErrors($error);
        }
        return redirect()->back()->with('success','Person Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->back()->with('success','Person Deleted.');
    }
}
