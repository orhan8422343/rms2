<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\IntroPoint;
use Validator;
use Session;

class IntroPointController extends Controller
{
    public function index(Request $request)
    {

        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['features'] = IntroPoint::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['lang_id'] = $lang_id;
        return view('admin.home.intro_point.index', $data);
    }

    public function edit($id)
    {
        $data['feature'] = IntroPoint::findOrFail($id);
        return view('admin.home.intro_point.edit', $data);
    }

    public function store(Request $request)
    {
        
        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'title' => 'required|max:100',
            'serial_number' => 'required|integer',
            'icon' =>'nullable|max:50|string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
           
            return response()->json($validator->errors());
        }

        $introPoint = new IntroPoint;
        if($request->icon){

            $introPoint->icon= $request->icon;
        }
        $introPoint->language_id = $request->language_id;
        $introPoint->title = $request->title;


        if($request->has('text')){

            $introPoint->text = $request->text;
        }
        $introPoint->serial_number = $request->serial_number;

        if($request->has('intro_section_rating_point')){
            $introPoint->intro_section_rating_point = $request->intro_section_rating_point;
        }
        if($request->has('intro_section_rating_symbol')){
            $introPoint->intro_section_rating_symbol = $request->intro_section_rating_symbol;
        }
        $introPoint->save();

        Session::flash('success', 'Intro Point added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',
            'icon' =>'nullable|max:50|string'
        ];

        $request->validate($rules);

        $introPoint = IntroPoint::findOrFail($request->feature_id);
        $introPoint->title = $request->title;
        if($request->has('icon')){

            $introPoint->icon= $request->icon;
        }
        if($request->has('text')){
        $introPoint->text =$request->text;
        }

        if($request->has('intro_section_rating_point')){
            $introPoint->intro_section_rating_point = $request->intro_section_rating_point;
        }
        if($request->has('intro_section_rating_symbol')){
            $introPoint->intro_section_rating_symbol = $request->intro_section_rating_symbol;
        }
        $introPoint->serial_number = $request->serial_number;
        $introPoint->save();

        Session::flash('success', 'Intro Point Updated Successfully!');
        return back();
    }

    public function delete(Request $request)
    {
       
        $IntroPoint = IntroPoint::findOrFail($request->feature_id);
        $IntroPoint->delete();
        Session::flash('success', 'Feature deleted successfully!');
        return back();
    }

 
}
