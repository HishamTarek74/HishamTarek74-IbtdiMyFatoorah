<?php

namespace HishamTarek\IbtdiMyFatoorah\Facades;

use Illuminate\Support\Facades\Facade;

class IbtdiMyFatoorah extends  Facade
{
    /**
     * return a container binding key in service provider
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'ibtdimyfatoorah';
    }
}