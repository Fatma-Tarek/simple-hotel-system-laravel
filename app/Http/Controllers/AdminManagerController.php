<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class AdminManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Manager $manager)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'NationalID' => ['required', 'unique:managers'],
            'email' =>  ['required', 'unique:managers'],
            'password' => ['required','min:6'],
            'avatar' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $manager->storeData($request->all());

        return response()->json(['success'=>'Manager added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager,$id)
    {
        $manager = new Manager;
        $data = $manager->findData($id);
        $html = '<div class="form-group">
                    <label for="username">User Name:</label>
                    <input type="text" class="form-control" name="username" id="editUserName" value="'.$data->username.'">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="editEmail" value="'.$data->email.'">
                </div>
                <div class="form-group">
                    <label for="NationalID">National ID:</label>
                    <input type="text" class="form-control" name="NationalID" id="editNationalID" value="'.$data->NationalID.'">
                </div>';


        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'NationalID' => 'required',
            'email' => 'required',

        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $manager = new Manager;
        $manager->updateData($id, $request->all());

        return response()->json(['success'=>'Manager updated successfully']);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $manager = new Manager;
        $manager->deleteData($id);

        return response()->json(['success'=>'Manager deleted successfully']);
    }
}