[![](https://gitlab.com/nael_d/encrypia/-/raw/master/logo-main.png)](https://gitlab.com/nael_d/encrypia)

The two-way PHP-based encryption class with custom unique encryption key that lets you blind texts before you save them into your database.

## Features
- Blind and Unblind texts with a unique key
- Objective and Static initialization
- Inline static blinding and unblinding texts instantly
- A simple examples are provided within (examples) folder.

## Before you go..
Encrypia works as well with PHP 5.3.0 minimum and above.

## How to start
1) Download the library and include it into your project.
2) If your project is MVC architecture, include it in the base layer to load it for whole code environment. For laravel, [See this example like](https://stackoverflow.com/questions/28816707/how-can-i-add-external-class-in-laravel-5).
Otherwise, include it in any page that you want to use.
3) You are able to init the library in two ways: Objective and Static.

## Start coding
- To use Encrypia in the Objective way, it will look like this:
    ```sh
    require './Encrypia.php';
    $encrypia = new Encrypia;
    ```

    Encrypia requires you to set a unique key to encrypt your texts.
    You can set it as a constructor parameter, like:
    ```sh
    $encrypia = new Encrypia('your-key');
    ```
    
    Or, you can set it using ```setKey()``` method, like:
    ```sh
    $encrypia = new Encrypia;
    $encrypia->setKey('your-key');
    ```
    The benefit of this method is to allow you to change the key dynamically anytime you want.
    
    And so, you can get your key using ```getKey()``` method, like:
    ```sh
    $encrypia = new Encrypia;
    $encrypia->setKey('your-key');
    echo $encrypia->getKey(); // output: 'your-key'
    /*******/
    $encrypia = new Encrypia('your-key');
    echo $encrypia->getKey(); // output: 'your-key'
    ```
    
    As for the type of the key, it could be ```Integer```, ```String``` or both of them, like:
    ```sh
    $encrypia = new Encrypia(74192579);
    // or
    $encrypia = new Encrypia('@any-text.7863296410_here!');
    ```
    
    The maximum length of ```Integer``` key is 19. If your key exceeded it, it will return error like:
    ```sh
    $encrypia = new Encrypia(12345678901234567890); // key length is 20
    // or
    $encrypia->setKey(12345678901234567890); // key length is 20
    //////
    Output:
    Error in Encrypia key type: double. Allowed types are: [String, Integer].
    ```
    
    In this case, you can pass it as a ```String``` type, like:
    ```sh
    $encrypia = new Encrypia('12345678901234567890'); // key length is 20
    // or
    $encrypia->setKey('12345678901234567890'); // key length is 20
    ```
    And nothing will bother you!

    ___

- This is about how to start as Objective. For Static way, you have to use the ```setKey()``` method regarding that Static classes does not have constructors, and it will be look like:
    ```sh
    require './Encrypia.php';
    Encrypia::setKey(9501746328);
    ```
    
    And again, you can get your key using ```getKey()``` method, like:
    ```sh
    require './Encrypia.php';
    Encrypia::setKey(9501746328);
    echo Encrypia::getKey(); // output: 9501746328
    ```
    
For future, all methods are able to be called objectively and staticly as the previous instructions like.

## Encryption and Decryption
Encrypia encrypts texts using ```blind()``` method. For example:
```sh
require './Encrypia.php';
$encrypia = new Encrypia(3975135);
echo $encrypia->blind('Hello world!'); // outputs: Knsqp#|r{si"
// or
Encrypia::setKey(3975135);
echo Encrypia::blind('Hello world!'); // outputs: Knsqp#|r{si"
```

And vice versa, Encrypia decrypts texts using ```unblind()``` method. For example:
```sh
require './Encrypia.php';
$encrypia = new Encrypia(3975135);
echo $encrypia->unblind('Knsqp#|r{si"'); // outputs: Hello world!
// or
Encrypia::setKey(3975135);
echo Encrypia::unblind('Knsqp#|r{si"'); // outputs: Hello world!
```

You know what? You can pass your key into ```blind()``` and ```unblind()``` as a second parameter. Have a look at the following example:
```sh
require './Encrypia.php';
// Objectively
$encrypia = new Encrypia;
$encrypia->setKey('7890465132');
// You can pass the key into the constructor as we saw before. Both are Ok.
echo $encrypia->blind("Blinded text"); // outputs: Itrnhki!wg|
echo $encrypia->blind("Blinded text", 51068765); // outputs: Gmitllj%yfxz

echo $encrypia->unblind("Gmitllj%yfxz"); // outputs: @e`thfe$vdqr
// Notice above if we tried to unblind any text with a wrong key.
echo $encrypia->unblind("Gmitllj%yfxz", 51068765); // outputs: Blinded text

// or Staticly
Encrypia::setKey('7890465132');
echo Encrypia::blind('Hello world!', 51068765); // outputs: Mflrw'}twmd'
echo Encrypia::unblind("Mflrw'}twmd'", 51068765); // outputs: Hello world!
```

The benefits of this way is to ```blind()``` or ```unblind()``` texts with a custom key for this line only and without affecting the global key.

## Conditions of usage
Encrypia is free to use in all your projects, Commercial and Personal, with a few conditions:
1) Use Encrypia as is without any modifications. If you did, we do not guarantee that it will work as well. Encrypia is always being improved.
2) Mention Encrypia and its Gitlab repository link into your documentation and presentation that you made and prepare. This will help us to expand and we appreciate your collaboration.
3) Loved Encrypia and you would like to support us? Please click Start button in Gitlab and share it with your technical friends.

And, That's it! Thanks for using Encrypia.

