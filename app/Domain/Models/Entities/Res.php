<?php
declare(strict_types=1);

namespace App\Domain\Models\Entities;

use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Res\ResID;
use App\Domain\Models\ValueObject\Res\ResContent;
use App\Domain\Models\ValueObject\Res\ResSubmitterName;
use Carbon\Carbon;

final class Res
{
    public $id;
    public $threadID;
    public $submitterName;
    public $content;
    public $postedAt;

    public function __construct(ThreadID $threadID, ResContent $content, ?ResSubmitterName $submitterName=null, ?ResID $resID=null, ?Carbon $postedAt=null)
    {
        $this->threadID = $threadID;
        $this->content = $content;
        $this->submitterName = $submitterName;
        $this->id = $resID;
        $this->postedAt = $postedAt;
    }
}
