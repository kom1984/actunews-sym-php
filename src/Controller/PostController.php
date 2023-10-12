<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\Type\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    #[Route('/dashboard/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function createPost(Request $request, EntityManagerInterface $manager)
    {
        # Création du formulaire à partir de mon modèle PostType
        $post = new Post();
        # FIXME A remplacer par l'utilisateur connecté
        $post->setUser($manager->getRepository(User::class)->findOneByEmail('hugo@actu.news'));

        # dump($post);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($post);
            $manager->flush();
        }

        return $this->render('post/create.html.twig', [
            'form' => $form
        ]);
    }
}