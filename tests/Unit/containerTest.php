<?php

use Core\Container;

test('container can resolve', function () {
    
    // arrange
    $container = new Container();

    $container->bind('foo', function () {

        return 'bar';
    });

    // act
    $result = $container->resolve('foo');

    // assert/expect
    expect($result)->toEqual('bar');
});
