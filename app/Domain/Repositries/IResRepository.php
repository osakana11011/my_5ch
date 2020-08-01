<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Entities\Res;
use App\Domain\Models\ValueObject\Thread\ThreadID;


interface IResRepository
{
    public function getByThreadID(ThreadID $threadID): array;
    public function create(Res $res): void;
}
