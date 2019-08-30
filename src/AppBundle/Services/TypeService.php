<?php

namespace AppBundle\Services;

use AppBundle\Entity\Type;
use Doctrine\ORM\EntityManager;

class TypeService
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    public function saveType(Type $type) {
        $this->em->persist($type);
        $this->em->flush();
    }

    public function deleteType(Type $type) {
        $this->em->remove($type);
        $this->em->flush();
    }

    public function getAllTypes() {
        return $this->getTypeRepository()->findAll();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getTypeRepository() {
        return $this->em->getRepository(Type::REFERENCE);
    }
}