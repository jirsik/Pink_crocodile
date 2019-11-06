<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class AdminController extends Controller
{
    public function logs() {
        $logs = Log::with('user')->orderBy('created_at')->paginate(15);
        return view('tables.logs', compact('logs'));
    }

    public function log_show($id) {
        $log = Log::with('user')->findOrFail($id);
        return view('tables.log_show', compact('log'));
    }
}
