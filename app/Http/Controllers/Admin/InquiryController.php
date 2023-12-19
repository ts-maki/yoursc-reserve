<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Inquiry_status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with('inquiryType', 'inquiryStatus')->get();
        $inquiry_statuses = Inquiry_status::with('inquiries')->get();
        return view('admin.inquiry.index')
            ->with('inquiries', $inquiries)
            ->with('inquiry_statuses', $inquiry_statuses);
    }

    public function show($inquiry_id)
    {
        $inquiry = Inquiry::find($inquiry_id);
        return view('admin.inquiry.show')->with('inquiry', $inquiry);
    }

    public function update($inquiry_id, $update_inquiry_status_id)
    {
        $inquiry = Inquiry::findOrFail($inquiry_id);
        $inquiry->inquiry_status_id = $update_inquiry_status_id;
        $inquiry->save();
    }
}
