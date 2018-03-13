<?php
/**
 * Call Queue Test
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Sequencer;

class CallQueueTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test call queue
     */
    public function testCallQueue()
    {
        $callQueue = new \Slab\Sequencer\CallQueue();

        $callQueue->addCall('method1', []);
        $callQueue
            ->addCall('method2', [])
            ->addCall('method3', [5, 7]);

        $this->assertCount(3, $callQueue->getEntries());

        $controller = new Mocks\CallQueueController();
        $callQueue->execute($controller);

        $this->assertEquals(49, $controller->getResult());
    }

    /**
     * @var \Slab\Sequencer\CallQueue
     */
    public $queue;

    /**
     * Tests abort queue and syntactic sugar
     */
    public function testAbortQueue()
    {
        $this->queue = new \Slab\Sequencer\CallQueue();
        $this->queue
            ->method1()
            ->method2()
            ->method3();

        $this->expectOutputString('onetwo');
        $this->queue->execute($this);
    }

    /**
     * Method1 in sequence call
     */
    public function method1()
    {
        echo 'one';
    }

    /**
     * Method2 in sequence call
     */
    public function method2()
    {
        echo 'two';
        $this->queue->stopExecution();
    }

    /**
     * Method3 in sqeuence call, never gets called
     */
    public function method3()
    {
        echo 'three';
    }
}