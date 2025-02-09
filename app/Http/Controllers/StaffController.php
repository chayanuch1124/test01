<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // GET SEARCH KEYWORD
        $keyword = $request->get('search');
        // DEFINE ITEM PER PAGE
        $perPage = 8;

        if (!empty($keyword)) {
            //CASE SEARCH, show some
            $staff = Staff::where('title', 'LIKE', "%$keyword%")
                // ->orWhere('content', 'LIKE', "%$keyword%")
                // ->orWhere('price', 'LIKE', "%$keyword%")
                // ->orWhere('cost', 'LIKE', "%$keyword%")
                // ->orWhere('photo', 'LIKE', "%$keyword%")
                // ->orWhere('stock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            // CASE NOT SEARCH, show all
            $staff = Staff::latest()->paginate($perPage);
        }

        return view('staff.index', compact('staff'));
        // return view('product.index2', compact('products'));
        // return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            // 'photo' => 'required',
        ]);

        // GET ALL DATA SUBMIT FROM <form></form>
        $requestData = $request->all();

        // FOR UPLOAD
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('', 'public');
            $requestData['photo'] = url(Storage::url($path));
        }

        //CREATE A RECORD
        Staff::create($requestData);

        return redirect('staff')->with('success', 'Staff created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //QUERY by id
        $staff = Staff::findOrFail($id);

        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //QUERY by id
        $staff = Staff::findOrFail($id);

        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //validation
        $request->validate([
            'title' => 'required',
            'salary' => 'required',
            // 'photo' => 'required',
        ]);

        // GET ALL DATA SUBMIT FROM <form></form>
        $requestData = $request->all();

        // FOR UPLOAD A NEW FILE WITHOUT DELETE THE OLD FILE
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('', 'public');
            $requestData['photo'] = url(Storage::url($path));
        }

        //UPDATE A RECORD
        $staff = Staff::findOrFail($id);
        $staff->update($requestData);

        return redirect('staff')->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //DELETE by id
        Staff::destroy($id);

        return redirect('staff')->with('success', 'Staff deleted successfully.');
    }
}