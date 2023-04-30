<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="py-4">
                        <a href="{{route('items.create')}}" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">項目追加</a>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 min-w-max">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-4">
                                        項目名
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center">
                                        金額
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-center">
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                {{$item->name}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end">
                                                {{number_format($item->price)}}円
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{route('items.edit', ['item' => $item->id])}}" class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">編集</a>
                                                <form id="delete_{{$item->id}}" action="{{route('items.destroy', ['item' => $item->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" data-id="{{$item->id}}" onclick="deletePost(this)" class="inline-flex text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded">削除</a>
                                                </form>
                                            </div>
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
    <script>
        function deletePost(e) {
            console.log(e);
            'use strict';
            if (confirm('本当に削除してもよいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
    @if (session('message'))
        <script>
            $(function() {
                toastr.success('{{ session("message") }}')
            });
        </script>
    @elseif (session('alert'))
    <script>
        $(function() {
            toastr.warning('{{ session("alert") }}')
        });
    </script>
    @endif
</x-app-layout>
