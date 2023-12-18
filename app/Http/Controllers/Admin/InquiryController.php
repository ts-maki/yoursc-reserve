<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with('inquiryType', 'inquiryStatus')->get();
        return view('admin.inquiry.index')->with('inquiries', $inquiries);
    }

    public function show($inquiry_id)
    {
        $inquiry = Inquiry::findOrfail($inquiry_id);
        return view('')
    }
}
