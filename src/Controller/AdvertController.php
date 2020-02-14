<?php

namespace App\Controller;

use App\CarEstimation\ICarEstimation;
use App\Entity\Advert;
use App\Form\AdvertType;
use App\Repository\AdvertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adverts")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route("/", name="adverts")
     */
    public function adverts(AdvertRepository $advertRepository)
    {
        $adverts = $advertRepository->findAll();
        return $this->render('advert/index.html.twig', [
            'adverts' => $adverts
        ]);
    }

    /**
     * @Route("/create", name="create_advert")
     */
    public function createAdvert(Request $request, EntityManagerInterface $em, ICarEstimation $iCarEstimation)
    {
        $advert = new Advert();
        $form = $this->createForm(AdvertType::class, $advert);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $price = $iCarEstimation->estimate($advert->getCarYear(), $advert->getNbKm(), $advert->getNbDays());
            $advert->setPrice($price);
            $em->persist($advert);
            $em->flush();
        }

        return $this->render('advert/createAdvert.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
