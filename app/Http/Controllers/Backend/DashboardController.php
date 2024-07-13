<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $users;
    public function __construct(
        User $users
    ){
        $this->users = $users;
    }
    public function index(){
        $user = Auth::user();
        return view('admin.dashboard.index', compact('user'));
    }
}
