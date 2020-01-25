<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 03.01.2020
 * Time: 18:39
 */

namespace App\Type;


use App\Entity\GrupaGorska;
use App\Entity\OdcinekTrasy;
use App\Entity\Punkt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OdcinekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('punkt_poczatkowy', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)'
            ])
            ->add('punkt_koncowy', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)'
            ])
            ->add('dlugosc', NumberType::class, [
                'invalid_message' => 'Wpisz poprawną wartosc',
                'attr' => ['placeholder' => 'Dlugosc (km)'],
                'label' => 'Długość',
                'required' => false
            ])
            ->add('pkt_za_przejsce', IntegerType::class, [
                'attr' => ['placeholder' => 'Punkty za przejscie'],
                'label' => "Punkty za przejście"
            ])
            ->add('pkt_za_powrot', IntegerType::class, [
                'attr' => ['placeholder' => 'Pkt za powrot'],
                'label' => 'Punkty za powrót',
                'required' => false
            ])
            ->add('suma_przewyzszen', IntegerType::class, [
                'attr' => ['placeholder' => 'W górę (m)'],
                'label' => 'Suma przewyższeń',
                'required' => false
            ])->add('suma_spadkow', IntegerType::class, [
                'attr' => ['placeholder' => 'W dół (m)'],
                'label' => 'Suma spadków',
                'required' => false
            ]);
    }

}