<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $income = Transaction::where('transaction_status', 'success')->sum('transaction_total');
        $sale = Transaction::count();
        $items = Transaction::orderBy('id', 'DESC')->take(5)->get();
        $pie = [
            'pending' => Transaction::where('transaction_status', 'pending')->count(),
            'success' => Transaction::where('transaction_status', 'success')->count(),
            'failed' => Transaction::where('transaction_status', 'failed')->count()
        ];
        return view('pages.dashboard')->with([
            'income' => $income,
            'sale' => $sale,
            'items' => $items,
            'pie' => $pie
        ])->with('i');
    }
}
