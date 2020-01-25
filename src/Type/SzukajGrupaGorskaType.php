<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 05.01.2020
 * Time: 22:38
 */

namespace App\Type;


use App\Entity\GrupaGorska;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym Wyszukiwania Grup Górskich.
 * Class SzukajGrupaGorskaType
 * @package App\Type
 */
class SzukajGrupaGorskaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawne zbudowanie zawartości Aplikacji dotyczącej Wyszukiwanai Grup Górskich na stornie internetowej
     * poprzez ustawienie etykiet pól i domyślnych wartości.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupa', EntityType::class, [
                'class' => GrupaGorska::class,
                'choice_label' => 'nazwa_grupy',
                'placeholder' => '(Wybierz grupę)'
            ]);
    }

}