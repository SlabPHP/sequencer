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
     * @var bool
     */
    private $ok = true;

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
     * @return $this
     */
    public function stopExecution()
    {
        $this->ok = false;

        return $this;
    }

    /**
     * Execute call queue
     *
     * @param $objectContext
     */
    public function execute($objectContext)
    {
        if (!$this->ok) return;

        foreach ($this->entries as $entry)
        {
            if (!$this->ok) return;

            $entry->execute($objectContext);
        }
    }
}