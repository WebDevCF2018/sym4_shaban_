<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Instruments;
use App\Entity\Familles;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        // get Doctrine Manager for all entities
        $entityManager = $this->getDoctrine()->getManager();

        // get all sections in db
        $fam = $entityManager->getRepository(Familles::class)->findAll();

        // get all articles from db
        $inst = $entityManager->getRepository(Instruments::class)->findAll();

        return $this->render('public/index.html.twig', [
            'familles' => $fam,
            'instruments' => $inst,
        ]);
    }
    /**
     *
     * Matches /instrument/{id},
     * {id} is a requirement digit: "\d+" for more security
     * to view an article's detail
     *
     * @Route("/instrument/{id}", name="detail_instrument", requirements={"id"="\d+"})
     */
    public function oneInstrument($id){
        // get Doctrine Manager for all entities
        $entityManager = $this->getDoctrine()->getManager();

        // get all sections in db for menu
        $fam = $entityManager->getRepository(Familles::class)->findAll();

        // get one article by its "id" from db
        $inst = $entityManager->getRepository(Instruments::class)->find($id);

        // return the Twig's view with 2 arguments
        return $this->render('public/one_instrument.html.twig', [
            'familles' => $fam,
            'instruments' => $inst,
        ]);
    }
    /**
     *
     * Matches /famille/{id},
     * {id} is a requirement digit: "\d+" for more security
     * to view an section's detail
     *
     * @Route("/famille/{id}", name="detail_famille", requirements={"id"="\d+"})
     */
    public function oneFamille($id){
        // get Doctrine Manager for all entities
        $entityManager = $this->getDoctrine()->getManager();

        // get all sections in db for menu
        $fam = $entityManager->getRepository(Familles::class)->findAll();

        // get one section by its "id" from db
        $famille = $entityManager->getRepository(Familles::class)->find($id);

        // get all articles by one section, it's the easy way, you can use ORDER BY into sections.php entity, views annotation before private $articlesarticles;
        $inst = $famille->getInstrumentsinstruments();



        // return the Twig's view with 2 arguments
        return $this->render('public/one_famille.html.twig', [
            'familles' => $fam,
            'famille' => $famille,
            'instruments' => $inst,
        ]);
    }
}
