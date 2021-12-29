<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseAPIResource
 */
class BaseAPIResource extends JsonResource
{
    public static $action;
    
    const INDEX = 1;
    const STORE = 2;
    const UPDATE = 3;
    const BULK_STORE = 4;
    const BULK_UPDATE = 5;

    /**
     * @param $action
     */
    public static function setAction($action)
    {
          self::$action = $action;
    }

    /**
     * @return mixed
     */
    public static function getAction()
    {
        return self::$action;
    }
    
    public static function isUsingIndex()
    {
        self::setAction(self::INDEX);
    }
    
    public static function isUsingStore()
    {
        self::setAction(self::STORE);
    }
    
    public static function isUsingUpdate()
    {
        self::setAction(self::UPDATE);
    }

    public static function isUsingBulkStore()
    {
        self::setAction(self::BULK_STORE);
    }
    
    public static function isUsingBulkUpdate()
    {
        self::setAction(self::BULK_UPDATE);
    }
}
