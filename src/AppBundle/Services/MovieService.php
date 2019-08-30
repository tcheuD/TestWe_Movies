<?php

namespace AppBundle\Services;

use AppBundle\Entity\Movie;
use AppBundle\Entity\MovieHasPeople;
use AppBundle\Form\MovieHasPeopleForm;
use Doctrine\ORM\EntityManager;

class MovieService
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    public function saveMovie(Movie $movie) {
        /**
         * @var MovieHasPeople $person
         */
        foreach ($movie->getPeople() as $person) {
            $person->setMovie($movie);
        }
        $this->em->persist($movie);
        $this->em->flush();
    }

    public function deleteMovie(Movie $movie) {
        $this->em->remove($movie);
        $this->em->flush();
    }

    public function getAllMovies() {
        return $this->getMovieRepository()->findAll();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getMovieRepository() {
        return $this->em->getRepository(Movie::REFERENCE);
    }
}