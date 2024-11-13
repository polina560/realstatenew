<?php

namespace common\models;

class TextStatus
{
    public const main_address = 'main_address';
    public const main_phone = 'main_phone';
    public const sales_office_address  = 'sales_office_address';
    public const sales_office_phone = 'sales_office_phone';


    public function getConstants()
    {
//        $reflectionClass = new ReflectionClass($this);
//        return $reflectionClass->getConstants();

        return array( self::main_address=>'Основной адрес',  self::main_phone=>'Основной телефон',
            self::sales_office_address=>'Офис продаж. Адрес', self::sales_office_phone=>'Офис продаж. Телефон');
    }


    public function getDeletableName($id)
    {
        if($id == self::main_address)
            return "Основной адрес";
        if($id == self::main_phone)
            return "Основной телефон";
        if($id == self::sales_office_address)
            return "Офис продаж. Адрес";
        if($id == self::sales_office_phone)
            return "Офис продаж. Телефон";

    }
}
