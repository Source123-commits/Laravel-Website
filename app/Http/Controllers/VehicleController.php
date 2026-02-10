<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Vehicle;
use Illuminate\Routing\Controllers\HasMiddleware;
use  Illuminate\Routing\Controllers\Middleware;


class VehicleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
       return[
            new Middleware('permission:view vehicles', only: ['index']),
            new Middleware('permission:edit vehicles', only: ['edit']),
            new Middleware('permission:create vehicles', only: ['create']),
            new Middleware('permission:delete vehicles', only: ['destroy']),
        ];
    }
    public function index()
    {
        
        $vehicles = Vehicle::orderBy('created_at', 'ASC')->paginate(25);
        return view('vehicles.list', [
            'vehicles' => $vehicles
        ]);
    }

    public function create()
    {    
       return view('vehicles.create');
    }

    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'Name' => 'required|min:3',
            'Brand' => 'required|min:3',
            'Model' => 'required|min:3'
        ]);
        if ($validator->passes()) {
           $vehicles = new Vehicle();
            $vehicles->Name = $request->Name;
            $vehicles->Brand = $request->Brand;
            $vehicles->Model = $request->Model;
           
           $vehicles->save();
            return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
        } else {
            return redirect()->route('vehicles.create')->withInput()->withErrors($validator);
        } 
    }
    public function edit(string $id){
         $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', [
            'vehicle' => $vehicle
        ]);
    }

    public function destroy(Request $request)
    {
        $vehicle = Vehicle::find($request->id);
        if ($vehicle==null) {
            session()->flash('error', 'Vehicle not found.');
            return response()->json([
                'status' => false
            ]);
        }
        $vehicle->delete();
        session()->flash('success', 'Vehicle deleted successfully.');
        return response()->json([
            'status' => true
        ]);
       
    }
    public function update( Request $request,string $id){
             $vehicle = Vehicle::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'Name' => 'required|min:3',
                'Model' => 'required|min:3'
            ]);
            if ($validator->passes()) {
                $vehicle->Name = $request->Name;
                $vehicle->Brand = $request->Brand;
                $vehicle->Model = $request->Model;
            
            $vehicle->save();
                return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
            } else {
                return redirect()->route('vehicles.edit', $id)->withInput()->withErrors($validator);
            }

        
    }
    
            
}
