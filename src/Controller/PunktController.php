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
use App\Type\PunktType;
use App\Type\SzukajGrupaGorskaType;
use App\Type\SzukajPunktType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Klasa Kontrolera Punktów odpowiadająca za poprawne działanie aspektów aplikacji
 * dotyczących operacji związanych z Punktami.
 * @package App\Controller
 */
class PunktController extends AbstractController
{


    /**
     * @Route("/zarzadzaj/punkt")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Funkcja odpowiedzialna za wyświetlanie widoku menu z działaniami dotyczącymi Punktów.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
     */
    public function home()
    {
        return $this->render('menupunkt.html.twig');
    }

    /**
     * @Route("/zarzadzaj/punkt/dodaj")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego dodania nowego Punktu.
     * Wyświetla komunikat o powodzeniu lub niepowodzeniu próby dodania Punktu.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
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


//    /**
//     * @Route("/zarzadzaj/punkt/grupa")
//     * @param Request $request
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
//     */
//    public function chooseGrupa(Request $request){
//
//        $title = 'Wybierz grupę';
//        $formGrupa = $this->createForm(SzukajGrupaGorskaType::class);
//        $formGrupa->handleRequest($request);
//        if($formGrupa->isSubmitted() && $formGrupa->isValid()){
//            /** @var GrupaGorska|null $grupaGorska */
//            $grupaGorska = $formGrupa->getData()['grupa'];
//            if (is_null($grupaGorska)) {
//
//                $formGrupa->addError(new FormError('Taka grupa nie istnieje'));
//                return $this->render('szukaj.html.twig', ['form' => $formGrupa->createView(), 'title' => $title]);
//            }
//            $_SESSION['grupa'] = $grupaGorska->getId();
//            return $this->redirectToRoute('edytujPunktSzukaj');
//        }
//
//        return $this->render("szukaj.html.twig", ['form' => $formGrupa->createView(), 'title' => $title]);
//    }

    /**
     * @Route("/zarzadzaj/punkt/edytuj")
     * @param Request $request
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego wyboru istniejącego Punktu do edycji.
     * Wyświetla komunikat o powodzeniu lub niepowodzeniu próby wyboru Punktu.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony lub
     * zwraca żądanie przekierowania do odpowiedniej ścieżki wraz z parametrem 'id' znalezionego Punktu.
     */
    public function chooseEdit(Request $request)
    {

        $title = 'Edytuj punkt';
        $form = $this->createForm(SzukajPunktType::class, null);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /** @var Punkt|null $punkt */
            $punkt = $form->getData()['punkt'];
            if (is_null($punkt)) {

                $form->addError(new FormError('Taki punkt nie istnieje'));
                return $this->render('szukaj.html.twig', ['form' => $form->createView(), 'title' => $title]);
            }
            unset($_SESSION['grupa']);
            return $this->redirectToRoute('edytujpunkt', ['id' => $punkt->getId()]);


        }
        return $this->render("szukaj.html.twig", ['form' => $form->createView(), 'title' => $title]);
    }


    /**
     * @Route("/zarzadzaj/punkt/edytuj/{id}", name="edytujpunkt")
     * @param Request $request
     * @param $id
     * @return Response
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego edytowania istniejącego Punktu.
     * Wyświetla komunikat o powodzeniu lub niepowodzeniu próby edycji istniejącego Punktu.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Przyjmuje również parametr 'id', który jest idnetyfikatorem odnalezionego za pomocą
     * funkcji 'chooseEdit' istniejącego Punktu.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
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
     *
     * Funkcja odpowiedzialna za obsługę żądania dotyczącego wyboru istniejącego Punktu do usunięcia
     * oraz za usunięcie Punktu, jeżeli został znaleziony.
     * Wyświetla komunikat o niepowodzeniu próby znalezienia istniejącego Punktu lub
     * o poprawnym usunięciu znalezionego Punktu.
     * Przyjmuje ona parametr 'request', który jest ww. żądaniem i obsługuje je.
     * Zwraca odpowiedź w postaci widoku, który ma być poprawnie wyświetlony.
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