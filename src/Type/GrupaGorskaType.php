<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 05.01.2020
 * Time: 22:12
 */

namespace App\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym Grup Górskich.
 * @package App\Type
 */
class GrupaGorskaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawnę zbudowanie zawartości Aplikacji dotyczącej Grup Górskich na stornie internetowej
     * poprzez ustawienie etykiet pól i domyślnych wartości.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa_grupy', TextType::class, [
                'label' => 'Nazwa grupy',
                'attr'=> ['placeholder' => 'Nazwa grupy']
            ]);
    }

}