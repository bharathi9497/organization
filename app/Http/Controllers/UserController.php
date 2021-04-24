<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\OrgUser;
use App\Models\Organization;

class UserController extends Controller
{


    public function submit()
    {
        return view("users");
    }


    public function add(Request $request)
    {

        $rules = array(
            'name' => 'required'        
        );


        foreach($request->user as $key => $value) {
            $rules["user.{$key}.name"] = 'required';
            $rules["user.{$key}.email"] = 'required | email';
            $rules["user.{$key}.mobile_number"] = 'required | numeric';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {

            $org = new Organization();
            $org->name = $request->name;
            $org->save();

            foreach ($request->user as $key => $value) {

                $value['org_id'] = $org->id;           
                OrgUser::create($value);
                        
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
    
   
}
