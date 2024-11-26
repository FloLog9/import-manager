<?php

namespace App\Controller;

use App\Service\T4SWrapper\T4SInteraction;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    private $t4s;

    private $db;

    public function __construct(T4SInteraction $t4s, ManagerRegistry $db)
    {
        $this->t4s = $t4s;
        $this->db = $db;
    }

    #[Route('/')]
    public function index(): Response
    {

        $connection = $this->db->getConnection('account');
        $result = $connection->fetchAllAssociative('SELECT * FROM agents WHERE trash = 0');

        $connection = $this->db->getConnection('tool');
        $accountInfos = $connection->fetchAllAssociative('SELECT * FROM accounts WHERE trash = 0 AND id_unique = "confstarte"');

        
        return $this->render('home/index.html.twig', [
            'homeMsg' => 'Welcome!',
            'test' => $this->t4s->test(),
            'data' => $result,
            'accountTitle' => $accountInfos[0]['title'],
        ]);
    }
}