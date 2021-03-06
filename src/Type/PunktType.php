<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 04.01.2020
 * Time: 15:42
 */

namespace App\Type;


use App\Entity\GrupaGorska;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym Punktów.
 * @package App\Type
 */
class PunktType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawne zbudowanie zawartości Aplikacji dotyczącej Punktów na stornie internetowej
     * poprzez ustawienie etykiet pól i domyślnych wartości.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa_pkt', TextType::class, [
                'label' => 'Nazwa punktu',
                'attr' => ['placeholder' => 'Nazwa punktu']
            ])
            ->add('grupa_gorska', EntityType::class,
                [
                    'class' => GrupaGorska::class,
                    'label' => 'Grupa górska',
                    'choice_label' => 'nazwa_grupy',
                    'placeholder' => '(Wybierz grupę)'
                ])
            ->add('wysokosc', IntegerType::class, [
                'label' => 'Wysokosc',
                'required' => false,
                'attr' => ['placeholder' => 'Wysokosc']
            ])
            ->add('szerokosc_geogr', NumberType::class, [
                'label' => 'Szerokość geograficzna',
                'required' => false,
                'attr' => ['placeholder' => 'Szerokosc geograficzna']
            ])
            ->add('dlugosc_geogr', NumberType::class, [
                'label' => 'Długosc geograficzzna',
                'required' => false,
                'attr' => ['placeholder' => 'Długosc geograficzna']
            ]);
    }

}