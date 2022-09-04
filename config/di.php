<?php

use Database\PdoHandle;
use Http\Requests\Request;
use Database\HandleInterface;

return [
    HandleInterface::class => DI\create(PdoHandle::class),
];