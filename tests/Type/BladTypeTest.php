<?php
/**
 * Created by PhpStorm.
 * User: Maciek
 * Date: 25.01.2020
 * Time: 18:06
 */

namespace App\Tests\Type;

use App\Entity\Blad;
use App\Entity\Turysta;
use App\Type\BladType;
use Symfony\Component\Form\Test\TypeTestCase;

class BladTypeTest extends TypeTestCase
{
    public function testSubmitValidData(){


        $formData = [
            'temat' => 'Temat1',
            'tresc' => 'Błąd',
            'kategoria' => 'Niezgodnosc danych',
        ];
        $objectToCompare = new Blad();
        $form = $this->factory->create(BladType::class, $objectToCompare);
        $blad = new Blad();

        $blad->setKategoria('Niezgodnosc danych');
        $blad->setTemat('Temat1');
        $blad->setTresc('Błąd');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($blad, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
