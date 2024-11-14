<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
           <h2> {{ __('User/Create')}}</h2>
           <a href="{{ route('users.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
       </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{  route('users.store') }}" method="post" >
                        @method('PUT')
                        @csrf
                        <div class="my-3">
                            <label for="name" class="text-sm font-medium">Name</label>
                            <div class="mb-3">
                                <input type="text" name="name" value="{{ old('name') }}"  id="name" placeholder="Enter Name"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('name')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>
                            <label for="email" class="text-sm font-medium">Email</label>
                            <div class="mb-3">
                                <input type="text" name="email" value="{{ old('email') }}"  id="email" placeholder="Enter Email"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('email')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                            <label for="password" class="text-sm font-medium">Password</label>
                            <div class="mb-3">
                                <input type="password" name="password" value="{{ old('password') }}"  id="password" placeholder="Enter Password"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('password')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                            <label for="confirm_password" class="text-sm font-medium">Confirm Password</label>
                            <div class="mb-3">
                                <input type="password" name="confirm_password" value="{{ old('confirm_password') }}"  id="confirm_password" placeholder="Confirm Password"  class="border-grey-300 shadow-sm w-1/2 rounded-lg" id="">
                                @error('confirm_password')
                                    <p class="text-red-400">  {{ $message }}</p>
                                @enderror
                            </div>

                        <div class="grid grid-cols-4 mb-3">
                            @if ($roles->isNotEmpty())

                                @foreach ($roles as $role)
                                <div class="mt-3">

                                    <input    type="checkbox" class="rounded"  id="role-{{ $role->id }}" name="role[]"
                                        value="{{ $role->name }}">
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                                @endforeach
                            @endif
                    </div>
                        </div>
                        <button type="submit" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3" >Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
