<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Type;
use AppBundle\Form\TypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class TypeController
 * @Route("/type")
 * @package AppBundle\Controller
 */
class TypeController extends Controller
{
    /**
     * @Route("/", name="listType")
     * @Template("Type/index.html.twig")
     * @return array
     */
    public function listAction()
    {
        $typeService = $this->container->get('type_service');
        $types = $typeService->getAllTypes();

        return ["types" => $types];
    }


    /**
     * @Route("/create", name="newType")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $typeService = $this->container->get('type_service');

        $type = new Type();
        $form = $this->createForm(TypeForm::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $typeService->saveType($type);
            return $this->redirect($this->generateUrl("listType"));
        }

        return $this->render('type/new.html.twig', ['form_type' => $form->createView()]);
    }

    /**
     * @Route("/edit/{type}", name="editType")
     * @ParamConverter("type", class="AppBundle:Type")
     * @param Request $request
     * @param Type $type
     * @return Response
     */
    public function editAction(Request $request, Type $type)
    {
        $typeService = $this->container->get('type_service');
        $form = $this->createForm(TypeForm::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $typeService->saveType($type);
            return $this->redirect($this->generateUrl("listType"));
        }

        return $this->render('type/new.html.twig', ['form_type' => $form->createView()]);
    }

    /**
     * @Route("/delete/{type}", name="deleteType")
     * @ParamConverter("type", class="AppBundle:Type")
     * @param Type $type
     * @return Response
     */
    public function deleteAction(Type $type) {
        if ($type != null) {
            $typeService = $this->container->get('type_service');
            $typeService->deleteType($type);
        }

        return $this->redirect($this->generateUrl("listType"));
    }
}