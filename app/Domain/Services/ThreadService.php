<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\IThreadRepository;
use App\Domain\Models\Entities\Thread;
use App\Domain\Models\ValueObject\ThreadID;
use App\Domain\Models\ValueObject\ThreadTitle;

final class ThreadService
{
    private $threadRepository;

    public function __construct(IThreadRepository $threadRepository)
    {
        $this->threadRepository = $threadRepository;
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
        return $this->threadRepository->getByID($threadID);
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
