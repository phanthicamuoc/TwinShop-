<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainContronllerController extends AbstractController
{
    #[Route('/main/contronller', name: 'app_main_contronller')]
    public function index(): Response
    {
        return $this->render('main_contronller/index.html.twig', [
            'controller_name' => 'MainContronllerController',
        ]);
    }
  public function addminpageAction():Response{
        return $this->render('admin.html.twig',[

        ]);
  }
  public function homepageAction():Response{
        return $this->render('home.html.twig',[

        ]);
  }
}

