<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Feature;
use Validator;
use Session;
use App\Models\BasicSetting as BS;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['features'] = Feature::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['lang_id'] = $lang_id;
        $data['abs'] = $lang->basic_setting;
        return view('admin.home.feature.index', $data);
    }

    public function edit($id)
    {
        $data['feature'] = Feature::findOrFail($id);
        return view('admin.home.feature.edit', $data);
    }

    public function store(Request $request)
    {

        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'image' => 'required',
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',

            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/front/img/features/'), $main_image);
            $image = $main_image;
        }else{
            $image = null;
        }

        $feature = new Feature;
        $feature->image = $image;
        $feature->language_id = $request->language_id;
        $feature->title = $request->title;
        $feature->serial_number = $request->serial_number;
        $feature->save();

        Session::flash('success', 'Feature added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',

            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $request->validate($rules);

        $feature = Feature::findOrFail($request->feature_id);

        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            @unlink(public_path('assets/front/img/features/' . $feature->image));
            $request->file('image')->move(public_path('assets/front/img/features/'), $main_image);
            $feature->image = $main_image;
        }



        $feature->title = $request->title;
        $feature->serial_number = $request->serial_number;
        $feature->save();

        Session::flash('success', 'Feature updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {

        $feature = Feature::findOrFail($request->feature_id);
        @unlink(public_path('assets/front/img/features/' . $feature->image));
        $feature->delete();

        Session::flash('success', 'Feature deleted successfully!');
        return back();
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $featId = $request->feature_id;

        $feature = Feature::findOrFail($featId);

        if ($type == "feature") {
            @unlink(public_path("assets/front/img/features/" . $feature->image));
            $feature->image = NULL;
            $feature->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
    public function title(Request $request)
    {
        # code...
    }
    public function titleUpdate(Request $request)
    {
        # code...
    }
    public function featureSection(Request $request, $langid)
    {
    
        $currentLang = Language::find($langid);
        $bs = $currentLang->basic_setting;
        $activeTheme = $bs->theme;

        $features_section_top_shape_image = $request->file('features_section_top_shape_image');
        $features_section_bottom_shape_image = $request->file('features_section_bottom_shape_image');

        $allowedExts = array('jpg', 'png', 'jpeg');
        $rules = [
            'features_section_top_shape_image' => [
                function ($attribute, $value, $fail) use ($request, $features_section_top_shape_image, $allowedExts) {
                    if ($request->hasFile('features_section_top_shape_image')) {
                        $ext = $features_section_top_shape_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'features_section_bottom_shape_image' => [
                function ($attribute, $value, $fail) use ($request, $features_section_bottom_shape_image, $allowedExts) {
                    if ($request->hasFile('features_section_bottom_shape_image')) {
                        $ext = $features_section_bottom_shape_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
       
        ];
        
        $rules['feature_title'] = 'required';
        // if($activeTheme == 'coffee' || $activeTheme == 'beverage'){
        //     $rules['features_section_bg_color'] = 'required';
        // }

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {

            return back()->withErrors($validator->errors());
            // $errmsgs = $validator->getMessageBag()->add('error', 'true');
            // return response()->json($validator->errors());
        }

        $bs = BS::where('language_id', $langid)->firstOrFail();
        
        $bs->feature_title = $request->feature_title;

        // if($activeTheme == 'coffee' || $activeTheme == 'beverage'){
        //     $bs->features_section_bg_color =$request->features_section_bg_color;
        // }
        
            if ($request->hasFile('features_section_top_shape_image')) {
              
                @unlink(public_path('assets/front/img/' . $bs->features_section_top_shape_image));
                $filename = uniqid() . '.' . $features_section_top_shape_image->getClientOriginalExtension();
                $features_section_top_shape_image->move(public_path('assets/front/img/'), $filename);
                $bs->features_section_top_shape_image = $filename;
            }
            if ($request->hasFile('features_section_bottom_shape_image')) {
                @unlink(public_path('assets/front/img/' . $bs->features_section_bottom_shape_image));
                $filename = uniqid() . '.' . $features_section_bottom_shape_image->getClientOriginalExtension();
                $features_section_bottom_shape_image->move(public_path('assets/front/img/'), $filename);
                $bs->features_section_bottom_shape_image = $filename;
            }

    


        $bs->save();
        Session::flash('success', 'Feature Section updated successfully!');
        return back();
    }
    public function featuresSectionRmvImg(Request $request)
    {
        $type = $request->type;
        $langid = $request->language_id;

        $bs = BS::where('language_id', $langid)->firstOrFail();

        if ($type == "features_section_top_shape_image") {
            @unlink(public_path("assets/front/img/" . $bs->features_section_top_shape_image));
            $bs->features_section_top_shape_image = NULL;
            $bs->save();
        }

        if ($type == "features_section_bottom_shape_image") {
            @unlink(public_path("assets/front/img/" . $bs->features_section_bottom_shape_image));
            $bs->features_section_bottom_shape_image = NULL;
            $bs->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
