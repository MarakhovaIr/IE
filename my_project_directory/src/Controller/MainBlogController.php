<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainBlogController extends AbstractController
{
    #[Route('/', name: 'app_main_blog')]
    public function index(PostRepository $postRepository): Response
    {
        $postOll = $postRepository->findBy([], ['date' => 'DESC']);

        return $this->render('main_blog/main_page.html.twig', [
            'postOll' =>  $postOll,
        ]);
    }
}
