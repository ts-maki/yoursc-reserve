<?php

namespace App\Http\Controllers;

use App\Mail\Inquiry\CompleteInquiry;
use App\Mail\Inquiry\NewInquiry;
use App\Models\Inquiry;
use App\Models\Inquiry_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function create()
    {
        $inquiry_types = Inquiry_type::orderBy('id')->pluck('name');

        return view('inquiry.form')->with('inquiry_types', $inquiry_types);
    }

    public function comfilm(Request $request)
    {
        // dd($request);
        $request->session()->put('inquiry_data', $request->all());
        $inquiry_data = $request->session()->get('inquiry_data');

        // dd($inquiry_data);
        return view('inquiry.comfilm')->with('inquiry_data', $inquiry_data);
    }

    public function store(Request $request)
    {
        $inquiry_type_id = Inquiry_type::where('name', $request->type)->value('id');
        $inquiry = Inquiry::create([
            'inquiry_type_id' => $inquiry_type_id,
            'inquiry_status_id' => 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone_number' => $request->tel,
            'stay_date' => $request->date,
            'message' => $request->message,
        ]);

        $inquiry = Inquiry::findOrFail($inquiry->id);
        Mail::to($inquiry->email)->send(new CompleteInquiry($inquiry));
        Mail::to('mirai79mirai@gmail.com')->send(new NewInquiry($inquiry));

        $request->session()->forget('inquiry_data');

        return view('top')->with('complete_inquiry', '問い合わせが完了しました');
    }
}
