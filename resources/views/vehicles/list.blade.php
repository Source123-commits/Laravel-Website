<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
        </h2>
        
        <a href="{{route('vehicles.create')}}" class="bg-slate-700 text-sm px-3 py-2 rounded-md text-white">Create</a>
        
        </div>
    </x-slot>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message ></x-message>
               <table class="w-full">
                 <thead class="bg-gray-50">

                <tr class="border-b">
                    <th class="px-6 py-3 text-left" width="60">#</th>
                    <th class="px-6 py-3 text-center">Name</th>
                    <th class="px-6 py-3 text-center">Brand</th>
                    <th class="px-6 py-3 text-center">Model</th>
                    <th class="px-6 py-3 text-center" width="180">Created</th>
                    <th class="px-6 py-3 text-center" width="200">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @if($vehicles->isNotEmpty())
                        @foreach($vehicles as $vehicle)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">
                                {{$vehicle->id}}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{$vehicle->Name}}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{$vehicle->Brand}}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{$vehicle->Model}}
                            </td>
                            <td class="px-6 py-3 text-center">
                                {{$vehicle->created_at->format('d M Y')}}
                            </td>
                            <td class="px-6 py-3 text-center">
                                @can('edit vehicles')
                                
                               <a href="{{ route("vehicles.edit", $vehicle->id) }}" class="bg-white-500 text-sm px-2 py-0 rounded-md text-black hover:bg-slate-500">Edit</a>
                                 @endcan

                                @can('delete vehicles')
                                <a href="javascript:void(0);" onclick="deleteVehicle('{{ $vehicle->id }}')" class="bg-blue-500 text-sm px-2 py-0 rounded-md text-white hover:bg-slate-500">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
               <div class="my-3">
               {{ $vehicles->links() }}
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deleteVehicle(id){
                if(confirm("Are you sure to delete this vehicle?")){
                    $.ajax({
                        url: '{{ route("vehicles.destroy") }}',
                        type: 'delete',
                        data: {
                        id: id
                    },
                    dataType: 'json',
                    headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success: function(response){
                            window.location.href = '{{ route("vehicles.index") }}';
                        }
                    });
                }
            }
            </script>

    </x-slot>
</x-app-layout>