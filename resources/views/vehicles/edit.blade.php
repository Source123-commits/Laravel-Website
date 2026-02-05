<x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vehicles / Edit
        </h2>
        
        <a href="{{route('vehicles.index')}}" class="bg-slate-700 text-sm px-3 py-2 rounded-md text-white ">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                  <div>
                    <label for=""class="text-sm font-medium">Name</label>
                      <div class="my-3">
                        <input value="{{ old('Name', $vehicle->Name) }}" name="Name" placeholder="Enter Name" type="text" class="border border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('Name')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>
                    <label for=""class="text-sm font-medium">Brand</label>
                      <div class="my-3">
                        <textarea  name="text" placeholder="Enter Brand Name" id="text" class="border border-gray-300 shadow-sm w-1/2 rounded-lg" cols="30" rows="10">{{ old('text', $vehicle->text) }}</textarea>
                        @error('Brand')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>
                    <label for=""class="text-sm font-medium">Model</label>
                      <div class="my-3">
                        <input value="{{ old('Model', $vehicle->Model) }}" name="Model" placeholder="Enter Model Number" type="text" class="border border-gray-300 shadow-sm w-1/2 rounded-lg"> 
                        @error('Model')
                          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror                     
                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
                
                  </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
