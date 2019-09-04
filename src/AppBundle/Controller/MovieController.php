<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Form\MovieForm;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * Class MovieController
 * @Route("/movie")
 * @package AppBundle\Controller
 */
class MovieController extends Controller
{
    /**
     * @Route("/", name="listMovie")
     * @Template("Movie/index.html.twig")
     * @return array
     */
    public function listAction()
    {
        $movieService = $this->container->get('movie_service');
        $movies = $movieService->getAllMovies();

        return ["movies" => $movies];
    }

    /**
     * @Route("/create", name="newMovie")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $movieService = $this->container->get('movie_service');

        $movie = new Movie();
        $form = $this->createForm(MovieForm::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $movieService->saveMovie($movie);
            return $this->redirect($this->generateUrl("listMovie"));
        }

        return $this->render('movie/new.html.twig', ['form_movie' => $form->createView()]);
    }

    /**
     * @Route("/edit/{movie}", name="editMovie")
     * @ParamConverter("movie", class="AppBundle:Movie")
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function editAction(Request $request, Movie $movie)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $movie = $entityManager->getRepository(Movie::class)->find($movie->getId());

        //$originalPeoples = new ArrayCollection();
        //$originalPeoples = $movie->getPeople();

       /** foreach ($movie->getPeople() as $people) {

            $originalPeoples->add($people);
                dump($people);
        }**/

        $movieService = $this->container->get('movie_service');
        $form = $this->createForm(MovieForm::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
           /**
            *
             foreach ($originalPeoples as $people) {
                if (false === $movie->getPeople()->contains($people)) {
                    foreach ($movie->getPeople() as $foo) {
                        if (false === $foo->contains($people)) {
                            $people->geMovie()->removeElement($people); //TODO: move to MovieService
                            $entityManager->persist($people);
                        }
                        die();
                        //if (!in_array($movie->getPeople(), $people)) {

                    }
                }
            }
            **/

            $movieService->saveMovie($movie);
            return $this->redirect($this->generateUrl("listMovie"));
        }

        return $this->render('movie/new.html.twig', ['form_movie' => $form->createView()]);
    }

    /**
     * @Route("/delete/{movie}", name="deleteMovie")
     * @ParamConverter("movie", class="AppBundle:Movie")
     * @param Movie $movie
     * @return Response
     */
    public function deleteAction(Movie $movie) {
        if ($movie != null) {
            $movieService = $this->container->get('movie_service');
            $movieService->deleteMovie($movie);
        }

        return $this->redirect($this->generateUrl("listMovie"));
    }
}