<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Test\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use GarbuzIvan\LaravelGeneratorPackage\Form\Form;
use Tests\TestCase;

class FieldTest extends TestCase
{
    /**
     * Test create field
     */
    public function testFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }

    /**
     * Test Exception Type Column
     */
    public function testFieldInitExceptionTypeColumn()
    {
        $this->expectException(Exception::class);
        Field::text(123, 'Title');
    }

    /**
     * Test Exception Mask Column
     */
    public function testFieldInitExceptionMaskColumn()
    {
        $this->expectException(Exception::class);
        Field::text('проверка', 'Title');
    }

    /**
     * Test set\get type field
     */
    public function testTypeField()
    {
        $field = Field::text('title', 'Title')->setType('string');
        $this->assertTrue($field->getType() == 'string');
    }

    /**
     * Test set\get light field
     */
    public function testLightField()
    {
        $field = Field::text('title', 'Title')->setLight(100);
        $this->assertTrue($field->getLight() == 100);
    }

    /**
     * Test set\get mask field
     */
    public function testMaskField()
    {
        $field = Field::text('title', 'Title')->setMask('0000-0000');
        $this->assertTrue($field->getMask() == '0000-0000');
    }

    /**
     * Test set\get placeholder field
     */
    public function testPlaceholder()
    {
        $field = Field::text('title', 'Title')->setPlaceholder('Placeholder');
        $this->assertTrue($field->getPlaceholder() == 'Placeholder');
    }

    /**
     * Test set\get placeholder field
     */
    public function testReferences()
    {
        $field = Field::text('title', 'Title')->references('table_name', 'field_name', false);
        $this->assertTrue($field->getReferencesTable() == 'table_name');
        $this->assertTrue($field->getReferencesField() == 'field_name');
        $this->assertTrue($field->getReferencesMany() == false);
    }

    /**
     * Test set\get saving field
     */
    public function testSaving()
    {
        $form = new Form();
        $field = Field::text('title', 'test')
            ->setSaving(function (Form $form) {
                return true;
            });
        $function = $field->saving();
        $this->assertTrue($function($form));
    }

    /**
     * Test set\get saved field
     */
    public function testSaved()
    {
        $form = new Form();
        $field = Field::text('title', 'test')
            ->setSaved(function (Form $form) {
                return true;
            });
        $function = $field->saved();
        $this->assertTrue($function($form));
    }

    /**
     * Test set\get view field
     */
    public function testView()
    {
        $form = new Form();
        $field = Field::text('title', 'test')
            ->setView(function (string $column, Form $form) {
                return true;
            });
        $function = $field->view();
        $this->assertTrue($function('title', $form));
    }

    /**
     * Test set\get viewGrid field
     */
    public function testViewGrid()
    {
        $form = new Form();
        $field = Field::text('title', 'test')
            ->setViewGrid(function (string $column, Form $form) {
                return true;
            });
        $function = $field->viewGrid();
        $this->assertTrue($function('title', $form));
    }
}
