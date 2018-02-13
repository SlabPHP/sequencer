<?php
/**
 * Mock Controller
 *
 * @package Slab
 * @subpackage Tests
 * @author Eric
 */
namespace Slab\Tests\Sequencer\Mocks;

class Controller
{
    /**
     * @var string
     */
    private $result = "undefined";

    /**
     * Mock test method
     */
    public function mockTestMethod()
    {
        $this->result = 'Ran Mock Test Method';
    }

    /**
     * Mock test method with parameters
     *
     * @param $parameters
     */
    public function mockTestMethodWithParameters($parameters)
    {
        $this->result = 'Ran Mock Test Method With Parameters: ' . implode(', ', $parameters);
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

}