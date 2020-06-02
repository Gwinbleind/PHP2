<pre>
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A; //Единственная разница с п.6 - отстутствие скобок. Но в конструктор класса все равно ничего не передается, поэтому результат будет таким же.
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
</pre>