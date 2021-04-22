<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        $number = random_int(0, 100);

        return $this->render('default/index.html.twig', [
            'number' => $number,
        ]);
    }
}