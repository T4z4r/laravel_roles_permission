<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
           <h2> {{ __('User/Edit')}}</h2>
           <a href="{{ route('users.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
       </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{  route('users.update',$user->id) }}" method="post" >
                        @method('PUT')
                        @csrf
                        <div class="my-3">
                            <label for="name" class="text-sm font-medium">Name</label>
                            <div class="mb-3">
                                <input type="text" name="name" value="{{ $user->name }}"  id="name" placeholder="Enter Name"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('name')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>
                            <label for="email" class="text-sm font-medium">Email</label>
                            <div class="mb-3">
                                <input type="text" name="email" value="{{ $user->email }}"  id="email" placeholder="Enter Email"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('email')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>


                        <div class="grid grid-cols-4 mb-3">
                            @if ($roles->isNotEmpty())

                                @foreach ($roles as $role)
                                <div class="mt-3">

                                    <input  {{ $hasRoles->contains($role->id)?'checked':'' }}  type="checkbox" class="rounded"  id="role-{{ $role->id }}" name="role[]"
                                        value="{{ $role->name }}">
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                                @endforeach
                            @endif
                    </div>
                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3" >Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
