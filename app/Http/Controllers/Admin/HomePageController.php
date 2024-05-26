<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicExtended;
use App\Models\Language;
use Validator;
use Session;

class HomePageController extends Controller
{
    public function backgroundImage(Request $request)
    {

    $lan = $request->language;
    $section = $request->section;

    if($lan == "" || $section == ""){
        
        Session::flash('error', "Something went's Wrong !");
        abort(404);
    }
       
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abe'] = $lang->basic_extended;
        $data['section'] =$request->section;
        

        return view('admin.home.backgroundImage', $data);
    }
    public function backgroundImageUpdate(Request $request,$langid)
    {
        
        $testimonialImg = $request->file('testimonial_bg_img');
        $featureImg = $request->file('feature_section_bg_image');
        $specialImg = $request->file('special_section_bg_image');
        $footerImg = $request->file('footer_section_bg_image');
        $introBgImg = $request->file('intro_bg_image');
        $blogBgImg = $request->file('blog_section_bg_image');



        $allowedExts = array('jpg', 'png', 'jpeg');
        $rules = [
            'hero_bg' => [
                function ($attribute, $value, $fail) use ($request, $testimonialImg, $allowedExts) {
                    if ($request->hasFile('hero_bg')) {
                        $ext = $testimonialImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],

            'blog_section_bg_image' => [
                function ($attribute, $value, $fail) use ($request, $blogBgImg, $allowedExts) {
                    if ($request->hasFile('blog_section_bg_image')) {
                        $ext = $blogBgImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],

            'feature_section_bg_image' => [
                function ($attribute, $value, $fail) use ($request, $featureImg, $allowedExts) {
                    if ($request->hasFile('feature_section_bg_image')) {
                        $ext = $featureImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'special_section_bg_image' => [
                function ($attribute, $value, $fail) use ($request, $specialImg, $allowedExts) {
                    if ($request->hasFile('special_section_bg_image')) {
                        $ext = $specialImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'footer_section_bg_image' => [
                function ($attribute, $value, $fail) use ($request, $footerImg, $allowedExts) {
                    if ($request->hasFile('footer_section_bg_image')) {
                        $ext = $footerImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        if(empty($testimonialImg) && empty($featureImg) && empty($specialImg) && empty($footerImg) && empty($introBgImg) && empty($blogBgImg)){
            Session::flash('warning', 'File Select Required !');
            return "success";
        }


       

        $be = BasicExtended::where('language_id', $langid)->firstOrFail();

        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        if ($request->hasFile('testimonial_bg_img')) {
            
            @unlink(public_path('assets/front/img/' . $be->testimonial_bg_img));
            $filename = uniqid() . '.' . $testimonialImg->getClientOriginalExtension();
            $testimonialImg->move(public_path('assets/front/img/'), $filename);
            $be->testimonial_bg_img = $filename;
        }
        if ($request->hasFile('feature_section_bg_image')) {
            
            @unlink(public_path('assets/front/img/' . $be->feature_section_bg_image));
            $filename = uniqid() . '.' . $featureImg->getClientOriginalExtension();
            $featureImg->move(public_path('assets/front/img/'), $filename);
            $be->feature_section_bg_image = $filename;
        }
        if ($request->hasFile('special_section_bg_image')) {
            
            @unlink(public_path('assets/front/img/' . $be->special_section_bg_image));
            $filename = uniqid() . '.' . $specialImg->getClientOriginalExtension();
            $specialImg->move(public_path('assets/front/img/'), $filename);
            $be->special_section_bg_image = $filename;
        }
        if ($request->hasFile('footer_section_bg_image')) {
            
            @unlink(public_path('assets/front/img/' . $be->footer_section_bg_image));
            $filename = uniqid() . '.' . $footerImg->getClientOriginalExtension();
            $footerImg->move(public_path('assets/front/img/'), $filename);
            $be->footer_section_bg_image = $filename;
        }
        if ($request->hasFile('intro_bg_image')) {
            
            @unlink(public_path('assets/front/img/' . $be->intro_bg_image));
            $filename = uniqid() . '.' . $introBgImg->getClientOriginalExtension();
            $introBgImg->move(public_path('assets/front/img/'), $filename);
            $be->intro_bg_image = $filename;
        }
        if ($request->hasFile('blog_section_bg_image')) {
            
            @unlink(public_path('assets/front/img/' . $be->blog_section_bg_image));
            $filename = uniqid() . '.' . $blogBgImg->getClientOriginalExtension();
            $blogBgImg->move(public_path('assets/front/img/'), $filename);
            $be->blog_section_bg_image = $filename;
        }

        $be->save();

        Session::flash('success', 'Background Image updated successfully!');
        return "success";
        ///
       
    }
    public function removeImage(Request $request) {
        $type = $request->type;
        $langid = $request->language_id;

        $be = BasicExtended::where('language_id', $langid)->firstOrFail();

        if ($type == "testimonial_bg_img") {
            @unlink(public_path("assets/front/img/" . $be->testimonial_bg_img));
            $be->testimonial_bg_img = NULL;
            $be->save();
        }

        if ($type == "feature_section_bg_image") {
            @unlink(public_path("assets/front/img/" . $be->feature_section_bg_image));
            $be->feature_section_bg_image = NULL;
            $be->save();
        }

        if ($type == "special_section_bg_image") {
            @unlink(public_path("assets/front/img/" . $be->special_section_bg_image));
            $be->special_section_bg_image = NULL;
            $be->save();
        }

        if ($type == "intro_bg_image") {
            @unlink(public_path("assets/front/img/" . $be->intro_bg_image));
            $be->intro_bg_image = NULL;
            $be->save();
        }
        if ($type == "footer_section_bg_image") {
            @unlink(public_path("assets/front/img/" . $be->footer_section_bg_image));
            $be->footer_section_bg_image = NULL;
            $be->save();
        }
        if ($type == "blog_section_bg_image") {
            @unlink(public_path("assets/front/img/" . $be->blog_section_bg_image));
            $be->blog_section_bg_image = NULL;
            $be->save();
        }


        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
