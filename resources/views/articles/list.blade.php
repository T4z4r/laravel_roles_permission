<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2> {{ __('Permissions') }}</h2>
            <a href="{{ route('articles.create') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-message></x-message>
                    @if ($articles->isNotEmpty())

                    <table class="table table-auto w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">Title</th>
                                <th class="px-6 py-3 text-left">Author</th>
                                <th class="px-6 py-3 text-left" width="200">Created At</th>
                                <th class="px-6 py-3 text-center" with="180">Action</th>
                            </tr>

                        </thead>
                        <tbody class="bg-white">
                                @foreach ($articles as $article)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">{{ $count++ }}</td>
                                        <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                                        <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                                        <td class="px-6 py-3 text-left">{{  \Carbon\Carbon::parse($article->created_at)->format('d M,Y') }}</td>
                                        <td class="px-6 py-3 text-center">


                                            <a href="{{ route('articles.show',$article->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 me-2 hover:bg-slate-600">
                                                View
                                            </a>

                                            <a href="{{ route('articles.edit',$article->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 me-2 hover:bg-slate-600">
                                                Edit
                                            </a>

                                            <form action="{{ route('articles.destroy',$article->id) }}" method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach


                        </tbody>

                    </table>

                    <div class="my-3">
                        {{ $articles->links() }}

                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">

    </x-slot>
</x-app-layout>
