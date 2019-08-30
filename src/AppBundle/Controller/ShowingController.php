<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Showing;
use AppBundle\Form\ShowingForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class ShowingController
 * @Route("/showing")
 * @package AppBundle\Controller
 */
class ShowingController extends Controller
{
    /**
     * @Route("/", name="listShowing")
     * @Template("Showing/index.html.twig")
     * @return array
     */
    public function listAction()
    {
        $showingService = $this->container->get('showing_service');
        $showings = $showingService->getAllShowings();

        return ["showings" => $showings];
    }


    /**
     * @Route("/create", name="newShowing")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $showingService = $this->container->get('showing_service');

        $showing = new Showing();
        $form = $this->createForm(ShowingForm::class, $showing);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $showingService->saveShowing($showing);
            return $this->redirect($this->generateUrl("listShowing"));
        }

        return $this->render('showing/new.html.twig', ['form_showing' => $form->createView()]);
    }

    /**
     * @Route("/edit/{showing}", name="editShowing")
     * @ParamConverter("showing", class="AppBundle:Showing")
     * @param Request $request
     * @param Showing $showing
     * @return Response
     */
    public function editAction(Request $request, Showing $showing)
    {
        $showingService = $this->container->get('showing_service');
        $form = $this->createForm(ShowingForm::class, $showing);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $showingService->saveShowing($showing);
            return $this->redirect($this->generateUrl("listShowing"));
        }

        return $this->render('showing/new.html.twig', ['form_showing' => $form->createView()]);
    }

    /**
     * @Route("/delete/{showing}", name="deleteShowing")
     * @ParamConverter("showing", class="AppBundle:Showing")
     * @param Showing $showing
     * @return Response
     */
    public function deleteAction(Showing $showing) {
        if ($showing != null) {
            $showingService = $this->container->get('showing_service');
            $showingService->deleteShowing($showing);
        }

        return $this->redirect($this->generateUrl("listShowing"));
    }
}