<x-app-layout>
    <x-slot name="header">
        <h2 class="absolute left-0 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surname') }}
        </h2>
        <a href="{{route('surname.create')}}" class="absolute right-0 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'">Create</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th class="py-3 px-6">
                                        Gujarati Word
                                    </th>
                                    <th class="py-3">
                                        English Word
                                    </th>
                                    <th class="py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($surnames::count() == 0)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td colspan="3" class="py-4 px-6 text-center">No data found</td>
                                    </tr>
                                @endif
                                @foreach ($surnames::all() as $surname)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="py-4 px-6">
                                            {{$surname->gujarati_word}}
                                        </td>
                                        <td class="py-4">
                                            {{$surname->english_word}}
                                        </td>
                                        <td class="py-4">
                                            <a href="{{route('surname.edit',$surname->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                            <form method="POST" action="{{ route('surname.destroy',$surname->id) }}">
                                                @csrf
                                                @method('DELETE')
                    
                                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                                        onclick="if(confirm('Sure?') == true) {event.preventDefault();this.closest('form').submit();} ">
                                                    {{ __('Delete') }}
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
