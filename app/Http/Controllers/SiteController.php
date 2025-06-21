<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Course;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RegistrationMessage;
use App\Models\Slider;

class SiteController extends Controller
{
    public function welcome()
    {
        $data['testimonials'] = Testimonial::get();
        $data['trainers'] = User::with(['category'])->where('type', 'trainer')->get();
        $data['sliders'] = Slider::active()->inRandomOrder()->take(3)->get();
        $data['courses'] = Course::where('status',1)->with(['category','trainer'])->get();

        $data['categories'] = Category::with(['children', 'courses' => function ($query) {
            $query->where('status', 1);
        }])
            ->whereNull('parent_id')
            // ->whereHas('courses', function ($query) {
            //     $query->where('status', 1);
            // })
            ->get();

        $data['upcomingBatches'] = Batch::where('status',1)->get();
        $data['page_name'] = 'home';

        return view('index', $data);
    }


    public function upcomingBatchDetails($slug){

        $data['batch'] = Batch::with(['trainer'])->where('slug', $slug)->first();
        return view('batch_details', $data);
    }
    public function registrationMessage(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name'  => $request->name,
                    'email' => $request->email,
                    'type'  => 'participant',
                ]);

                RegistrationMessage::create([
                    'user_id' => $user->id,
                    'message' => $request->message,
                ]);
            });

            return back()->with('success', 'User registered and message saved successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
