<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Form\ReservationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /** * @Route("/home", name="app_home") */
    public function show(EntityManagerInterface $em) {
        $repository = $em->getRepository(Room::class);
        /** @var Room Rooms */
        $Rooms = $repository->findAll();
        return $this->render('public/home.html.twig', [ 'Rooms' => $Rooms, ]);
    }

    /** * @Route("/info", name="app_info") */
    public function showInfo(EntityManagerInterface $em) {
        return $this->render('public/info.html.twig');
    }

    /** * @Route("/contact", name="app_contact") */
    public function showContact(EntityManagerInterface $em) {
        return $this->render('public/contact.html.twig');
    }

    /** * @Route("/booking/rooms/{a}", name="app_booking") */
    public function showRooms(EntityManagerInterface $em, int $a):Response
    {
        $Room = $em->getRepository(Room::class)->findOneBy(['id' => $a]);
        /** @var Room Room */
        return $this->render('public/room.html.twig', [ 'Room' => $Room]);
    }

//    /** * @Route("/booking/book/{a}", name="app_book") */
//    public function showBooking(EntityManagerInterface $em, int $a, Request $request):Response
//    {
//        $Room = $em->getRepository(Reservation::class)->findOneBy(['id' => $a]);
//        /** @var Room Room */
//        $form = $this->createForm(ReservationFormType::class);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
////            $data = $form->getData();
//            $reservation = new Reservation();
//            $reservation->setUser(Auth::user()->id);
//            $reservation->setRoom($Room);
//            $em->persist($reservation);
//            $em->flush();
//            return $this->redirectToRoute('app_home');
//        }
//        return $this->render('public/room.html.twig', [ 'Room' => $Room]);
//    }

    /** * @Route("/booking/rooms/{a}", name="app_booking") */
    public function show2(EntityManagerInterface $em, int $a, Request $request):Response
    {
        $form=$this->createForm(ReservationFormType::class);
        $form->handleRequest($request);
        $Room = $em->getRepository(Room::class)->findOneBy(['id' => $a]);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $reservation = new Reservation();
            $reservation->setUser($this->getUser());
            $reservation->setCheckindate ($data['checkin_date']);
            $reservation->setCheckoutdate ($data['checkout_date']);
            $reservation->setRoom($Room);
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        /** @var Room Room */
        return $this->renderForm('public/room.html.twig', [ 'Room' => $Room, "form"=>$form]);
    }

}