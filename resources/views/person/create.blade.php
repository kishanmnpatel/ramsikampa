<x-app-layout>
    <x-slot name="header">
        <h2 class="absolute left-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Person') }}
        </h2>
        <a href="{{route('person.index')}}" class="absolute right-0 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('person.store') }}">
                        @csrf
            
                        <!-- name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        </div>

                        <!-- surname -->
                        <div class="mt-4">
                            <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select a surname</label>
                            <select id="surname" name="surname_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected="" value="">Choose a surname</option>
                                @foreach ($surnames::all() as $surname)
                                    <option value="{{$surname->id}}">{{$surname->gujarati_word}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- mobile -->
                        <div class="mt-4">
                            <x-label for="mobile" :value="__('Mobile')" />
                            <x-input id="mobile" class="block mt-1 w-full" type="text" mobile="mobile" :value="old('mobile')"/>
                        </div>

                        <!-- address -->
                        <div class="mt-4">
                            <x-label for="address" :value="__('Address')" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="રામસીકંપા" required/>
                        </div>

                        <!-- age -->
                        <div class="mt-4 w-48">
                            <x-label for="age" :value="__('Age')" />
                            <x-input id="age" class="block mt-1 w-full" type="number" name="age" value="0" required/>
                        </div>

                        <!-- gender -->
                        <div class="mt-4 w-48">
                            <x-label for="address" :value="__('Gender')" />
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="female" type="radio" value="female" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="female" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="male" type="radio" value="male" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="male" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Select parent -->
                        <x-label for="parent" :value="__('Select a parent')" />
                        <input type='hidden' value='0' name='parent_id' id="parent_id">
                        <button class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="parent-modal">
                            Select
                        </button>
                        <div id="selectedParentName" class="text-green"></div>
                        
                        <!-- relation -->
                        <div class="mt-4 w-[26rem]">
                            <x-label for="address" :value="__('Relation to parent')" />
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="self" type="radio" value="{{$person::SELF}}" name="relation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="self" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Self</label>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="father" type="radio" value="{{$person::FATHER}}" checked name="relation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="father" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Father</label>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="husbund" type="radio" value="{{$person::HUSBUND}}" name="relation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="husbund" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Husbund</label>
                                    </div>
                                </li>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="wife" type="radio" value="{{$person::WIFE}}" name="relation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="wife" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Wife</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- is_daughter -->
                        <div class="flex items-center mb-4 mt-4">
                            <input type='hidden' value='false' name='is_daughter'>
                            <input id="is_daughter" type="checkbox" value="true" name="is_daughter" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_daughter" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is daughter</label>
                        </div>
                        <!-- is_married -->
                        <div class="flex items-center mb-4 mt-4">
                            <input type='hidden' value='false' name='is_married'>
                            <input id="is_married" type="checkbox" value="true" name="is_married" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_married" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is married</label>
                        </div>
                        <!-- is_died -->
                        <div class="flex items-center mb-4 mt-4">
                            <input type='hidden' value='false' name='is_died'>
                            <input id="is_died" type="checkbox" value="true" name="is_died" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_died" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Died</label>
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Parent Modal -->
    <div id="parent-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Select Parent
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="parent-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form id="parentSearch">
                        @csrf
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" name="parentSearchString" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Parent here..." required autofocus>
                            <button type="submit" id="parentSearchSubmit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                    <div id="searchParentTable"></div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    {{-- <button data-modal-toggle="parent-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button> --}}
                    <button id="parent-modal-close-button" data-modal-toggle="parent-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script"> 
        <script type ="text/javascript">
            function setParent(name,id) {
                $('#parent_id').val(id); 
                document.getElementById("selectedParentName").innerHTML = name;  
                document.getElementById("parent-modal-close-button").click();
            }
            $('#parentSearch').on("submit", function(event){  
                event.preventDefault();  
                $.ajax({  
                     url:"/searchParent",  
                     method:"POST",  
                     data:$('#parentSearch').serialize(),  
                     beforeSend:function(){  
                          $('#parentSearchSubmit').val("Searching...");  
                     },  
                     success:function(data){ 
                          $('#parentSearchSubmit').val("Search");
                          document.getElementById("searchParentTable").innerHTML = data;  
                     },
                     error:function(data){
                          document.getElementById("searchParentTable").innerHTML = data;
                     }
                });  
            });
        </script>
    </x-slot>
</x-app-layout>
