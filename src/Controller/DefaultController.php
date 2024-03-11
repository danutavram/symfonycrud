<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $entityManager, ManagerRegistry $doctrine)
    {
        // $entityManager = $doctrine->getManager();

        $cache = new TagAwareAdapter(
            new FilesystemAdapter()
        );

        $acer = $cache->getItem('acer');
        $dell = $cache->getItem('dell');
        $ibm = $cache->getItem('ibm');
        $apple = $cache->getItem('apple');

        if (!$acer->isHit()) {
        $acer_from_db = 'acer laptop';
        $acer->set($acer_from_db);
        $acer->tag(['computers', 'laptop', 'acer']);
            $cache->save($acer);
            dump('acer laptop from db...');
        }

        if (!$dell->isHit()) {
        $dell_from_db = 'dell laptop';
            $dell->set($dell_from_db);
            $dell->tag(['computers', 'laptop', 'dell']);
            $cache->save($dell);
            dump('dell laptop from db...');
        }

        if (!$ibm->isHit()) {
            $ibm_from_db = 'ibm dekstop';
            $ibm->set($ibm_from_db);
            $ibm->tag(['computers', 'desktop', 'ibm']);
            $cache->save($ibm);
            dump('ibm desktop from db...');
        }

        if (!$apple->isHit()) {
            $apple_from_db = 'apple dekstop';
            $apple->set($apple_from_db);
            $apple->tag(['computers', 'desktop', 'apple']);
            $cache->save($apple);
            dump('apple desktop from db...');
        }

        $cache->invalidateTags(['computers']);

        dump($acer->get());
        dump($dell->get());
        dump($ibm->get());
        dump($apple->get());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
