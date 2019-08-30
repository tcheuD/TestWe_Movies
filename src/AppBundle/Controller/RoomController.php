<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Room;
use AppBundle\Form\RoomForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class RoomController
 * @Route("/room")
 * @package AppBundle\Controller
 */
class RoomController extends Controller
{
    /**
     * @Route("/", name="listRoom")
     * @Template("Room/index.html.twig")
     * @return array
     */
    public function listAction()
    {
        $roomService = $this->container->get('room_service');
        $rooms = $roomService->getAllRooms();

        return ["rooms" => $rooms];
    }


    /**
     * @Route("/create", name="newRoom")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $roomService = $this->container->get('room_service');

        $room = new Room();
        $form = $this->createForm(RoomForm::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $roomService->saveRoom($room);
            return $this->redirect($this->generateUrl("listRoom"));
        }

        return $this->render('room/new.html.twig', ['form_room' => $form->createView()]);
    }

    /**
     * @Route("/edit/{room}", name="editRoom")
     * @ParamConverter("room", class="AppBundle:Room")
     * @param Request $request
     * @param Room $room
     * @return Response
     */
    public function editAction(Request $request, Room $room)
    {
        $roomService = $this->container->get('room_service');
        $form = $this->createForm(RoomForm::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $roomService->saveRoom($room);
            return $this->redirect($this->generateUrl("listRoom"));
        }

        return $this->render('room/new.html.twig', ['form_room' => $form->createView()]);
    }

    /**
     * @Route("/delete/{room}", name="deleteRoom")
     * @ParamConverter("room", class="AppBundle:Room")
     * @param Room $room
     * @return Response
     */
    public function deleteAction(Room $room) {
        if ($room != null) {
            $roomService = $this->container->get('room_service');
            $roomService->deleteRoom($room);
        }

        return $this->redirect($this->generateUrl("listRoom"));
    }
}