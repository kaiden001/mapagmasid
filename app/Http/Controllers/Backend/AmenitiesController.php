<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenities;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use App\Events\AmenitiesUpdated;
use Illuminate\Support\Facades\DB;

class AmenitiesController extends Controller
{
    public function CountAmenities()
    {

        $data = Amenities::all()->count();
        return response()->json($data);
    }
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

        // Create a new amenity and get the created instance
        $amenity = Amenities::create([
            'amenities_name' => $request->amenities_name
        ]);

        // Broadcast the event with the newly created amenity
        event(new AmenitiesUpdated($amenity));

        // Prepare success notification
        $notification = [
            'message' => 'Amenity Created Successfully',
            'alert-type' => 'success'
        ];

        // Send response
        return response()->json($notification);
    }

    // public function GetAmenitiesData()
    // {

    //     $data = Amenities::all();
    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->make(true);
    // }
    // public function GetAmenitiesData()
    // {
    //     $data = Amenities::select('id', 'amenities_name')->paginate(10);

    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($row) {
    //             // Add your custom action buttons here
    //         })
    //         ->make(true);
    // }
    // public function GetAmenitiesData()
    // {
    //     $data = Amenities::select('id', 'amenities_name')->limit(100000)->get();

    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($row) {
    //             // Add your custom action buttons here
    //         })
    //         ->make(true);
    // }
    public function GetAmenitiesData(Request $request)
    {
        $perPage = 10; // Number of records per page
        $searchQuery = $request->input('search');
        $query = DB::table('amenities');

        // Apply search filter if search query is provided
        if ($searchQuery) {
            $query->where('amenities_name', 'like', '%' . $searchQuery . '%');
        }

        // Paginate the filtered query results
        $data = $query->paginate($perPage);

        return response()->json($data);
    }
    // public function GetAmenitiesData()
    // {
    //     $data = Amenities::all();
    //     $encryptedData = Crypt::encrypt($data);
    //     // Return JSON response with encrypted data
    //     return response()->json(['data' => $encryptedData]);
    // }

}
