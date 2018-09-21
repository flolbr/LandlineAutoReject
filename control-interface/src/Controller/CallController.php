<?php

namespace App\Controller;

use App\Entity\Call;
use App\Entity\Caller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CallController extends AbstractController
{
    /**
     * @Route("/calls", name="call_list")
     */
    public function index()
    {
        $calls = $this->getDoctrine()->getRepository(Call::class)
            ->findBy(
                [],
                ['time' => 'DESC']
            );

        return $this->render('call/index.html.twig', [
            'controller_name' => 'CallController',
            'calls' => $calls
        ]);
    }

    /**
     * @Route("/call/incoming/{number}", name="call_incoming")
     * @param $number
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function incoming($number)
    {
        $number = trim($number);
        $time = new \DateTime("now");

        $entityManager = $this->getDoctrine()->getManager();

        $call = new Call();

        $caller = $this->getDoctrine()
            ->getRepository(Caller::class)
            ->findOneBy(
                ['number' => $number]
            );

        if ($caller === null) {
            $caller = new Caller();
            $caller->setNumber($number);
            $caller->setAdded($time);
            $caller->setBlocked(false);

            $entityManager->persist($caller);

            $entityManager->flush();

            $caller = $this->getDoctrine()
                ->getRepository(Caller::class)
                ->findOneBy(
                    ['number' => $number]
                );
        }

        $call->setCaller($caller);
        $call->setTime(new \DateTime("now"));

        $entityManager->persist($call);
        $entityManager->flush();

//        return $this->render('call/index.html.twig', [
//            'controller_name' => 'CallController',
//        ]);

        return new Response('Call added to the list');
    }
}
