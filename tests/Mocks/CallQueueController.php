<?php
/**
 * Mock Controller
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Sequencer\Mocks;

class CallQueueController
{
    /**
     * @var integer
     */
    private $result = 0;

    /**
     * Method1
     */
    public function method1()
    {
        $this->result = 1;
    }

    /**
     * Method2
     */
    public function method2()
    {
        $this->result *= 2;
    }

    /**
     * Method 3
     *
     * @param $parameters
     */
    public function method3($parameters)
    {
        $this->result += $parameters[0];
        $this->result *= $parameters[1];
    }

    /**
     * @return integer
     */
    public function getResult()
    {
        return $this->result;
    }

}