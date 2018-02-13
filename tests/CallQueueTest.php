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
}