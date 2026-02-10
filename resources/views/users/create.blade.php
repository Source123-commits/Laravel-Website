<x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users / Create
        </h2>
        
        <a href="{{route('users.index')}}" class="bg-slate-700 text-sm px-3 py-2 rounded-md text-white ">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                  <div>
                    <label for=""class="text-sm font-medium">Name</label>
                      <div class="my-3">
                        <input value="{{ old('name') }}"name="name" placeholder="Enter name" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('name')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>
                    <label for=""class="text-sm font-medium">Email</label>
                      <div class="my-3">
                        <input value="{{ old('email') }}"name="email" placeholder="Enter email" type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('email')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>
                    <label for=""class="text-sm font-medium">Password</label>
                      <div class="my-3">
                        <input value="{{ old('password') }}"name="password" placeholder="Enter password" type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('password')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>

                    <label for=""class="text-sm font-medium">Confirm Password</label>
                      <div class="my-3">
                        <input value="{{ old('confirm_password') }}"name="confirm_password" placeholder="Confirm  Your Password" type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('confirm_password')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>

                    <div class="flex gap-4 mb-4">
                        @if ($roles->isNotEmpty())
                            @foreach($roles as $role)
                                
                       <div class="mt-3">

                        <input    type="checkbox" id="role-{{ $role->id }}" class="rounded" name="role[]" value="{{ $role->name }}" />
                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                       </div>
                       @endforeach
                          @endif

                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Create</button>
                
                  </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
