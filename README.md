# SlabPHP sequencer

The Sequencer library is used to create re-usable class hierarchies of controllers. Methods are added to the sequencer so child controllers can add additional items to the sequence. The SlabPHP framework leverages these for most controllers.

SlabPHP was built many years ago, we're well aware about the distaste for protected members. For more information about SlabPHP, time travel, deprecation, life, love, and other things, please see the main SlabPHP framework documnetation.

## Example

Lets pretend we have a parent class that looks like this:

    <?php

    class Parent
    {
        /**
         * @var \Slab\Sequencer\CallQueue
         */
        protected $sequence;

        /**
         * @var int
         */
        protected $value = 0;

        /**
         * Public constructor
         */
        public function __construct()
        {
            $this->sequence = new \Slab\Sequencer\CallQueue();
            $this->value = 1;
        }

        /**
         * This adds the "doSomethingAlways" method to the Sequencer call queue but does not actually run it yet
         */
        public function setSequence()
        {
            $this->sequence
                ->doSomethingAlways();
        }

        /**
         * Multiply value by 2
         */
        public function doSomethingAlways()
        {
            $this->value *= 2;
        }

        /**
         * Actually run the functions in the sequence and echo the output
         */
        final public function execute()
        {
            $this->sequence->execute($this);

            echo $this->value;
        }
    }

And you use this as your controller all over the place. But you want to make a similar controller with an additional action. You could extend it as follows:

    <?php

    class Child extends Parent
    {
        /**
         * Overload and extend the setSequence function
         */
        public function setSequence()
        {
            parent::setSequence();

            $this->sequence
                ->doSomethingElse();
        }

        /**
         * Multiply the value again by 3
         */
        public function doSomethingElse()
        {
            $this->value *= 3;
        }
    }

If you were to do the following:

    $parent = new Parent();
    $parent->execute(); //echos 2

But if you do:

    $child =  new Child();
    $child->execute(); //echos 6
