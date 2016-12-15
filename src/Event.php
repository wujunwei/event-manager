<?php
/**
 * Created by PhpStorm.
 * User: wjw33
 * Date: 2016-12-13
 * Time: 23:38
 */

namespace FirstW\EventManager;


use Psr\EventManager\EventInterface;

class Event implements EventInterface
{

    private $name;
    private $params;
    private $flag;
    private $target;

    public function __construct($name = '', $target = null, $params = [], $flag = false)
    {
        $this->setName($name);
        $this->setTarget($target);
        $this->setParams($params);
        $this->stopPropagation($flag);
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function getName()
    {
       return $this->name;
    }

    /**
     * Get target/context from which event was triggered
     *
     * @return null|string|object
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Get parameters passed to the event
     *
     * @return array
     */
    public function getParams()
    {
        return isset($this->params)? $this->params: [];
    }

    /**
     * Get a single parameter by name
     *
     * @param  string $name
     * @return mixed
     */
    public function getParam($name)
    {
        // TODO: Implement getParam() method.
    }

    /**
     * Set the event name
     *
     * @param  string $name
     * @return void
     */
    public function setName($name)
    {
       $this->name = strval($name);
    }

    /**
     * Set the event target
     *
     * @param  null|string|object $target
     * @return void
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * Set event parameters
     *
     * @param  array $params
     * @return void
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param  bool $flag
     */
    public function stopPropagation($flag)
    {
        $this->flag = boolval($flag);
    }

    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->flag;
    }
}