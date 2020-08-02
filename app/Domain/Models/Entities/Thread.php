<?php
declare(strict_types=1);

namespace App\Domain\Models\Entities;


use App\Domain\Models\ValueObject\Thread\ThreadID;
use App\Domain\Models\ValueObject\Thread\ThreadTitle;


final class Thread
{
    public $id;
    public $title;
    public $parentThreadID;
    public $resList;
    public $categoryList;

    const MAX_RES_NUMBER = 100;

    public function __construct(ThreadTitle $title, ?ThreadID $threadID=null, ?ThreadID $parentThreadID=null)
    {
        $this->title = $title;
        $this->id = $threadID;
        $this->parentThreadID = $parentThreadID;
    }

    /**
     * スレッドにレスを投稿できるかどうか
     *
     * @return boolean
     */
    public function isEnablePostRes()
    {
        return (count($this->resList) < self::MAX_RES_NUMBER);
    }

    /**
     * 1つのスレッドに投稿できるレスの件数を取得する。
     *
     * @return int
     */
    public function getMaxResNumber()
    {
        return self::MAX_RES_NUMBER;
    }
}
