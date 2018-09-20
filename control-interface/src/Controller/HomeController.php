<?php
/**
 * Created by PhpStorm.
 * User: flo
 * Date: 20/09/18
 * Time: 22:21
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }
}