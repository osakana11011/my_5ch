<?php
declare(strict_types=1);

namespace App\Domain\Models\Entities;


use App\Domain\Models\ValueObject\ThreadID;
use App\Domain\Models\ValueObject\ThreadTitle;


final class Thread
{
    public $id;
    public $title;
    public $parentThreadID;

    public function __construct(ThreadTitle $title, ?ThreadID $threadID=null, ?ThreadID $parentThreadID=null)
    {
        $this->title = $title;
        $this->id = $threadID;
        $this->parentThreadID = $parentThreadID;
    }
}

