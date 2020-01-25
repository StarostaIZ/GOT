<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 05.01.2020
 * Time: 23:23
 */

namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym zgłaszania Błędów.
 * @package App\Type
 */
class BladType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawnę zbudowanie zawartości Aplikacji dotyczącej zgłaszania Błędów na stornie internetowej
     * poprzez ustawienie etykiet pól, domyślnych wartości i wariantów wyboru.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kategoria', ChoiceType::class, [
                'choices' => [
                    'Niezgodnosc danych' => 'Niezgodnosc danych',
                    'Błąd działania systemu' => 'Błąd działania systemu',
                    'Nieprzyznane punkty' => 'Nieprzyznane punkty'
                ],
                'attr' => ['style' => 'width: 300px']

            ])
            ->add('temat', TextType::class, [
                'label' => 'Temat'
            ])
            ->add('tresc', TextareaType::class, [
                'attr' => ['style' => 'height: 200px']

            ]);
    }

}