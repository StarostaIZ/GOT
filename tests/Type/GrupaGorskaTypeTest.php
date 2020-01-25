<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 25.01.2020
 * Time: 19:11
 */

namespace App\Tests\Type;

use App\Entity\GrupaGorska;
use App\Type\GrupaGorskaType;
use Symfony\Component\Form\Test\TypeTestCase;

class GrupaGorskaTypeTest extends TypeTestCase
{
    public function testSubmitValidData(){

        $formData = [
            'nazwa_grupy' => 'Tatry',

        ];
        $objectToCompare = new GrupaGorska();
        $form = $this->factory->create(GrupaGorskaType::class, $objectToCompare);
        $grupaGorska = new GrupaGorska();

        $grupaGorska->setNazwaGrupy('Tatry');

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($grupaGorska, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }


}
