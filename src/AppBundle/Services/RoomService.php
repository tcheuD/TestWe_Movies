<?php

namespace AppBundle\Services;

use AppBundle\Entity\Room;
use Doctrine\ORM\EntityManager;

class RoomService
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    public function saveRoom(Room $room) {
        $this->em->persist($room);
        $this->em->flush();
    }

    public function deleteRoom(Room $room) {
        $this->em->remove($room);
        $this->em->flush();
    }

    public function getAllRooms() {
        return $this->getRoomRepository()->findAll();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getRoomRepository() {
        return $this->em->getRepository(Room::REFERENCE);
    }
}