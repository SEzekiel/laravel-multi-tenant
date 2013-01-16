<?php

Autoloader::directories(array(
    __DIR__.DS.'classes',
    __DIR__.DS.'tasks',
));

Autoloader::namespaces(
    array('Tenancy' => Bundle::path('tenancy') . 'classes')
);