<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RegistrationMessage;

class SiteController extends Controller
{
    public function welcome(){
        $data['testimonials'] = Testimonial::get();
        $data['trainers'] = User::with(['category'])->where('type', 'trainer')->get();
        return view('welcome', $data);
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
