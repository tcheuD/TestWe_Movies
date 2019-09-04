<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Showing
 *
 * @ORM\Table(name="showing")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShowingRepository")
 */
class Showing
{
    const REFERENCE = "AppBundle:Showing";

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="3D", type="boolean")
     */
    private $is3D = false;

    /**
     * @var Room
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Room")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    private $room;

    /**
     * @var Movie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     * })
     */
    private $movie;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Showing
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set is3D
     *
     * @param boolean $is3D
     *
     * @return Showing
     */
    public function setIs3D($is3D)
    {
        $this->is3D = $is3D;

        return $this;
    }

    /**
     * Get is3D
     *
     * @return bool
     */
    public function getIs3D()
    {
        return $this->is3D;
    }

    /**
     * @return Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom($room)
    {
        $this->room = $room;
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }
}

