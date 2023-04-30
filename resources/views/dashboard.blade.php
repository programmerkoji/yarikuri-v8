<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 min-w-max">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-2 text-center bg-gray-50 sticky top-0 left-0">
                                        &nbsp;
                                    </th>
                                    @foreach ($items as $item)
                                        <th scope="col" class="px-3 py-2 text-center">
                                            <p class="mb-1">{{$item->name}}</p>
                                            <p>{{number_format($item->price)}}円</p>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($months as $month)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-white sticky top-0 left-0">
                                            {{$month->year}}年{{$month->month}}月
                                        </th>
                                        @foreach ($items as $item)

                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    <form id="check_{{$item->id}}{{$month->id}}" method="post" action="{{route("dashboard.store")}}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="">
                                                        <input type="hidden" name="item_id" value="{{$item->id}}">
                                                        <input type="hidden" name="month_id" value="{{$month->id}}">
                                                        <input
                                                            id="default-checkbox"
                                                            type="checkbox"
                                                            name="is_checked"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                            @if ($item->months->where('id', $month->id)->first() && $item->months->where('id', $month->id)->first()->pivot->is_checked)
                                                                checked
                                                            @endif
                                                            onclick="checkPost(this)"
                                                            data-id="{{$item->id}}{{$month->id}}">
                                                    </form>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{$months->links('vendor.pagination.simple-tailwind')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkPost(e) {
            'use strict';
            document.getElementById('check_' + e.dataset.id).submit();
        }
    </script>
</x-app-layout>
