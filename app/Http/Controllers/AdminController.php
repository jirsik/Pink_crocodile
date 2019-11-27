<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Event;
use App\AuctionItem;
use App\Role;

class AdminController extends Controller
{
    public function logs()
    {
        $users = User::with('role')->orderBy('created_at')->paginate(15);
        return view('tables.logs', compact('users'));
    }

    public function log_show($id)
    {
        $log = Log::with('user')->findOrFail($id);
        return view('tables.log_show', compact('log'));
    }

    public function make_admin($id)
    {
        $user = User::findOrFail($id);
        $user->role()->attach(1);
        $user->save();

        return redirect('/log')->with('success', 'You have a new admin!');
    }

    public function finished_events()
    {
        $events = Event::where('ends_at', '<', date("Y-m-d H:i:s", time()))
            ->orderBy('ends_at', 'DESC')
            ->with('auctionItems', 'auctionItems.bids')
            ->get();
        return view('tables.finished_events', compact('events'));
    }

    public function finished_event_info($id)
    {
        $event = Event::with('auctionItems', 'auctionItems.user')->findOrFail($id);

        
        return view('tables.finished_event_info', compact('event'));
    }

    public function confirm_payment($id)
    {
        $auction = AuctionItem::findOrFail($id);
        $auction->payed = true;
        $auction->save();

        $event_id = $auction->event->id;

        return redirect('/finished/events/'.$event_id)->with('success', 'Payment confirmed!');
    }
}
