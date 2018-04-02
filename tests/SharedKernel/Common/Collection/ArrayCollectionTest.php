<?php

namespace Test\SharedKernel\Common\Collection;

use SharedKernel\Common\Collection\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ArrayCollectionTest extends TestCase
{
    public function testItShouldBePossibleToCreateAnEmptyArrayCollection()
    {
        $collection = ArrayCollection::createEmpty();

        $this->assertEmpty($collection);
    }

    public function testItShouldCreateACollectionFromArrayWithProperValues()
    {
        $collection = ArrayCollection::createFromArray(['firstElement', 'secondElement']);

        $this->assertCount(2, $collection);
        $this->assertEquals('firstElement', $collection->first());
        $this->assertEquals('secondElement', $collection->last());
    }

    public function testCollectionShouldBeAnArrayIterator()
    {
        $collection = ArrayCollection::createFromArray(['element']);

        $this->assertInstanceOf(\ArrayIterator::class, $collection->getIterator());
    }

    public function testMethodOffsetExistShouldReturnTrueWhenKeyExists()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'element']);
        
        $this->assertTrue($collection->offsetExists('key'));
        $this->assertFalse($collection->offsetExists('key_does_not_exists'));
        $this->assertTrue($collection->containsKey('key'));
    }

    public function testMethodOffsetGetShouldReturnTheValueOfTheProperKey()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'element']);
        
        $this->assertEquals($collection->offsetGet('key'), 'element');
        $this->assertEquals($collection->get('key'), 'element');
    }

    public function testMethodIsEmptyShouldReturnTrueWhenArrayCollectionIsEmpty()
    {
        $collection = ArrayCollection::createEmpty();

        $this->assertTrue($collection->isEmpty());
    }

    public function testMethodIsEmptyShouldReturnFalseWhenArrayCollectionHasElements()
    {
        $collection = ArrayCollection::createFromArray(['anElement']);

        $this->assertFalse($collection->isEmpty());
    }

    public function testContainsMethodShouldReturnTrueIfArrayCollectionHasTheElementRequested()
    {
        $collection = ArrayCollection::createFromArray(['anElement']);

        $this->assertTrue($collection->contains('anElement'));
    }

    public function testContainsMethodShouldReturnFalseIfArrayCollectionHasNotTheElementRequested()
    {
        $collection = ArrayCollection::createFromArray(['anElement']);

        $this->assertFalse($collection->contains('notFoundElement'));
    }

    public function testRemoveElementShouldRemoveTheElementRequestedFromTheArrayCollection()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);
        $collection->removeElement('anElement');

        $this->assertFalse($collection->containsKey('key'));
        $this->assertNotEmpty($collection);
    }

    public function testRemoveMethodShouldRemoveTheElementByKey()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);
        $collection->remove('key');

        $this->assertFalse($collection->containsKey('key'));
    }

    public function testFilterMethodShouldFilterTheCollectionByAClosure()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);
        $result = $collection->filter(
            function ($element) {
                return $element === 'anElement';
            }
        );

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('key', $result);
    }

    public function testOffsetSetShouldAddAnElementToTheArrayCollection()
    {
        $collection = ArrayCollection::createEmpty();
        $collection->offsetSet('key', 'value');

        $this->assertArrayHasKey('key', $collection);
        $this->assertTrue($collection->contains('value'));
    }

    public function testOffsetUnsetMethodShouldRemoveElementFromTheCollection()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'element']);

        $collection->offsetUnset('key');

        $this->assertEmpty($collection);
    }

    public function testMapMethodShouldMapAnArray()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);
        $result = $collection->map(
            function ($element) {
                return $element . "-plus";
            }
        );

        $this->assertEquals($result->first(), 'anElement-plus');
        $this->assertEquals($result->last(), 'anotherElement-plus');
    }

    public function testExistsMethodShouldReturnTrueWhenExistsAnElementThatAssertTheClosure()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);
        $result = $collection->exists(
            function ($key, $element) {
                return $element === 'anElement';
            }
        );

        $this->assertTrue($result);
    }

    public function testNextMethodAndCurrentMethodShouldReturnTheProperElementsFromTheArray()
    {
        $collection = ArrayCollection::createFromArray(['key' => 'anElement', 'key2' => 'anotherElement']);

        $this->assertEquals('anElement', $collection->current());
        $this->assertEquals('anotherElement', $collection->next());
    }

    public function testSetMethodShouldAddAKeyAndElementToTheCollection()
    {
        $collection = ArrayCollection::createEmpty();

        $collection->set('key', 'anElement');

        $this->assertCount(1, $collection);
        $this->assertArrayHasKey('key', $collection);
        $this->assertTrue($collection->contains('anElement'));

    }
}
