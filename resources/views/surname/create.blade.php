<x-app-layout>
    <x-slot name="header">
        <h2 class="absolute left-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Surname') }}
        </h2>
        <a href="{{route('surname.index')}}" class="absolute right-0 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('surname.store') }}">
                        @csrf
            
                        <!-- Gujarati Word -->
                        <div>
                            <x-label for="gujarati_word" :value="__('ગુજરાતી શબ્દ')" />
                            <x-input id="gujarati_word" class="block mt-1 w-full" type="text" name="gujarati_word" :value="old('gujarati_word')" required autofocus />
                        </div>
                        <br>
                        <!-- Englush Word -->
                        <div>
                            <x-label for="english_word" :value="__('English Word')" />
                            <x-input id="english_word" class="block mt-1 w-full" type="text" name="english_word" :value="old('english_word')" required/>
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
</x-app-layout>
