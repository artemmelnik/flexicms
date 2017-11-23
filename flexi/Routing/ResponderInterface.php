<?php
namespace Flexi\Routing;

interface ResponderInterface
{

    /**
     * Response for module action execution.
     *
     * @return mixed
     */
    public function respond();

}
