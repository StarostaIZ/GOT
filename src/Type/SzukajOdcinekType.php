<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 04.01.2020
 * Time: 13:57
 */

namespace App\Type;


use App\Entity\Punkt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym Wyszukiwania Odcinków Tras.
 * @package App\Type
 */
class SzukajOdcinekType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawne zbudowanie zawartości Aplikacji dotyczącej Wyszukiwania Odcinków Tras na stornie internetowej
     * poprzez ustawienie etykiet pól i domyślnych wartości.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('punkt_poczatkowy', EntityType::class, [
            'class' => Punkt::class,
            'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)',
                'attr' => ['onchange' => 'getPunktyKoncowe()']
            ])
            ->add('punkt_koncowy', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)',
                'attr' => ['onchange' => 'getPunktyPoczatkowe()']
            ]);
    }

}