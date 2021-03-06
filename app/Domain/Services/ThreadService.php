<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Services\CategoryService;
use App\Domain\Repositories\IThreadRepository;
use App\Domain\Repositories\IResRepository;
use App\Domain\Repositories\ICategoryRepository;
use App\Domain\Models\Entities\Thread;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Thread\ThreadTitle;

final class ThreadService
{
    private $categoryService;
    private $threadRepository;
    private $resRepository;
    private $categoryRepository;

    public function __construct(CategoryService $categoryService, IThreadRepository $threadRepository, IResRepository $resRepository, ICategoryRepository $categoryRepository)
    {
        $this->categoryService = $categoryService;
        $this->threadRepository = $threadRepository;
        $this->resRepository = $resRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * スレッドの一覧を取得する。
     *
     * @return array[Thread]
     */
    public function getThreads(): array
    {
        $threads = collect($this->threadRepository->getList())
            ->map(function ($thread) {
                $thread->resList = $this->resRepository->getByThreadID($thread->id);
                $thread->categoryList = $this->categoryRepository->getByThreadID($thread->id);
                return $thread;
            })
            ->filter(function ($thread) {
                return !empty($thread->resList);
            })
            ->toArray();
        return $threads;
    }

    /**
     * IDからスレッドを取得する。
     *
     * @param int $id
     * @return Thread
     */
    public function getByID(int $id): Thread
    {
        $threadID = new ThreadID($id);
        $thread = $this->threadRepository->getByID($threadID);
        $thread->resList = $this->resRepository->getByThreadID($threadID);
        $thread->categoryList = $this->categoryRepository->getByThreadID($threadID);
        return $thread;
    }

    /**
     * スレッドを作成する。
     *
     * @param string $threadTitle
     */
    public function createThread(string $threadTitle, string $categories): Thread
    {
        // スレッドの作成
        $threadTitle = new ThreadTitle($threadTitle);
        $thread = $this->threadRepository->create($threadTitle);

        // カテゴリの作成・スレッドとの紐付け
        collect(explode(',', $categories))
            ->unique()
            ->each(function ($categoryName) use ($thread) {
                if (empty($categoryName)) return;
                $category = $this->categoryService->createCategory($categoryName);
                $this->categoryRepository->associate($thread->id, $category->id);
            });

        return $thread;
    }

    /**
     * スレッド/レスの横断検索を行う。
     *
     * @param string $q
     * @return array
     */
    public function crossingSearch(string $q): array
    {
        // スレッド・レスの横断検索
        // NOTE: 横断検索なのにThreadRepositoryのメソッドに実装しているのは違和感がある。
        $threads = $this->threadRepository->search($q);
        return collect($threads)
            ->map(function ($thread) {
                $thread->categoryList = $this->categoryRepository->getByThreadID($thread->id);
                return $thread;
            })
            ->toArray();
    }
}
