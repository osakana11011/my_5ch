<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Entities\Thread;
use App\Domain\Models\ValueObject\ThreadID;
use App\Domain\Models\ValueObject\ThreadTitle;

interface IThreadRepository
{
    public function getList(): array;
    public function getByID(ThreadID $threadID): Thread;
    public function create(ThreadTitle $threadTitle): void;
}
