<?php
/**
 * Created by PhpStorm.
 * User: wjw33
 * Date: 2016-12-13
 * Time: 23:39
 */

namespace FirstW\EventManager;


use Psr\EventManager\EventInterface;
use Psr\EventManager\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    /**
     * @var array
     */
    private $eventPool;
    /**
     * @var EventPriorityQueue[]
     */
    private $callbackPool = [];
    /**
     * EventManager constructor.
     */
    public function __construct()
    {
        $this->eventPool = new \SplObjectStorage();
    }

    /**
     * Attaches a listener to an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @param int $priority the priority at which the $callback executed
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = EventPriorityQueue::DEFAULT_LEVEL)
    {
        // TODO: Implement attach() method.
    }

    /**
     * Detaches a listener from an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @return bool true on success false on failure
     */
    public function detach($event, $callback)
    {
        // TODO: Implement detach() method.
    }

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
    public function clearListeners($event)
    {
        $this->callbackPool[$event]->flush();
    }

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param  string|EventInterface $event
     * @param  object|string $target
     * @param  array|object $argv
     * @return mixed
     */
    public function trigger($event, $target = null, $argv = array())
    {
        // TODO: Implement trigger() method.
    }
}