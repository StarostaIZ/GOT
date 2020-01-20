<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 05.01.2020
 * Time: 20:22
 */

namespace App\Type;


use App\Entity\Punkt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SzukajPunktType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('punkt', EntityType::class, [
                'class' => Punkt::class,
                'choice_label' => 'nazwa_pkt',
                'placeholder' => '(Wybierz punkt)'
            ]);

    }

}