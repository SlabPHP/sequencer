<?php
/**
 * Sequencer Call Queue class
 *
 * @author Eric
 * @package Slab
 * @subpackage Sequencer
 */
namespace Slab\Sequencer;

class CallQueue
{
    /**
     * Our list of entries to run
     *
     * @var Entry[]
     */
    private $entries = array();

    /**
     * Add an item to the call queue (syntactic sugar)
     *
     * @param string $method
     * @param array $parameters
     *
     * @return CallQueue
     */
    public function __call($method, $parameters)
    {
        return $this->addCall($method, $parameters);
    }

    /**
     * Add a method to a call queue
     *
     * @param $method
     * @param $parameters
     * @return $this
     */
    public function addCall($method, $parameters)
    {
        $this->entries[] = new Entry($method, $parameters);

        return $this;
    }

    /**
     * Return entries to the context
     *
     * @return Entry[]
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Execute call queue
     *
     * @param $objectContext
     */
    public function execute($objectContext)
    {
        foreach ($this->entries as $entry)
        {
            $entry->execute($objectContext);
        }
    }
}