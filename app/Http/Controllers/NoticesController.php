<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareNoticeRequest;
use App\Provider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoticesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return 'all notices';
    }


    public function create()
    {
        // Get list of providers
        $providers = Provider::lists('name', 'id');

        // Load a view to create notice
        return view('notices.create', compact('providers'));
    }

    public function confirm(PrepareNoticeRequest $request) {
        return $request->all();
    }
}
