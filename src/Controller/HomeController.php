<?php

namespace App\Controller;

use App\Service\T4SWrapper\T4SInteraction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    private $t4s;

    public function __construct(T4SInteraction $t4s)
    {
        $this->t4s = $t4s;
    }

    #[Route('/')]
    public function index(): Response
    {

        $data = [
            'test1' => 'value1',
            'test2' => 'value2',
            'test3' => 'value3',
        ];

        return $this->render('home/index.html.twig', [
            'homeMsg' => 'Welcome!',
            'test' => $this->t4s->test(),
            'data' => $data,
        ]);
    }
}