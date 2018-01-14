# Coding style guide

## PHP

### Using the SonarQube server:
## PHPStorm:
In PHPStorm go to ``` Settings -> Plugins```
Search for SonarLint. Install it.

Restart PHPStorm then go to ```Settings -> Other settings -> SonarLint General settings```.

Add a new SonarQube server with the following address:
http://159.89.110.192:9000

Set authentication method then click finish.

Go to ```Settings -> Other settings -> SonarLint Project settings```

Set ```Enable binding to remote SonarQube server```

Select the server to bind to, then select the SonarQube project.

Click Apply

### Naming conventions
- Use engilsh names only
- Use CamelCase names for classes
- Use camelCase names for functions and variables
- Use UPPER_CASE names for constants
- Avoid non-descriptive names:
    -  NO:
    ```php
    <?php

    $x = $y * $z;
    ```
    - YES:
    ```php
    <?php

    $orderTotal = $price * $quantity;
    ```

### Indentation
Start indentation from the beginning of the line and use 4 spaces for indentation:
```php
<?php

function foo()
{
    return "bar";
}
```

For continuation indentation also use 4 spaces:
```php
<?php

function foo()
{
    return
        "bar";
}
```
The next line after an opening curly bracket (`{`) is one indentation level deeper except if it is the closing bracket (`}`):
```php
<?php

function foo(bool $x)
{
    // First indentation level starts here
    if ($x === false)
    {
        // Second indentation level starts here
        ...
    }  // Second indentation level is closed
}  // First indentation level is closed

function bar()
{
    ...
}
```
### Spaces
Add one space before:
- Anyonymous function parentheses:
```php
<?php

$foo = function ()
{
    return "bar";
}
```
- if parentheses:
```php
<?php

if ($foo)
{
    return "bar";
}
```
- for parentheses:
```php
<?php

for ($i = 0; $i < 100; $i++)
{
    echo $i;
}
```
- while parentheses:
```php
<?php

while ($foo != $bar)
{
    echo "foobar";
}
```
- switch parentheses:
```php
<?php

switch ($j)
{
    case 0:
        $s1 = 'zero';
        break;
    case 2:
        $s1 = 'two';
        break;
    default:
        $s1 = 'other';
}
```
- catch parentheses:
```php
<?php

try
{
    someFuncThatCanThrowAnException();
}
catch (exception $e)
{
    echo $e;
}
```

Add one space before and after all binary operators ( `=`, `+=`, `.` (concatenation), etc.) except `->` :
```php
<?php

class FooBar
{
    var $foo = false;
    var $bar = false;

    function __construct(bool $foo = false, bool $bar = false)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }

    function isFoo()
    {
        return $this->foo && !$this->bar;
    }

    function isBar()
    {
        return $this->bar && !$this->foo;
    }

    function isFooBar()
    {
        return $this->foo && $this->bar;
    }

}
```
For ternary operators the following formats are valid:
```php
<?php

$k = $x > 15 ? 1 : 2;
$k = $x ?: 0;
$k = $x ?? $z;
$k = $x <=> $z;
```

One space should follow:
- A comma:
```php
<?php

function foo($x, $z)
{
    ...
}
```
- A semicolon:
```php
<?php

for ($i = 0; $i < $x; $i++)
{
    $y += ($y ^ 0x123) << 2;
}
```
- A colon in return type:
```php
<?php

function foo() : Foo
{
}
```
### Wrapping and braces
Curly braces always go in separate lines:
```php
<?php

class Foo
{
    function bar()
    {
        for ($i = 0; $i < 2; $i++)
        {
            ...
        }
        try
        {
            ...
        }
        catch
        {
            ...
        }
    }
}
```
Multiline function parameters should be aligned:
```php
<?php

function bar($v,
             $w = "a")
{
}
```

Avoid multi line if statements. Consider using separate variables or functions instead:
- NO
    ```php
    <?php

    if (
        method_exists($animal, "walk") &&
        method_exists($animal, "quack") &&
        method_exists($animal, "fly")
        )
    {
        $ainimal->duckUnderWater();
    }
    ```
- YES
    ```php
    <?php

    /**
     * If it walks like a duck,
     * quacks like a duck
     * and flies like a duck,
     * then it must be a duck!
     */
    function isADuck(Animal $animal) : bool
    {
        return method_exists($animal, "walk") &&
               method_exists($animal, "quack") &&
               method_exists($animal, "fly");
    }

    if (isADuck($animal))
    {
        $animal->duckUnderWater();
    }
    ```

### Blank lines
There should be a blank line after the ```<?php``` tag except for the ```namespace``` declarion which should go in the same line:
- namespace declaration:
    ```php
    <?php namespace Foo\Bar;
    ```
- functions:
    ```php
    <?php

    function foo()
    {

    }

    $foo = foo();
    ```
There should be a blank round around (before and after):
- use statements:
    ```php
    <?php namespace Acme\Package;

    use Acme\Foo;
    use Acme\Bar;

    $foo = "bar";
    ```
- classes:
    ```php
    <?php namespace Acme\Package;

    use Acme\Foo;
    use Acme\Bar;

    class Foo
    {

    }

    class Bar
    {

    }

    $fooBar = "fooBar";
    ```
- class methods:
    ```php
    <?php

    class Foo
    {
        var $x;
        var $y;

        function foo()
        {

        }

        function bar()
        {

        }
    }
    ```
