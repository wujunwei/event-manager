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
     * @var EventPriorityQueue[]
     */
    private $EventPool = [];
    /**
     * @var \SplObjectStorage[]
     */
    private $ObjPool = [];

    /**
     * Attaches a listener to an event
     *
     * @param string $event the event to attach too
     * @param \Closure|callable $callback a callable function
     * @param int $priority the priority at which the $callback executed
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = EventPriorityQueue::DEFAULT_LEVEL)
    {
        if (!isset($this->EventPool[$event])){
            $this->EventPool[$event] = new EventPriorityQueue();
            $this->ObjPool[$event] = new \SplObjectStorage();
        }
        if ($callback instanceof \Closure){
            $callback = function ($event) use($callback){
                return call_user_func($callback, $event);
            };
        }
        $this->ObjPool[$event]->attach($callback, $priority);
        return $this->EventPool[$event]->insert($callback, $priority);
    }

    /**
     * Detaches a listener from an event
     *
     * @param string $event the event to attach too
     * @param \Closure|string $callback a callable function
     * @return bool true on success false on failure
     */
    public function detach($event, $callback)
    {
        if ($this->ObjPool[$event]->contains($callback)){
            $this->ObjPool[$event]->detach($callback);
        }

        $this->EventPool = new EventPriorityQueue($this->ObjPool[$event]);
    }

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
    public function clearListeners($event)
    {
        $this->ObjPool[$event]->removeAll($this->ObjPool[$event]);
        $this->EventPool[$event] = new EventPriorityQueue();
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
        if (is_string($event)){
            $name = $event;
            $event = new Event($name, $target, $argv);
        }else{
            $name = $event->getName();
            $event->setParams($argv);
            $event->setTarget($target);
        }
        $callbacks = $this->EventPool[$name];
        $callbacks->rewind();
        while ($callbacks->valid()){
            if ($event->isPropagationStopped()) {
                break;
            }
            call_user_func($callbacks->current(), $event);
            $callbacks->next();
        }
        return ;
    }
}