<?php

namespace App\Http\Controllers;

use App\Models\Backend\AdminCommission;
use App\Models\Wallet;
use Illuminate\Http\Request;

class AdminCommissionController extends Controller
{
    public function index()
    {
        $commission = AdminCommission::all();
        return view('backend.pages.commission.set_commission', ['commission' => $commission]);
    }

    public function update_commission(Request $r)
    {
        $role = $r->role;
        $admin_commission = $r->commission;
        $user_commission = 100 - $admin_commission;

        $obj = AdminCommission::find($role);
        $obj->acommission =  $admin_commission;
        $obj->ucommission =  $user_commission;
        $obj->update();

        echo json_encode($obj);
    }

    public function getCommissionInfo()
    {
        $obj = AdminCommission::all();
        echo json_encode(['obj' => $obj]);
    }

    public function viewAllCommission()
    {
        $commissions = Wallet::with('channelOwner', 'buyer')->get();
        return view('backend.pages.commission.view_all_commission', ['commissions' => $commissions]);
    }
}
