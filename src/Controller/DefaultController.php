<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpParser\Node\Name;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    
    public function index(GiftsService $gifts, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        // $cookie = new Cookie(
        //     'my_cookie', // Cookie name
        //     'cookie value', // Cookie value
        //     time() + (2 * 365 * 24 * 60 * 60) // Expires after 2 years
        // );

        // $res = new Response();
        // $res->headers->setCookie( $cookie );
        // $res->send();

        $res = new Response();
        $res->headers->clearCookie('my_cookie');
        $res->send();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    #[Route('/blog/{page?}', name: 'blog_list', requirements: ['page' => '\d+'])]

    public function index2()
    {
        return new Response('Optional parameters in url and req for param');
    }

    #[Route(
        '/articles/{_locale}/{year}/{slug}/{category}',
        defaults:['category' => 'computers'],
        requirements:['_locale' => 'en|fr', 'category' => 'computers|rtv', 'year' => '\d+'
        ])]

    public function index3()
    {
        return new Response('An advanced route example');
    }

    #[Route(['nl' => '/over-ons', 'en' => '/about-us'], name:"about_us")]

    public function index4()
    {
        return new Response('Translated routes');
    }
}
