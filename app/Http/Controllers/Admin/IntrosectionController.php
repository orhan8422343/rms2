<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use App\Models\Language;
use Validator;
use Session;

class IntrosectionController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        return view('admin.home.intro-section', $data);
    }

    public function update(Request $request, $langid)
    {
        $currentLang = Language::find($langid);
        $bs = $currentLang->basic_setting;
        $activeTheme = $bs->theme;

        $main_image = $request->file('intro_main_image');
        $signature = $request->file('intro_signature');
        $video_bg = $request->file('intro_video_image');
        $authorImg = $request->file('author_image');

        $topShapeImage = $request->file('intro_section_top_shape_image');
        $bottomShapeImage = $request->file('intro_section_bottom_shape_image');


        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [

            'intro_title' => 'required | max:255',

            'intro_text' => 'nullable | max:1000',
            'intro_section_highlight_text' => 'nullable | max:1000',
            'intro_section_video_button_text' => 'nullable | max:100',
            'intro_section_video_button_title' => 'nullable | max:100',
            'intro_video_link' => 'nullable | max:191',
            'intro_contact_text' => 'nullable | max:255',
            'intro_contact_text' => 'nullable | max:255',
            'intro_video_link' => 'nullable | max:191',
            'intro_contact_number' => 'nullable | max:191',
            'intro_section_author_name' => 'nullable | max:30',
            'intro_section_author_designation' => 'nullable | max:50',

            'intro_section_button_text' => 'nullable | max:50',
            'intro_section_button_url' => 'nullable | max:191',

            'author_image' => [
                function ($attribute, $value, $fail) use ($authorImg, $allowedExts) {
                    if (!empty($authorImg)) {
                        $ext = $authorImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'intro_main_image' => [
                function ($attribute, $value, $fail) use ($main_image, $allowedExts) {
                    if (!empty($main_image)) {
                        $ext = $main_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'intro_signature' => [
                function ($attribute, $value, $fail) use ($signature, $allowedExts) {
                    if (!empty($signature)) {
                        $ext = $signature->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'intro_video_image' => [
                function ($attribute, $value, $fail) use ($video_bg, $allowedExts) {
                    if (!empty($video_bg)) {
                        $ext = $video_bg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'intro_section_top_shape_image' => [
                function ($attribute, $value, $fail) use ($topShapeImage, $allowedExts) {
                    if (!empty($topShapeImage)) {
                        $ext = $topShapeImage->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'intro_section_bottom_shape_image' => [
                function ($attribute, $value, $fail) use ($bottomShapeImage, $allowedExts) {
                    if (!empty($bottomShapeImage)) {
                        $ext = $bottomShapeImage->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        // $rules['intro_title'] 
        if ($activeTheme != 'grocery') {
            $rules['intro_text'] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $bs = BS::where('language_id', $langid)->firstOrFail();
        if ($request->has('intro_title')) {
            $bs->intro_title = $request->intro_title ?? '';
        }
        if ($request->has('intro_text')) {
            $bs->intro_text = $request->intro_text ?? '';
        }
        if ($request->has('intro_section_highlight_text')) {
            $bs->intro_section_highlight_text = $request->intro_section_blockquote_text ?? '';
        }
        if ($request->has('intro_section_video_button_text')) {
            $bs->intro_section_video_button_text = $request->intro_section_video_button_text ?? '';
        }
        if ($request->has('intro_section_video_button_title')) {
            $bs->intro_section_video_button_title = $request->intro_section_video_button_title ?? '';
        }
        if ($request->has('intro_video_link')) {
            $bs->intro_video_link = $request->intro_video_link ?? '';
        }
        if ($request->has('intro_contact_text')) {
            $bs->intro_contact_text = $request->intro_contact_text ?? '';
        }
        if ($request->has('intro_contact_number')) {
            $bs->intro_contact_number = $request->intro_contact_number ?? '';
        }

        if ($request->has('intro_section_author_name')) {
            $bs->intro_section_author_name = $request->intro_section_author_name ?? '';
        }
        if ($request->has('intro_section_author_designation')) {
            $bs->intro_section_author_designation = $request->intro_section_author_designation ?? '';
        }

        //button----
        if ($request->has('intro_section_button_text')) {
            $bs->intro_section_button_text = $request->intro_section_button_text ?? '';
        }
        if ($request->has('intro_section_button_url')) {
            $bs->intro_section_button_url = $request->intro_section_button_url ?? '';
        }
        //end Button

        if ($request->hasFile('intro_main_image')) {
            @unlink(public_path('assets/front/img/' . $bs->intro_main_image));
            $main_image_name = uniqid() . '.' . $main_image->getClientOriginalExtension();
            $main_image->move(public_path('assets/front/img/'), $main_image_name);
            $bs->intro_main_image = $main_image_name;
        }

        if ($request->hasFile('intro_signature')) {
            @unlink(public_path('assets/front/img/' . $bs->intro_signature));
            $sign = uniqid() . '.' . $signature->getClientOriginalExtension();
            $signature->move(public_path('assets/front/img/'), $sign);
            $bs->intro_signature = $sign;
        }

        if ($request->hasFile('intro_video_image')) {
            @unlink(public_path('assets/front/img/' . $bs->intro_video_image));
            $video_name = uniqid() . '.' . $video_bg->getClientOriginalExtension();
            $video_bg->move(public_path('assets/front/img/'), $video_name);
            $bs->intro_video_image = $video_name;
        }

        if ($request->hasFile('author_image')) {
            @unlink(public_path('assets/front/img/' . $bs->author_image));
            $Img = uniqid() . '.' . $authorImg->getClientOriginalExtension();
            $authorImg->move(public_path('assets/front/img/'), $Img);
            $bs->intro_section_author_image = $Img;
        }
        //shape Image
        if ($request->hasFile('intro_section_top_shape_image')) {
            @unlink(public_path('assets/front/img/' . $bs->intro_section_top_shape_image));
            $Img = uniqid() . '.' . $topShapeImage->getClientOriginalExtension();
            $topShapeImage->move(public_path('assets/front/img/'), $Img);
            $bs->intro_section_top_shape_image = $Img;
        }

        if ($request->hasFile('intro_section_bottom_shape_image')) {
            @unlink(public_path('assets/front/img/' . $bs->intro_section_bottom_shape_image));
            $Img = uniqid() . '.' . $bottomShapeImage->getClientOriginalExtension();
            $bottomShapeImage->move(public_path('assets/front/img/'), $Img);
            $bs->intro_section_bottom_shape_image = $Img;
        }

        $bs->save();

        Session::flash('success', 'Intro Section updated successfully!');
        return "success";
    }

    public function removeImage(Request $request)
    {
        $type = $request->type;
        $langid = $request->language_id;

        $bs = BS::where('language_id', $langid)->firstOrFail();

        if ($type == "signature") {
            @unlink(public_path('assets/front/img/' . $bs->intro_signature));
            $bs->intro_signature = NULL;
            $bs->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
