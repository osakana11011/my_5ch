<?php

namespace App\Http\Controllers;

use App\Domain\Services\ThreadService;
use App\Domain\Services\ResService;
use App\Http\Requests\ThreadRequest;


class ThreadController extends Controller
{
    private $threadService;
    private $resService;

    public function __construct(ThreadService $threadService, ResService $resService)
    {
        $this->threadService = $threadService;
        $this->resService = $resService;
    }

    /**
     * スレッドの一覧を表示する。
     */
    public function index()
    {
        $threads = $this->threadService->getThreads();
        return view('threads.index', compact('threads'));
    }

    /**
     * スレッドの作成フォーム画面を表示する。
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * スレッドの作成処理を行う。
     */
    public function store(ThreadRequest $request)
    {
        $thread = $this->threadService->createThread(
            $request->input('title'),
            $request->input('categories') ?? ''
        );

        $this->resService->createRes(
            $thread->id->value,
            $request->input('submitter_name'),
            $request->input('content')
        );

        return redirect('threads');
    }

    /**
     * スレッドを表示する
     */
    public function show($id)
    {
        $thread = $this->threadService->getByID($id);
        return view('threads.show', compact('thread'));
    }
}
