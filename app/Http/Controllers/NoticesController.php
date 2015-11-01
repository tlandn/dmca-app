<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrepareNoticeRequest;
use App\Provider;
use Illuminate\Contracts\Auth\Guard;
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


    public function confirm(PrepareNoticeRequest $request, Guard $auth)
    {
        $template = $this->compileDmcaTemplate($data = $request->all(), $auth);
        session()->flash('dmca', $data);

        return view('notices.confirm', compact('template'));
    }


    /**
     *  Store a new DMCA notice.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = session()->get('dmca');
        return $data;
    }


    public function compileDmcaTemplate($data, Guard $auth)
    {
        $data = $data + [
                'name'  => $auth->user()->name,
                'email' => $auth->user()->email,
            ];

        return view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
    }

}
