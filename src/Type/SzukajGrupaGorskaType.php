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

class SzukajGrupaGorskaType extends AbstractType
{
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