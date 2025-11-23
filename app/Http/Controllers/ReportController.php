<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReportController extends Controller
{
    // Show the empty report page with date filter
    public function index()
    {
        return view('admin.reports');
    }

    // Handle the search (From date / To date)
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date',
        ]);

        // Include full days (00:00:00 to 23:59:59)
        $from = $request->from . ' 00:00:00';
        $to   = $request->to   . ' 23:59:59';

        $tickets = Ticket::with(['user', 'assignedTo'])
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('admin.reports', [
            'tickets' => $tickets,
            'from'    => $request->from,
            'to'      => $request->to,
        ]);
    }
}
