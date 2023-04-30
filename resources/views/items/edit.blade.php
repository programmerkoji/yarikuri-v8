<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <form action="{{ route('items.update', ['item' => $item->id]) }}" method="post" class="lg:w-3/4 mx-auto devide devide-y">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col lg:flex-row gap-4">
                            <div class="w-full">
                                <label for="name" class="leading-7 text-sm text-gray-600">項目名</label>
                                <input type="name" id="name" name="name" value="{{ $item->name }}" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('name')
                                    <span class="block text-rose-700 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="price" class="leading-7 text-sm text-gray-600">金額</label>
                                <input type="price" id="price" name="price" value="{{ $item->price }}" class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('price')
                                    <span class="block text-rose-700 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex gap-2 items-center flex-wrap">
                            <button class="text-white bg-blue-500 border-0 mt-4 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">更新する</button>
                            <a href="{{route('items.index')}}" class="text-white bg-gray-500 border-0 mt-4 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
