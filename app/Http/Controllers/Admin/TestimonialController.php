<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Testimonial;
use App\Models\BasicSetting as BS;
use App\Models\BasicExtended;
use Validator;
use Session;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        $data['abe'] = $lang->basic_extended;
        $data['testimonials'] = Testimonial::where('language_id', $data['lang_id'])->orderBy('id', 'DESC')->get();

        return view('admin.home.testimonial.index', $data);
    }

    public function edit($id)
    {
        $data['testimonial'] = Testimonial::findOrFail($id);
        return view('admin.home.testimonial.edit', $data);
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
            'comment' => 'required',
            'name' => 'required|max:50',
            'rank' => 'required|max:50',
            'rating' => 'required|min:1|max:5|numeric',
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

        $message = ['rating.required' => 'rating field is required','rating.min' => 'min 1 and max 5 rating','rating.max' => 'min 1 and max 5 rating'];

        $validator = Validator::make($request->all(), $rules,$message);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move(public_path('assets/front/img/testimonials/'), $main_image);
            $input['image'] = $main_image;
        }

        $testimonial = new Testimonial;

        $testimonial->create($input);

        Session::flash('success', 'Testimonial added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');


        $rules = [
            'image' => 'required',
            'comment' => 'required',
            'name' => 'required|max:50',
            'rank' => 'required|max:50',
            'rating' => 'required|min:1|max:5|numeric',
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

        $message = ['rating.required' => 'rating field is required','rating.min' => 'min 1 and max 5 rating','rating.max' => 'min 1 and max 5 rating'];

        $validator = Validator::make($request->all(), $rules,$message);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = $request->all();

        $testimonial = Testimonial::findOrFail($request->testimonial_id);
        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            @unlink(public_path('assets/front/img/testimonials/' . $testimonial->image));
            $request->file('image')->move(public_path('assets/front/img/testimonials/'), $main_image);
            $input['image'] = $main_image;
        }


        $testimonial->update($input);

        Session::flash('success', 'Testimonial updated successfully!');
        return "success";
    }

    public function sideContent(Request $request, $langid)
    {


        $bs = BS::where('language_id', $langid)->firstOrFail();
        $activeTheme = $bs->theme;
        $testimonial_side_image = $request->file('testimonial_side_img');

        $testimonial_section_top_shape_image = $request->file('testimonial_section_top_shape_image');
        $testimonial_section_bottom_shape_image = $request->file('testimonial_section_bottom_shape_image');
   
       

        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'testimonial_side_img' => [
                function ($attribute, $value, $fail) use ($request, $testimonial_side_image, $allowedExts) {
                    if ($request->hasFile('testimonial_side_img')) {
                        $ext = $testimonial_side_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'testimonial_section_top_shape_image' => [
                function ($attribute, $value, $fail) use ($request, $testimonial_section_top_shape_image, $allowedExts) {
                    if ($request->hasFile('testimonial_section_top_shape_image')) {
                        $ext = $testimonial_section_top_shape_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'testimonial_section_bottom_shape_image' => [
                function ($attribute, $value, $fail) use ($request, $testimonial_section_bottom_shape_image, $allowedExts) {
                    if ($request->hasFile('testimonial_section_bottom_shape_image')) {
                        $ext = $testimonial_section_bottom_shape_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],


        ];
        
        $rules['testimonial_section_title'] ='required|max:100';
        $rules['testimonial_section_text'] ='nullable|max:200';


        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            
            $validator->getMessageBag()->add('error', 'true');
            // return response()->json($validator->errors());
             return back()->withErrors($validator->errors());
        }
        $bs->testimonial_title = $request->testimonial_section_title;

        if($request->has('testimonial_section_text')){

            $bs->testimonial_section_text = $request->testimonial_section_text;
        }
        

        if ($request->hasFile('testimonial_bg_img')) {

            $be = BasicExtended::where('language_id', $langid)->firstOrFail();
            $filename = time() . '.' . $request->testimonial_bg_img->getClientOriginalExtension();
            $request->file('testimonial_bg_img')->move(public_path('assets/front/img/'), $filename);
            @unlink(public_path('assets/front/img/' . $be->testimonial_bg_img));
            $be->testimonial_bg_img = $filename;
            $be->save();
        }
        if ($request->hasFile('testimonial_side_img')) {

            $be = BasicExtended::where('language_id', $langid)->firstOrFail();
            $filename = time() . '.' . $request->testimonial_side_img->getClientOriginalExtension();
            $request->file('testimonial_side_img')->move(public_path('assets/front/img/'), $filename);
            @unlink(public_path('assets/front/img/' . $be->testimonial_side_img));
            $be->testimonial_side_img = $filename;
            $be->save();
        }
        if ($request->hasFile('testimonial_section_top_shape_image')) {

            $be = BasicExtended::where('language_id', $langid)->firstOrFail();
            $filename = time() . '.' . $request->testimonial_section_top_shape_image->getClientOriginalExtension();
            $request->file('testimonial_section_top_shape_image')->move(public_path('assets/front/img/'), $filename);
            @unlink(public_path('assets/front/img/' . $be->testimonial_section_top_shape_image));
            $be->testimonial_section_top_shape_image = $filename;
            $be->save();
        }
        if ($request->hasFile('testimonial_section_bottom_shape_image')) {

            $be = BasicExtended::where('language_id', $langid)->firstOrFail();
            $filename = time() . '.' . $request->testimonial_section_bottom_shape_image->getClientOriginalExtension();
            $request->file('testimonial_section_bottom_shape_image')->move(public_path('assets/front/img/'), $filename);
            @unlink(public_path('assets/front/img/' . $be->testimonial_section_bottom_shape_image));
            $be->testimonial_section_bottom_shape_image = $filename;
            $be->save();
        }

        $bs->save();

        Session::flash('success', 'Testimonial Section Side Content updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->testimonial_id);
        @unlink(public_path('assets/front/img/testimonials/' . $testimonial->image));
        $testimonial->delete();

        Session::flash('success', 'Testimonial deleted successfully!');
        return back();
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $langid = $request->language_id;

        $be = BasicExtended::where('language_id', $langid)->firstOrFail();

        if ($type == "testimonial_side_img") {
            @unlink(public_path("assets/front/img/" . $be->testimonial_side_img));
            $be->testimonial_side_img = NULL;
            $be->save();
        }
        if($type == 'top_shape_image'){
            @unlink(public_path("assets/front/img/" . $be->testimonial_section_top_shape_image));
            $be->testimonial_section_top_shape_image = NULL;
            $be->save();
        }
        if($type == 'bottom_shape_image'){
            @unlink(public_path("assets/front/img/" . $be->testimonial_section_bottom_shape_image));
            $be->testimonial_section_bottom_shape_image = NULL;
            $be->save();
        }
        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
