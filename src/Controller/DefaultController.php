<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $user = new User();
        $user->setName('Robert');

        for ($i = 1; $i <= 3; $i++) {
            $video = new Video();
            $video->setTitle('Video Title - ' . $i);
            $user->addVideo($video);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        dump('Created a video with the id of ' . $video->getId());
        dump('Created a user with the id of ' . $user->getId());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
