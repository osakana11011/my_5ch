<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\IThreadRepository;
use App\Domain\Repositories\IResRepository;
use App\Domain\Models\Entities\Thread;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Thread\ThreadTitle;

final class ThreadService
{
    private $threadRepository;
    private $resRepository;

    public function __construct(IThreadRepository $threadRepository, IResRepository $resRepository)
    {
        $this->threadRepository = $threadRepository;
        $this->resRepository = $resRepository;
    }

    /**
     * スレッドの一覧を取得する。
     *
     * @return array[Thread]
     */
    public function getThreads(): array
    {
        return $this->threadRepository->getList();
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
        return $thread;
    }

    /**
     * スレッドを作成する。
     *
     * @param string $threadTitle
     */
    public function createThread(string $threadTitle): void
    {
        $threadTitle = new ThreadTitle($threadTitle);
        $this->threadRepository->create($threadTitle);
    }
}
