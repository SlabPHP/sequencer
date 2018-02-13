<?php
/**
 * Sequence call entry class
 *
 * The sequence call queue will create and store entries for later sequential operations.
 *
 * @author Eric
 * @package Slab
 * @subpackage Sequencer
 */
namespace Slab\Sequencer;

class Entry
{
    /**
     * Method name
     *
     * @var string
     */
    private $method;

    /**
     * Parameters
     *
     * @var array()
     */
    private $parameters;

    /**
     * Instantiate a pipeline entry
     *
     * @param string $method
     * @param array $parameters
     */
    public function __construct($method, $parameters)
    {
        $this->method = $method;

        $this->parameters = $parameters;
    }

    /**
     * Execute a sequence
     *
     * @param $objectContext
     */
    public function execute($objectContext)
    {
        if (method_exists($objectContext, $this->method))
        {
            if (!empty($this->parameters))
            {
                $objectContext->{$this->method}($this->parameters);
            }
            else
            {
                $objectContext->{$this->method}($this->parameters);
            }
        }
    }

}