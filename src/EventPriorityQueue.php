<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 下午 2:35
 */

namespace FirstW\EventManager;


class EventPriorityQueue extends \SplPriorityQueue
{
    const DEFAULT_LEVEL = 0;

    /**
     * EventPriorityQueue constructor.
     * @param \SplObjectStorage $obj
     * @param null $flag
     */
    public function __construct(\SplObjectStorage $obj = null, $flag = null)
    {
        if ($flag === null){
            $flag = static::EXTR_DATA;
        }
        $this->refresh($obj);
        $this->setExtractFlags($flag);
    }

    public function insert($callback, $priority = null)
    {
        if (!is_callable($callback)){
            return false;
        }
        if ($priority === null){
            $priority = static::DEFAULT_LEVEL;
        }
        parent::insert($callback, $priority);
        return true;
    }


    public function refresh(\SplObjectStorage $obj)
    {
        if (!$obj instanceof \SplObjectStorage){
            return ;
        }
        if ($obj->count() > 0){
            $obj->rewind();
            while ($obj->valid()){
                $this->insert($obj->current(), $obj->getInfo());
                $obj->next();
            }
        }
    }


}