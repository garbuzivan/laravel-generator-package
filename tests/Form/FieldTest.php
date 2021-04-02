<?php

declare(strict_types=1);

namespace GarbuzIvan\LaravelGeneratorPackage\Tests\Form;

use Exception;
use GarbuzIvan\LaravelGeneratorPackage\Configuration;
use GarbuzIvan\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;
use GarbuzIvan\LaravelGeneratorPackage\Facades\Field;
use GarbuzIvan\LaravelGeneratorPackage\Form\Fields\TextField;
use GarbuzIvan\LaravelGeneratorPackage\Form\Form;
use Illuminate\Support\Str;

class FieldTest extends \GarbuzIvan\LaravelGeneratorPackage\Tests\TestCase
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
     * Test set\get References field
     */
    public function testReferences()
    {
        $field = Field::text('title', 'Title')->references('table_name', 'field_name', false);
        $this->assertTrue($field->getReferencesTable() == 'table_name');
        $this->assertTrue($field->getReferencesField() == 'field_name');
        $this->assertTrue($field->getReferencesMany() == false);
        $this->assertTrue($field->referencesDisabled()->getReferencesField() == null);
    }

    /**
     * Test References Exception field
     */
    public function testReferencesException()
    {
        $this->expectException(Exception::class);
        $field = Field::text('title', 'Title')->references(' ', ' ');
    }

    /**
     * Test Field Does Not Exists Exception
     */
    public function testFieldDoesNotExistsException()
    {
        $this->expectException(FieldDoesNotExistsException::class);
        $field = Field::tralalaololo('title', 'Title');
    }

    /**
     * Test set\get saving field
     */
    public function testSaving()
    {
        $form = app(Form::class);
        $field = Field::text('title', 'test')
            ->setSaving(function(Form $form) {
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
        $form = app(Form::class);
        $field = Field::text('title', 'test')
            ->setSaved(function(Form $form) {
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
        $form = app(Form::class);
        $field = Field::text('title', 'test')
            ->setView(function(string $column, Form $form) {
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
        $form = app(Form::class);
        $field = Field::text('title', 'test')
            ->setViewGrid(function(string $column, Form $form) {
                return true;
            });
        $function = $field->viewGrid();
        $this->assertTrue($function('title', $form));
    }

    /**
     * Test set\get fillable field
     */
    public function testFillable()
    {
        $field = Field::text('title', 'test')
            ->fillable(false);
        $this->assertFalse($field->getFillable());
    }

    /**
     * Test set\get fillable field
     */
    public function testHidden()
    {
        $field = Field::text('title', 'test')
            ->hidden(true);
        $this->assertTrue($field->getHidden());
    }

    /**
     * Test set\get fillable field
     */
    public function testFindFieldClass()
    {
        $field = app(\GarbuzIvan\LaravelGeneratorPackage\Form\Field::class);
        $config = app(Configuration::class);
        $config->setField('test', TextField::class);
        $fieldName = array_key_first($config->getFields());
        $this->assertTrue(is_string($field->findFieldClass($fieldName)));
        $this->assertFalse($field->findFieldClass(Str::random()));
    }


    /**
     * Test required
     */
    public function testRequired()
    {
        $this->assertFalse(Field::text('title', 'test')->required(false)->getRequired());
    }

    /**
     * Test max
     */
    public function testMax()
    {
        $this->assertTrue(Field::text('title', 'test')->max(123)->getMax() == 123);
    }

    /**
     * Test min
     */
    public function testMin()
    {
        $this->assertTrue(Field::text('title', 'test')->min(321)->getMin() == 321);
    }

    /**
     * Test index
     */
    public function testIndex()
    {
        $this->assertTrue(Field::text('title', 'test')->index()->isIndex());
    }

    /**
     * Test index
     */
    public function testDefault()
    {
        $this->assertTrue(Field::text('title', 'test')->default('testpack')->getDefault() == 'testpack');
    }
}
