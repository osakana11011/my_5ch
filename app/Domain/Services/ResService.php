<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Repositories\IResRepository;
use App\Domain\Models\Entities\Res;
use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Res\ResContent;
use App\Domain\Models\ValueObject\Res\ResSubmitterName;


final class ResService
{
    private $resRepository;

    public function __construct(IResRepository $resRepository)
    {
        $this->resRepository = $resRepository;
    }

    /**
     * スレッドにレスを投稿する。
     *
     * @
     */
    public function createRes(int $threadID, string $submitterName, string $content): void
    {
        $_threadID = new ThreadID($threadID);
        $resSubmitterName = new ResSubmitterName($submitterName);
        $resContent = new ResContent($content);
        $res = new Res($_threadID, $resContent, $resSubmitterName);
        $this->resRepository->create($res);
    }
}
