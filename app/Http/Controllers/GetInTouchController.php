<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\GetInTouch;
use Illuminate\Http\Request;
use App\Exports\GetInTouchExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class GetInTouchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_in_touch = GetInTouch::orderBy('created_at', 'DESC')->get(['id', 'name',  'created_at', 'company_name', 'contact_number', 'email', 'message']);
        return response()->json($get_in_touch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_in_touch = GetInTouch::get(['id', 'name', 'email', 'company_name', 'contact_number', 'message']);
        $get_in_touch->created_at = Carbon::parse($get_in_touch->created_at)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        return response()->json($get_in_touch);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
            'contact_number' => 'required|numeric|digits_between:10,15',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {
            $newRecord = GetInTouch::create($request->all());
            return response()->json(['message' => 'Record added successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg', $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_in_touch = GetInTouch::get(['id', 'name', 'company_name', 'contact_number', 'email', 'message', 'created_at']);
        $get_in_touch->created_at = Carbon::parse($get_in_touch->created_at)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        return response()->json($get_in_touch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $get_in_touch = GetInTouch::find($id);
        return response()->json($get_in_touch);
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
        try {
            $getInTouch = GetInTouch::findOrFail($id);

            $getInTouch->update($request->all());

            return response()->json(['message' => 'Record updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $social = GetInTouch::find($id);
        try {
            $social->delete();
            return response()->json(['message' => 'Record deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function table()
    {
        $get_in_touches = GetInTouch::orderBy('created_at', 'DESC')->get();
        return view('get-in-touch.index', compact('get_in_touches'));
    }
    public function export(Request $request)
    {
        $stDate = $request->input('start_date');

        $edDate = $request->input('end_date');
        $startDate = Carbon::createFromFormat('Y-m-d', $stDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $edDate);
        $startDate = $startDate->format('Y-m-d');
        $endDate =  $endDate->format('Y-m-d');
        // return gettype($endDate);

        return Excel::download(new GetInTouchExport($startDate, $endDate), 'exported_data.xlsx');
    }
}
