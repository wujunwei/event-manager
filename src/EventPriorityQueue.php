<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 下午 2:35
 */

namespace FirstW\EventManager;


class EventPriorityQueue
{
    const DEFAULT_LEVEL = 0;
    private $queue;
    public function __construct()
    {
        $this->queue = new \SplPriorityQueue();
    }

    public function insert(\Closure $callback, $priority = null)
    {
        if ($priority === null){
            $priority = static::DEFAULT_LEVEL;
        }
        $this->queue->insert($callback, $priority);
    }

    public function extract()
    {
        $this->queue->extract();
    }

}