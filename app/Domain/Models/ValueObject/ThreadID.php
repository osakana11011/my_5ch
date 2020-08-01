<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject;

use Exception;


/**
 * スレッドのID
 *   - 1以上の数値
 */
final class ThreadID
{
    public $value;

    public function __construct(int $threadID)
    {
        if (empty($threadID) || $threadID <= 0) {
            throw new Exception("threadID: ${threadID} is invalidated.");
        }

        $this->value = $threadID;
    }
}
