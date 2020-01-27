<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 04.01.2020
 * Time: 15:40
 */

namespace App\Controller;


use App\Entity\GrupaGorska;
use App\Entity\Punkt;
use App\Type\GrupaGorskaType;
use App\Type\SzukajGrupaGorskaType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Klasa Kontrolera Grup Górskich, która odpowiada za poprawne działanie wszystkich
 * aspektów aplikacji dotyczących Grup Górskich.
 * @package App\Controller
 */
class GrupaGorskaController extends AbstractController
{


    /**
     * @Route("/zarzadzaj/grupaGorska")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Funkcja odpowiedzialna za wyświetlanie głównego menu z opcjami
     * dziąłania na Grupach Górskich.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function home()
    {
        return $this->render('menuGrupaGorska.html.twig');
    }

    /**
     * @Route("/zarzadzaj/grupaGorska/dodaj")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego dodania nowej Grupy Górskiej.
     * Ponadto wyświetla komunikat o powodzeniu lub niepowodzeniu próby dodania nowej Grupy Górskiej.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function add(Request $request)
    {
        $title = 'Dodaj grupę';
        $grupaGorska = new GrupaGorska();
        $form = $this->createForm(GrupaGorskaType::class, $grupaGorska);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($grupaGorska);
                $em->flush();
            } catch (UniqueConstraintViolationException $exception) {
                $form->addError(new FormError('Podana wartosc występuje już w bazie danych'));
                return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

            }

            $this->addFlash('success', 'Dodano nowągrupę');


        }

        return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/grupaGorska/edytuj")
     * @param Request $request
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego wyboru istniejącej Grupy Górskiej do edycji.
     * Wyświetla komunikat o powodzeniu lub niepowodzeniu próby odnalezienia wybranej Grupy Górskiej.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony lub
     * zwraca żądanie przekierowania do odpowiedniej ścieżki wraz z parametrem 'id'.
     */
    public function chooseEdit(Request $request)
    {
        $title = 'Edytuj grupę';
        $form = $this->createForm(SzukajGrupaGorskaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var GrupaGorska|null $grupaGorska */
            $grupaGorska = $form->getData()['grupa'];
            if (is_null($grupaGorska)) {

                $form->addError(new FormError('Taka grupa nie istnieje'));
                return $this->render('szukaj.html.twig', ['form' => $form->createView(), 'title' => $title]);
            }
            return $this->redirectToRoute('edytujgrupaGorska', ['id' => $grupaGorska->getId()]);


        }
        return $this->render("szukaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/grupaGorska/edytuj/{id}", name="edytujgrupaGorska")
     * @param Request $request
     * @param $id
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego edytowania istniejącej Grupy Górskiej.
     * Wyświetla komunikat o powodzeniu lub niepowodzeniu próby dodania nowej Grupy Górskiej.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Przyjmuje również parametr 'id', który jest idnetyfikatorem odnalezionej za pomocą
     * funkcji 'chooseEdit' istniejącej Grupy Górskiej.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function edit(Request $request, $id)
    {
        $title = 'Edytuj grupę';
        $em = $this->getDoctrine()->getManager();
        /** @var GrupaGorska $grupaGorska */
        $grupaGorska = $em->getRepository(GrupaGorska::class)->find($id);
        $form = $this->createForm(grupaGorskaType::class, $grupaGorska);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            } catch (UniqueConstraintViolationException $exception) {
                $form->addError(new FormError('Podana wartosc występnuje już w bazie danych'));
                return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

            }

            $this->addFlash('success', 'Edycja zakończona powodzeniem');


        }


        return $this->render("dodaj.html.twig", ['form' => $form->createView(), 'title' => $title]);

    }

    /**
     * @Route("/zarzadzaj/grupaGorska/usun")
     * @param Request $request
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego wyboru istniejącej Grupy Górskiej do usunięcia
     * oraz za usunięcie Grupy Górskiej, jeżeli została znaleziona.
     * Wyświetla komunikat o niepowodzeniu próby znalezienia isntiejącej Grupy Górskiej lub
     * o poprawnym usunięciu znalezionej Grupy Górskiej.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function chooseDelete(Request $request)
    {
        $title = 'Usun grupę';
        $form = $this->createForm(SzukajGrupaGorskaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var GrupaGorska|null $grupaGorska */
            $grupaGorska = $form->getData()['grupa'];
            if (is_null($grupaGorska)) {

                $form->addError(new FormError('Taka grupa nie istnieje'));
            } else {
                $em->remove($grupaGorska);
                $em->flush();
                $this->addFlash('success', 'Usuwanie zakonczone powodzeniem');
            }

            return $this->render('szukaj.html.twig', ['form' => $form->createView(), 'title' => $title]);


        }
        return $this->render("szukaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }

    /**
     * @Route("/wyszukajGrupe")
     * @param Request $request
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego znalezienia istniejącej Grupy Górskiej.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony lub
     * zwraca żądanie przekierowania do odpowiedniej ścieżki wraz z parametrem 'id'.
     */
    public function search(Request $request){

        $form = $this->createForm(SzukajGrupaGorskaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var GrupaGorska|null $grupaGorska */
            $grupaGorska = $form->getData()['grupa'];

            if (is_null($grupaGorska)) {

                $grupaGorskaId = $request->get('choiceFromList');
                return $this->redirectToRoute('pokaz_grupe', ['id' => $grupaGorskaId]);

            } else {
                return $this->redirectToRoute('pokaz_grupe', ['id' => $grupaGorska->getId()]);
            }
        }

        return $this->render('wyszukajGrupe.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/grupaGorska/{id}", name="pokaz_grupe")
     * @param $id
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego pokazania lokalizaji
     * wybranej z listy Grupy Górskiej na mapie.
     * Przyjmuje ona parametr 'id', który jest identyfikatorem Grupy Górskiej do wyświetlenia na mapie.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function show($id){
        $em = $this->getDoctrine()->getManager();
        /** @var GrupaGorska $grupa */
        $grupa = $em->getRepository(GrupaGorska::class)->find($id);
        $punkty = $this->getDoctrine()->getManager()->getRepository(Punkt::class)->findBy(['grupa_gorska' => $grupa]);
        return $this->render("grupaWidok.html.twig", ['punkty' => $punkty, 'nazwa' => $grupa->getNazwaGrupy()]);
    }
}