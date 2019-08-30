<?php
namespace AppBundle\Enum;


class MovieSignificanceEnum
{
    const PRICIPAL = "principal";
    const SECONDARY = "secondaire";

    static $values = [
        self::PRICIPAL,
        self::SECONDARY,
    ];
}