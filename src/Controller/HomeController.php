<?php

namespace App\Controller;

use App\Service\AccountConnectionManager\ConnectionManager;
use App\Service\T4SWrapper\T4SInteraction;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    private $t4s;

    private $db;

    private $connectionManager;

    public function __construct(T4SInteraction $t4s, ManagerRegistry $db, ConnectionManager $connectionManager)
    {
        $this->t4s = $t4s;
        $this->db = $db;
        $this->connectionManager = $connectionManager;
    }

    #[Route('/')]
    public function index(): Response
    {

        $connection = $this->connectionManager->getConnection('confstarte_test');
        $result = $connection->fetchAllAssociative('SELECT * FROM agents WHERE trash = 0 LIMIT 1');

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