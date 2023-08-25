<?php

namespace App\Enums;

final class StatusNameEnum
{
    const IN_PROGRESS = 'IN PROGRESS';
    const DONE = 'DONE';
    const IN_PROGRESS_LABEL = 'Em progresso';
    const DONE_LABEL = 'Feito';
    const STATUS_LIST = [
        self::IN_PROGRESS => self::IN_PROGRESS_LABEL,
        self::DONE => self::DONE_LABEL,
    ];
}
