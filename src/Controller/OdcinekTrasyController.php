<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 02.01.2020
 * Time: 21:26
 */

namespace App\Controller;


use App\Entity\GrupaGorska;
use App\Entity\OdcinekTrasy;
use App\Entity\Punkt;
use App\Repository\GrupaGorskaRepository;
use App\Repository\PunktRepository;
use App\Type\OdcinekType;
use App\Type\OdcinekTypeDisabled;
use App\Type\SzukajOdcinekType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OdcinekTrasyController extends AbstractController
{


    /**
     * @Route("/zarzadzaj/odcinek")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        return $this->render('menuOdcinek.html.twig');
    }

    /**
     * @Route("/zarzadzaj/odcinek/dodaj")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $title = 'Dodaj odcinek';
        $odcinek = new OdcinekTrasy();
        $form = $this->createForm(OdcinekType::class, $odcinek);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($odcinek);
                $em->flush();
            } catch (UniqueConstraintViolationException $exception) {
                $form->addError(new FormError('Podana wartosc występuje już w bazie danych'));
                return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

            }

            $this->addFlash('success', 'Dodano nowy odcinek');


        }

        return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/ocinek/edytuj")
     * @param Request $request
     * @return Response
     */
    public function chooseEdit(Request $request)
    {
        $title = 'Edytuj odcinek';
        $odcinek = new OdcinekTrasy();
        $form = $this->createForm(SzukajOdcinekType::class, $odcinek);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var OdcinekTrasy|null $odcinek */
            $odcinek = $em->getRepository(OdcinekTrasy::class)->findOneBy(['punkt_poczatkowy' => $odcinek->getPunktPoczatkowy(), 'punkt_koncowy' => $odcinek->getPunktKoncowy()]);
            if (is_null($odcinek)) {

                $form->addError(new FormError('Taki odcinek nie istnieje'));
                return $this->render('szukajOdcinek.html.twig', ['form' => $form->createView(), 'title' => $title]);
            }
            return $this->redirectToRoute('edytujOdcinek', ['id' => $odcinek->getId()]);


        }
        return $this->render("szukajOdcinek.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/odcinek/edytuj/{id}", name="edytujOdcinek")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $title = 'Edytuj odcinek';
        $em = $this->getDoctrine()->getManager();
        /** @var OdcinekTrasy $odcinek */
        $odcinek = $em->getRepository(OdcinekTrasy::class)->find($id);
        $form = $this->createForm(OdcinekType::class, $odcinek);
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
     * @Route("/zarzadzaj/odcinek/usun", name="usunOdcinekWybierz")
     * @param Request $request
     * @return Response
     */
    public function chooseDelete(Request $request)
    {
        $title = 'Usun odcinek';
        $odcinek = new OdcinekTrasy();
        $form = $this->createForm(SzukajOdcinekType::class, $odcinek);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var OdcinekTrasy|null $odcinek */
            $odcinek = $em->getRepository(OdcinekTrasy::class)->findOneBy(['punkt_poczatkowy' => $odcinek->getPunktPoczatkowy(), 'punkt_koncowy' => $odcinek->getPunktKoncowy()]);
            if (is_null($odcinek)) {

                $form->addError(new FormError('Taki odcinek nie istnieje'));
                return $this->render("szukajOdcinek.html.twig", ['form' => $form->createView(), 'title' => $title]);

            } else {

                return $this->redirectToRoute('usunOdcinek', ['id' => $odcinek->getId()]);

            }



        }
        return $this->render("szukajOdcinek.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/odcinek/usun/{id}", name="usunOdcinek")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        $title = 'Usun odcinek';
        $em = $this->getDoctrine()->getManager();
        /** @var OdcinekTrasy $odcinek */
        $odcinek = $em->getRepository(OdcinekTrasy::class)->find($id);
        $form = $this->createForm(OdcinekTypeDisabled::class, $odcinek);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var OdcinekTrasy|null $odcinek */
            $odcinek = $em->getRepository(OdcinekTrasy::class)->findOneBy(['punkt_poczatkowy' => $odcinek->getPunktPoczatkowy(), 'punkt_koncowy' => $odcinek->getPunktKoncowy()]);
            if (is_null($odcinek)) {

                $form->addError(new FormError('Taki odcinek nie istnieje'));
            } else {
                $em->remove($odcinek);
                $em->flush();
                $this->addFlash('success', 'Usuwanie zakonczone powodzeniem');
            }

            return $this->redirectToRoute('usunOdcinekWybierz');

        }


        return $this->render("usun.html.twig", ['form' => $form->createView(), 'title' => $title]);

    }

    /**
     * @Route("/wyszukajOdcinek")
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {

        $title = 'Wyszukaj odcinek';
        $odcinek = new OdcinekTrasy();
        $form = $this->createForm(SzukajOdcinekType::class, $odcinek);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var OdcinekTrasy|null $odcinek */
            $odcinek = $em->getRepository(OdcinekTrasy::class)->findOneBy(['punkt_poczatkowy' => $odcinek->getPunktPoczatkowy(), 'punkt_koncowy' => $odcinek->getPunktKoncowy()]);
            if (is_null($odcinek)) {

                $form->addError(new FormError('Taki odcinek nie istnieje'));
            } else {
                return $this->redirectToRoute('pokaz_odcinek', ['id' => $odcinek->getId()]);
            }

            return $this->render('szukajOdcinek.html.twig', ['form' => $form->createView(), 'title' => $title]);


        }
        return $this->render("szukajOdcinek.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }

    /**
     * @Route("/admin/getPunktyByKoncowy/{id}")
     * @param $id
     * @return JsonResponse
     */
    public function getPunktyByPunktKoncowy($id){
        /** @var OdcinekTrasy[] $odcinki */
        $odcinki = $this->getDoctrine()->getManager()->getRepository(OdcinekTrasy::class)->findBy(['punkt_koncowy' => $id]);
        $punkty = [];
        foreach ($odcinki as $odcinek){
            $punkty[] = $odcinek->getPunktPoczatkowy()->getId();
        }
        return new JsonResponse($punkty);
    }

    /**
     * @Route("/admin/getPunktyByPoczatkowy/{id}")
     * @param $id
     * @return JsonResponse
     */
    public function getPunktyByPunktPoczatkowy($id){
        /** @var OdcinekTrasy[] $odcinki */
        $odcinki = $this->getDoctrine()->getManager()->getRepository(OdcinekTrasy::class)->findBy(['punkt_poczatkowy' => $id]);
        $punkty = [];
        foreach ($odcinki as $odcinek){
            $punkty[] = $odcinek->getPunktPoczatkowy()->getId();
        }
        return new JsonResponse($punkty);
    }

    /**
     * @Route("/odcinek/{id}", name="pokaz_odcinek")
     * @param $id
     * @return Response
     */
    public function showOdcinek($id){
        /** @var OdcinekTrasy $odcinek */
        $odcinek = $this->getDoctrine()->getManager()->getRepository(OdcinekTrasy::class)->find($id);
        $odcinkiSasiednie = $this->getDoctrine()->getManager()->getRepository(OdcinekTrasy::class)->findBy(['punkt_poczatkowy' => $odcinek->getPunktKoncowy()]);
        return $this->render("odcinekWidok.html.twig", ['odcinek' => $odcinek, 'odcinkiSasiednie' => $odcinkiSasiednie]);
    }


    /**
     * @Route("/galeria/{id}")
     * @param $id
     * @return Response
     */
    public function galeria($id) {
        return $this->render("galeria.html.twig", ['id' => $id]);
    }

}