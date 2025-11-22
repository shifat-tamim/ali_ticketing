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

    public function userDashboard()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('general.user_dashboard', compact('tickets'));
    }

    public function takeover($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->assigned_to = Auth::id();
        $ticket->status = "In Progress";
        $ticket->save();

        return back()->with('success', 'You have taken over this ticket.');
    }


    public function closeTicket($id)
    {
        $ticket = Ticket::findOrFail($id);

       
        if ($ticket->assigned_to != Auth::id()) {
            return back()->with('error', 'You cannot close this ticket.');
        }

        $ticket->status = "Closed";
        $ticket->save();

            return back()->with('success', 'Ticket has been closed.');
        }


    

}
