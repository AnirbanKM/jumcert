<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $users = User::with('usersOrders', 'usersPayment')->get();
        return view('backend.pages.paymentInfo', ['users' => $users]);
    }
}
