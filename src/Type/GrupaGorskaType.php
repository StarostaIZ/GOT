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

class GrupaGorskaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa_grupy', TextType::class, [
                'label' => 'Nazwa grupy',
                'attr'=> ['placeholder' => 'Nazwa grupy']
            ]);
    }

}