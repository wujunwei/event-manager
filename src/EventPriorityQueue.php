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
    public function __construct($level = null)
    {
        if ($level === null){
            $level = \SplPriorityQueue::EXTR_DATA;
        }
        $this->queue = new \SplPriorityQueue();
        $this->queue->setExtractFlags($level);
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
        return $this->queue->extract();
    }

    public function flush()
    {
        $this->queue = new \SplPriorityQueue();
    }

    public function top()
    {
        return $this->queue->top();
    }
    public function isEmpty()
    {
        return $this->queue->isEmpty();
    }

    public function getAll()
    {
        $data = [];
        if (!$this->isEmpty()){
            $this->queue->rewind();
            while($this->queue->valid()){
                $data[] = $this->queue->current();
                $this->queue->next();
            }
            return $data;
        }else{
            return $data;
        }
    }

}