<?php

namespace ATDev\RocketChat\Files;

use ATDev\RocketChat\Common\Request;
use ATDev\RocketChat\Common\Rooms;

class Upload extends Request
{
    public function uploadFiles(string $roomName, array $files)
    {
        $roomId = Rooms::getRoomId($roomName);
        if ($roomId) {
            $url = 'rooms.upload/' . $roomId;
        } else {
            throw new \DomainException('No room named [' . $roomName . '] found on server.');
        }

        Request::send(
            $url,
            'POST',
            [ 'emoji' => ':card_file_box:' ],
            null,
            $files
        );
    }
}