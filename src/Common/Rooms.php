<?php

namespace ATDev\RocketChat\Common;

use ATDev\RocketChat\Channels\Channel;

class Rooms
{
    /** @var ATDev\RocketChat\Channels\Collection $coll */
    private static $roomList;
    private static $roomMap = [];

    public static function getRooms(): Collection
    {
        if (!self::$roomList) {
            self::$roomList = Channel::listing();
            /** @var Channel $c */
            foreach (self::$roomList as $c) {
                self::$roomMap[$c->getName()] = $c->getRoomId();
            }
        }
        return self::$roomList;
    }

    public static function getRoomId(string $roomName): ?string
    {
        if (!self::$roomList) {
            self::getRooms();
        }
        if (array_key_exists($roomName, self::$roomMap)) {
            return self::$roomMap[$roomName];
        }
        return null;
    }

}