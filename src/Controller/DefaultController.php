<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Entity\Video;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        // $user = new User();
        // $user->setName('Robert');

        // for ($i = 1; $i <= 3; $i++) {
        //     $video = new Video();
        //     $video->setTitle('Video title -' . $i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
        // }
        
        // $entityManager->persist($user);
        // $entityManager->flush();
        // $user = $entityManager->getRepository(User::class)->findWithVideos(1);
        dump('abc123');


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
