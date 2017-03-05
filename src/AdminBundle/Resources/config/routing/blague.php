<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('blague_index', new Route(
    '/',
    array('_controller' => 'AdminBundle:Blague:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('blague_show', new Route(
    '/{id}/show',
    array('_controller' => 'AdminBundle:Blague:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('blague_new', new Route(
    '/new',
    array('_controller' => 'AdminBundle:Blague:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('blague_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AdminBundle:Blague:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('blague_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AdminBundle:Blague:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
