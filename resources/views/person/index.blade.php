<x-app-layout>
    <x-slot name="header">
        <h2 class="absolute left-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
        <a href="{{route('person.create')}}" class="absolute right-0 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Create</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 space-y-6">
                <form id="peopleSearch" action="{{route('person.index')}}" method="GET">
                    @csrf
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="search" name="peopleSearchString" value="{{request()->peopleSearchString}}" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search People here..." autofocus>
                        <button type="submit" id="parentSearchSubmit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th class="py-3 px-6">
                                        Name
                                    </th>
                                    <th class="py-3 px-6">
                                        Parent name
                                    </th>
                                    <th class="py-3 px-6">
                                        Surname
                                    </th>
                                    <th class="py-3 px-6">
                                        Relation
                                    </th>
                                    <th class="py-3 px-6">
                                        Is Died
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
                                @if ($data_count == 0)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td colspan="3" class="py-4 px-6 text-center">No data found</td>
                                    </tr>
                                @endif
                                @foreach ($people as $person)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{$person->name}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{$person->parent ? $person->parent->name : 'SELF'}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{$person->surname->gujarati_word}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{strtoupper($person->relation == 0 ? 'Self' : ($person->relation == 1 ? 'father' : ($person->relation == 2 ? 'husbund' : 'wife')))}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{strtoupper($person->is_died)}}
                                        </td>
                                        <td class="py-4">
                                            {{$person->address}}
                                        </td>
                                        <td class="py-4">
                                            <a href="{{route('person.edit',$person->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                            <form method="POST" action="{{ route('person.destroy',$person->id) }}">
                                                @csrf
                                                @method('DELETE')
                    
                                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                        onclick="if(confirm('Delete {{$person->name.' '.$person->surname->english_word}}?') == true){event.preventDefault();this.closest('form').submit();}">
                                                    {{ __('Delete') }}
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><br>
                    {{ $people->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
