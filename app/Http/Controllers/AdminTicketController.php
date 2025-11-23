<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('assignedTo')->orderBy('id', 'DESC')->get();
        $users = User::all();

        return view('admin.tickets', compact('tickets', 'users'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $ticket = Ticket::find($request->ticket_id);
        $ticket->assigned_to = $request->user_id;
        $ticket->save();

        return back()->with('success', 'Ticket Assigned Successfully');
    }
}
