<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 04.01.2020
 * Time: 15:40
 */

namespace App\Controller;


use App\Entity\Punkt;
use App\Type\PunktType;
use App\Type\SzukajPunktType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PunktController extends AbstractController
{


    /**
     * @Route("/zarzadzaj/punkt")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('menupunkt.html.twig');
    }

    /**
     * @Route("/zarzadzaj/punkt/dodaj")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $title = 'Dodaj punkt';
        $punkt = new Punkt();
        $form = $this->createForm(PunktType::class, $punkt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($punkt);
                $em->flush();
            } catch (UniqueConstraintViolationException $exception) {
                $form->addError(new FormError('Podana wartosc występuje już w bazie danych'));
                return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

            }

            $this->addFlash('success', 'Dodano nowy punkt');


        }

        return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/punkt/edytuj")
     * @param Request $request
     * @return Response
     */
    public function chooseEdit(Request $request)
    {
        $title = 'Edytuj punkt';
        $form = $this->createForm(SzukajPunktType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var Punkt|null $punkt */
            $punkt = $form->getData()['punkt'];
            if (is_null($punkt)) {

                $form->addError(new FormError('Taki punkt nie istnieje'));
                return $this->render('szukaj.html.twig', ['form' => $form->createView(), 'title' => $title]);
            }
            return $this->redirectToRoute('edytujpunkt', ['id' => $punkt->getId()]);


        }
        return $this->render("szukaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/punkt/edytuj/{id}", name="edytujpunkt")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $title = 'Edytuj punkt';
        $em = $this->getDoctrine()->getManager();
        /** @var Punkt $punkt */
        $punkt = $em->getRepository(Punkt::class)->find($id);
        $form = $this->createForm(punktType::class, $punkt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            } catch (UniqueConstraintViolationException $exception) {
                $form->addError(new FormError('Podaja wartosc występnuje już w bazie danych'));
                return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

            }

            $this->addFlash('success', 'Edycja zakończona powodzeniem');


        }


        return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

    }

    /**
     * @Route("/zarzadzaj/punkt/usun")
     * @param Request $request
     * @return Response
     */
    public function chooseDelete(Request $request)
    {
        $title = 'Usun punkt';
        $form = $this->createForm(SzukajpunktType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var Punkt|null $punkt */
            $punkt = $form->getData()['punkt'];
            if (is_null($punkt)) {

                $form->addError(new FormError('Taki punkt nie istnieje'));
            } else {
                $em->remove($punkt);
                $em->flush();
                $this->addFlash('success', 'Usuwanie zakonczone powodzeniem');
            }

            return $this->render('szukaj.html.twig', ['form' => $form->createView(), 'title' => $title]);


        }
        return $this->render("szukaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }
}