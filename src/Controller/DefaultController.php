<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoFormType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, Request $request, MailerInterface $mailer)
    {
        $entityManager = $doctrine->getManager();
        $message = (new Email())
            ->from('send@example.com')
            ->to('recipient@example.com')
            ->subject('Hello Email')
            ->html($this->renderView(
                'emails/registration.html.twig',
                ['name' => 'Robert']
            ));

            $mailer->send($message);

        // $videos = $entityManager->getRepository(Video::class)->findAll();
        // dump($videos);
        // $video = new Video();
        // $video->setTitle('Write a blog post');
        // $video->setCreatedAt(new \DateTime('tomorrow'));
        
        // // $video = $entityManager->getRepository(Video::class)->find(1);
        // $form = $this->createForm(VideoFormType::class, $video);

        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $file = $form->get('file')->getData();
        //     $fileName = sha1(random_bytes(14) . '.' . $file->guessExtension());
        //     $file->move(
        //         $this->getParameter('videos_directory'),
        //         $fileName
        //     );
        //     $video->setFile($fileName);
        //     $entityManager->persist($video);
        //     $entityManager->flush();
        //     return $this->redirectToRoute('home');
        // }


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            // 'form' =>$form->createView()
        ]);
    }
}
