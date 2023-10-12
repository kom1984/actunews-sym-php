<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/login')]
    public function login(): Response
    {
       return $this->render('user/login.html.twig');
}
    #[Route('/user/inscription')]
    public function inscription(): Response
    {
        return $this->render('user/inscription.html.twig');
        
}


}