<?php

namespace App\Controller;

use App\Entity\SecurityUser;
use App\Entity\Video;
use App\Security\Voter\VideoVoter;
use DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DefaultController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/home', name: 'home')]
    // #[IsGranted("ROLE_USER")]
    public function index(Video $video, EntityManagerInterface $entityManager, ManagerRegistry $doctrine, Request $request, MailerInterface $mailer)
    {
        $entityManager = $doctrine->getManager();
        // $video = $entityManager->getRepository(Video::class)->find(4);
        // // dump($users); 
        // // dump($video);
        // $roles = $this->getUser()->getRoles();
        // dump($roles);
        
        // $accessGranted = $this->isGranted(VideoVoter::DELETE, $video);
        // dump($accessGranted);

        // $this->denyAccessUnlessGranted(VideoVoter::VIEW, $video);

        // $video = new Video();
        // $video->setTitle('video');
        // $video->setDescription('video');
        // $video->setFile('video path');
        // $video->setCreatedAt(new \DateTime());

        // $entityManager->persist($video);
        // $entityManager->flush();
        // dump($video);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/login', name: 'login')]

    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}
