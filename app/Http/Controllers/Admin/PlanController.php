<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('admin.plan.index');
    }
    
    public function create()
    {
        $reserve_slots = Reserve_slot::with('room')->select('id', 'room_id', 'date')->orderBy('date')->get();
        return view('admin.plan.create')->with('reserve_slots', $reserve_slots);
    }

    public function store()
    {
        
    }
}
