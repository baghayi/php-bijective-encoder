<?php 

declare(strict_types=1);

namespace Baghayi\BijectiveEncoder;

class BijectiveEncoder
{
    private $chars = 'YRCAtS2qcL06JzFeWIsf9HbwgVPUoOkrZpaGm47vjNEuMT1dynlDxXhQK8i5B3';

    public function overwriteDefaultChars(string $chars)
    {
        $this->chars = $chars;
    }

    public function encode(int $data): string
    {
        if ($data < 0) {
            throw new \InvalidArgumentException("Negetive numbers are not supported!");
        }

        if ($data == 0) {
            return $this->chars[0];
        }

        $result = '';
        while ($data > 0) {
            $result .= $this->chars[$data % $this->base()];
            $data = (int) ($data / $this->base());
        }

        return strrev($result);
    }

    private function base(): int
    {
        return strlen($this->chars);
    }

    public function decode(string $code): int
    {
        $data = 0;
        foreach(str_split($code) as $index => $char) {
            $data = ($data * $this->base()) + strpos($this->chars, $char);
        }

        return $data;
    }
}
