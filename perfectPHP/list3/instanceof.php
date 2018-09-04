<?php
interface FooInterface
{

}

class ParentFoo
{

}

class Foo extends ParentFoo implements FooInterface
{

}

class Bar
{

}

$a = new Foo();
var_dump($a instanceof Foo);
var_dump($a instanceof ParentFoo);
var_dump($a instanceof FooInterface);
var_dump($a instanceof Bar);