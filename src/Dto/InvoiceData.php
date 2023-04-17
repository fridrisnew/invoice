<?php


namespace Fridris\Invoice\Dto;


class InvoiceData
{
    public function toArray()
    {
        foreach($this as $key => $object)
        {
            if(is_object($object) && method_exists($object,'toArray')) {
                $arrays[$key] = $object->toArray();
            } elseif (is_array($object))
            {
                foreach ($object as $arrayObject)
                {
                    if(is_object($arrayObject) && method_exists($arrayObject,'toArray')) {
                        $arrays[$key][] = $arrayObject->toArray();
                    }
                }
            }
            else {
                $arrays[$key] = $object;
            }
        }
        return $arrays;
    }
}
