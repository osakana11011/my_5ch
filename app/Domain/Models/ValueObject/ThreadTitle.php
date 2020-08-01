<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject;

use Exception;


/**
 * スレッドのタイトル
 *   - 30文字以内の文字列
 */
final class ThreadTitle
{
    public $value;

    public function __construct(string $title)
    {
        if (empty($title) || mb_strlen($title) > 30) {
            throw new Exception("title: ${title} is invalidate.");
        }

        $this->value = $title;
    }
}
