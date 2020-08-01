<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObject\Res;

use Exception;


/**
 * レスの投稿者名
 *   - 20文字以内の文字列
 *   - NULL許可
 */
final class ResSubmitterName
{
    const DEFAULT_NAME = '名無しさん';
    public $value;

    public function __construct(?string $submitterName)
    {
        if (!is_null($submitterName) && mb_strlen($submitterName) > 20) {
            throw new Exception("submitterName: ${submitterName} is invalidate.");
        }

        $this->value = $submitterName;
    }

    /**
     * 投稿者名を返す。
     *
     * @return string
     */
    public function getName()
    {
        if (is_null($this->value)) {
            return self::DEFAULT_NAME;
        }

        return $this->value;
    }
}
