<?php
namespace Theme\Main\Http\Enums;

abstract class EStatus
{
    const CONFIRM = 10;

    public function valueToString($status)
    {
        switch ($status) {
            case EStatus::CONFIRM:
                return 'Đã xác nhận';
        }
    }
}
