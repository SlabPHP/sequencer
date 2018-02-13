<?php
/**
 * Tests for the Sequencer Entry
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Sequencer;

class EntryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test entry creation
     */
    public function testEntryCreation()
    {
        $mockClass = new Mocks\Controller();

        $entry = new \Slab\Sequencer\Entry('mockTestMethod', []);
        $entry->execute($mockClass);

        $this->assertEquals('Ran Mock Test Method', $mockClass->getResult());

        $entry = new \Slab\Sequencer\Entry('mockTestMethodWithParameters', ['parameter1', 'parameter2']);
        $entry->execute($mockClass);

        $this->assertEquals('Ran Mock Test Method With Parameters: parameter1, parameter2', $mockClass->getResult());
    }
}