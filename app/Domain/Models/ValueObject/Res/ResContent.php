<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject\Res;

use Exception;


/**
 * レスの内容
 *   - 200文字以内の文字列
 */
final class ResContent
{
    public $value;

    public function __construct(string $content)
    {
        if (empty($content) || mb_strlen($content) > 3000) {
            throw new Exception("content: ${content} is invalidate.");
        }

        $this->value = $content;
    }
}
