<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 05.01.2020
 * Time: 20:22
 */

namespace App\Type;


use App\Entity\Punkt;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Klasa odpowiedzialna za zawartość poszczególnych elementów
 * na ekranie aplikacji dotyczącym Wyszukiwania Punktów.
 * Class SzukajPunktType
 * @package App\Type
 */
class SzukajPunktType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Funkcja odpowiedzialna za poprawne zbudowanie zawartości Aplikacji dotyczącej Wyszukiwania Punktów na stornie internetowej
     * poprzez ustawienie etykiet pól i domyślnych wartości.
     * Przyjmuje paramter 'builder' określający obiekt odpowiedzialny za budowę tej struktury
     * Przyjmuje paramter 'options' określający dodatkowe opcje, z którymi ma być budowana struktura.
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $grupagorskaId = $options["grupa"];
        $builder
            ->add('punkt', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)',
//                'query_builder' => function(EntityRepository $er) use ($grupagorskaId){
//                return $er->createQueryBuilder('p')
//                    ->andWhere('p.grupa_gorska = :val')
//                    ->setParameter('val', $grupagorskaId);
//                }
            ]);

    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'grupa' => null
//        ]);
//    }

}