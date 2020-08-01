<?php

namespace App\Http\Controllers;

use App\Domain\Services\ResService;
use App\Http\Requests\ResRequest;


class ResController extends Controller
{
    private $resService;

    public function __construct(ResService $resService)
    {
        $this->resService = $resService;
    }

    /**
     * スレッドの作成処理を行う。
     */
    public function store(ResRequest $request, $id)
    {
        $this->resService->createRes($id, $request->input('submitter_name'), $request->input('content'));
        return redirect(route('threads.show', $id));
    }
}
