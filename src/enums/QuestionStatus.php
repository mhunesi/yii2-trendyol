<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 13.04.2022
 * @time: 13:53
 */

namespace mhunesi\trendyol\enums;

class QuestionStatus extends BaseEnum
{
    public const WAITING_FOR_ANSWER = 'WAITING_FOR_ANSWER';

    public const WAITING_FOR_APPROVE = 'WAITING_FOR_APPROVE';

    public const ANSWERED = 'ANSWERED';

    public const REPORTED = 'REPORTED';

    public const REJECTED = 'REJECTED';

}