<?php

namespace App\Controller;

use App\Entity\Call;
use App\Entity\Caller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CallerController extends AbstractController
{
    /**
     * @Route("/callers", name="caller_list")
     */
    public function index()
    {
        $callers = $this->getDoctrine()->getRepository(Caller::class)
            ->findAll();

        $times = [];

        foreach ($callers as $caller) {
            $times[$caller->getId()] = $this->getDoctrine()->getRepository(Call::class)
                ->getLastCallByCaller($caller);
        }

        return $this->render('caller/index.html.twig', [
            'controller_name' => 'CallerController',
            'callers' => $callers/*,
            'times' => $times*/
        ]);
    }

    /**
     * @Route("/caller/add", name="caller_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();


        $caller_rq = $request->request->get("caller");

        $caller = new Caller();
        $caller->setNumber($caller_rq["number"]);
        $caller->setAdded(new \DateTime("now"));
        $caller->setBlocked($caller_rq["reject"] == "on");

        $entityManager->persist($caller);

        $entityManager->flush();

//        var_dump($caller_rq);

//        return $this->redirectToRoute("caller_list");
        return $this->render('home.html.twig', [
        ]);
    }
}
