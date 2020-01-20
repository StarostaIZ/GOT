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

class SzukajOdcinekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('punkt_poczatkowy', EntityType::class, [
            'class' => Punkt::class,
            'choice_label' => 'nazwa_pkt'
            ])
            ->add('punkt_koncowy', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt'
            ]);
    }

}