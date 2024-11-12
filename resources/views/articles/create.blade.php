<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
           <h2> {{ __('Articles/Create')}}</h2>
           <a href="{{ route('articles.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
       </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{  route('articles.store') }}" method="post" >
                        @csrf
                        <div class="my-3">
                            <label for="title" class="text-sm font-medium">Title</label>
                            <div class="mb-3">
                                <input type="text" name="title" value="{{  old('title')}}"  id="title" placeholder="Enter Title"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" >
                                @error('title')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                            <label for="text" class="text-sm font-medium">Text</label>
                            <div class="mb-3">
                                <textarea name="text" id="text" value="{{  old('text')}}" placeholder="Enter Text"  class="border-grey-300 shadow-sm w-1/2 rounded-lg"   rows="10"></textarea>
                                @error('text')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                            <label for="author" class="text-sm font-medium">Author</label>
                            <div class="mb-3">
                                <input type="text" name="author" value="{{  old('author')}}"  id="author" placeholder="Enter Author"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" >
                                @error('author')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3" >Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
