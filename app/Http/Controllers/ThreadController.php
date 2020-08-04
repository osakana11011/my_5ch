<?php

namespace App\Http\Controllers;

use App\Domain\Services\ThreadService;
use App\Domain\Services\ResService;
use App\Http\Requests\ThreadRequest;
use Illuminate\Http\Request;


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

    /**
     * スレッドとレスの横断検索を行う
     */
    public function crossingSearch(Request $request)
    {
        // 検索助件が空の時、スレッド一覧画面へ飛ばす。
        $q = $request->input('q');
        if (empty($q)) {
            return redirect(route('threads'));
        }

        // スレッドとレスを横断検索
        $threads = $this->threadService->crossingSearch($q);

        return view('threads.search', compact('q', 'threads'));
    }
}
