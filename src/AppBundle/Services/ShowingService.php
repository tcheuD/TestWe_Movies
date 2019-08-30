<?php

namespace AppBundle\Services;

use AppBundle\Entity\Showing;
use Doctrine\ORM\EntityManager;

class ShowingService
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    public function saveShowing(Showing $showing) {
        $this->em->persist($showing);
        $this->em->flush();
    }

    public function deleteShowing(Showing $showing) {
        $this->em->remove($showing);
        $this->em->flush();
    }

    public function getAllShowings() {
        return $this->getShowingRepository()->findAll();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getShowingRepository() {
        return $this->em->getRepository(Showing::REFERENCE);
    }
}