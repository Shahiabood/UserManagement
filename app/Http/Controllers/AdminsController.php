<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App \Models\Admin;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        $data = [
            'scope' => 'create',
        ];
        return view('userlist.form')->with($data);
    }

    public function storeUser(Request $request)
    {
        try
        {
            $userlist = new Admin;
            $userlist->first_name = $request->get('first_name');
            $userlist->family_name = $request->get('family_name');
            $userlist->email = $request->get('email');
            $userlist->user_name = $request->get('user_name');
            $userlist->dob = $request->get('dob');
            $userlist->gender = $request->get('gender');
            $userlist->phone_number = $request->get('phone_number');
            $userlist->role = $request->get('role');
            $userlist->password = $request->get('password');
            $userlist->save();

            return response()->json([
                'status' => 200,
                'message' => 'User saved successfully',
            ]);

        }
        catch(Exception $e)
        {
            dd($e);
        }
    }

    /**
     * function gets data of users
     */
    public function index()
    {
        return view('userlist.index');
    }

    /**
     * getting  all users for list page
     */
    public function getUserData(Request $request)
    {
        try{

            $query = Admin::select('id','first_name','family_name','email','user_name','gender','phone_number','role');
            
            if($request->searchQuery)
            {
                $query->where(function($q) use ($request) {
                    $q->orWhere('first_name', 'like', '%'.$request->searchQuery.'%');
                    $q->orWhere('family_name', 'like', '%'.$request->searchQuery.'%');
                    $q->orWhere('email', 'like', '%'.$request->searchQuery.'%');
                    $q->orWhere('user_name', 'like', '%'.$request->searchQuery.'%');
                    $q->orWhere('gender', 'like', $request->searchQuery);
                    $q->orWhere('phone_number', 'like', '%'.$request->searchQuery.'%');
                    $q->orWhere('role', 'like', '%'.$request->searchQuery.'%');
                });
            }

            $userData = $query->get();

            return $userData;
            //return Admin::all();
        }
        catch(Exception $e)
        {
            dd($e);
        }
    }

    //edit page
    public function edit($id)
    {
        $data = [
            'scope' => 'edit',
            'id' => $id
        ];

        return view('userlist.form')->with($data);
    }

    /**
     * get single user data
     */
    public function getUserDataById($id)
    {
        $userData = Admin::find($id);

        return response() ->json([
            'status' => 200,
            'data' => $userData,
        ]);
    }

    //update each user
    public function update(Request $request, $id)
    {
        try
        {
            $userlist = Admin::find($id);
            $userlist->first_name = $request->first_name;
            $userlist->family_name = $request->family_name;
            $userlist->email = $request->email;
            $userlist->user_name = $request->user_name;
            $userlist->dob = $request->dob;
            $userlist->gender = $request->gender;
            $userlist->phone_number = $request->phone_number;
            $userlist->role = $request->role;
            $userlist->password = $request->password;
            $userlist->update();

            return response()->json([
                'status' => 200,
                'message' => 'User updated successfully',
            ]);
        }
        catch(Exception $e)
        {
            dd($e);
        }
    }

     /**
     * function for deleting users
     */
    public function destroy($id)
    {      
        try
        {
            $user = Admin::find($id);
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'User deleted successfully',
            ]);
        }
        catch(Exception $e)
        {
            dd($e);
        }
    }
}
