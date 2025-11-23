<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports');
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date'
        ]);

        $tickets = Ticket::whereBetween('created_at', [$request->from, $request->to])
            ->with(['createdBy', 'assignedTo'])
            ->get();

        return view('admin.reports', compact('tickets'));
    }
}
