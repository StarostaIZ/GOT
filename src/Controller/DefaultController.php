<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 31.12.2019
 * Time: 17:24
 */

namespace App\Controller;


use App\Entity\Blad;
use App\Entity\Turysta;
use App\Type\BladType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function home(){

        return $this->render("index.html.twig");
    }

    /**
     * @Route("/zarzadzaj")
     * @return Response
     */
    public function management(){

        return $this->render("menuZarzadzaj.html.twig");
    }

    /**
     * @Route("/zglosBlad")
     * @param Request $request
     * @return Response
     */
    public function sendError(Request $request){
        $blad = new Blad();
        $em = $this->getDoctrine()->getManager();
        /** @noinspection PhpParamsInspection */
        $blad->setAutor($em->getRepository(Turysta::class)->find(1));
        $form = $this->createForm(BladType::class, $blad);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            $em->persist($blad);
            $em->flush();
            $this->addFlash('success', 'Zgłoszenie zostało wysłane');

        }
        return $this->render('zglosBlad.html.twig', ['form' => $form->createView()]);
    }

}