<?php

namespace App\Http\Controllers\Modals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Tax as Request;
use App\Models\Setting\Tax;

class Taxes extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        // Add CRUD permission check
        $this->middleware('permission:create-settings-taxes')->only(['create', 'store']);
        $this->middleware('permission:read-settings-taxes')->only(['index', 'edit']);
        $this->middleware('permission:update-settings-taxes')->only(['update', 'enable', 'disable']);
        $this->middleware('permission:delete-settings-taxes')->only('destroy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $html = view('modals.taxes.create')->render();

        return response()->json([
            'success' => true,
            'error' => false,
            'message' => 'null',
            'html' => $html,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request['enabled'] = 1;

        $tax = Tax::create($request->all());

        $message = trans('messages.success.added', ['type' => trans_choice('general.taxes', 1)]);

        return response()->json([
            'success' => true,
            'error' => false,
            'data' => $tax,
            'message' => $message,
            'html' => 'null',
        ]);
    }
}
