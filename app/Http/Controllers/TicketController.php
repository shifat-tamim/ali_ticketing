<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Show the create ticket form
    public function create()
    {
        return view('general.create_ticket'); // <- points to your current folder
    }

    // Store the ticket
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'description' => 'required',
            'attachment' => 'nullable|file',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = Auth::id();
        $ticket->category = $request->category;
        $ticket->description = $request->description;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $ticket->attachment = $path;
        }

        $ticket->save();

        return redirect()->back()->with('success', 'Ticket created successfully!');
    }

    // Show tickets for logged-in user
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('general.ticket_list', compact('tickets')); 
    }

    // Show all tickets for admin
    public function allTickets()
    {
        $tickets = Ticket::all();
        return view('admin.dashboard', compact('tickets'));
    }

    // ⭐ NEW — Show tickets for IT user
    public function itTickets()
    {
        $tickets = Ticket::all();   // or filter based on IT rules
        return view('it.dashboard', compact('tickets'));
    }
}
