<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenities;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

class AmenitiesController extends Controller
{
    public function AllAmenities()
    {

        // $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities');
    }
    public function GetAmenitiesModal()
    {
        // $amenities = Amenities::latest()->get();
        $id = request('id');
        $amenitiesData = Amenities::find($id);
        return view('backend.amenities.amenities_modal.amenities_modal', ['amenitiesData' => $amenitiesData]);
    }
    public function StoreAmenities(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:amenities,amenities_name|max:200'
        ]);
        Amenities::insert([
            'amenities_name' => $request->amenities_name
        ]);
        $notification = array(
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }
    // public function GetAmenitiesData()
    // {

    //     $data = Amenities::all();
    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->make(true);
    // }
    public function GetAmenitiesData()
    {
        $data = Amenities::all(['id', 'amenities_name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // Add any additional columns or custom formatting here if needed
                return '<div onclick ="displayModal(' . $row->id . ')" class="d-flex gap-2"><button class="btn btn-inverse-warning btn-sm">Edit</button><button class="btn btn-inverse-danger btn-sm">Delete</button></div>';
            })
            ->make(true);
    }
    // public function GetAmenitiesData()
    // {
    //     $data = Amenities::all();
    //     $encryptedData = Crypt::encrypt($data);
    //     // Return JSON response with encrypted data
    //     return response()->json(['data' => $encryptedData]);
    // }

}
