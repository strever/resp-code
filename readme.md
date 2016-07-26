# strever/resp-code

a naming convention about response code

## Installation

`composer require strever/resp-code`

## Usage Docs

```php
\Strever\Util\Resp::success(['id' => 1]);

\Strever\Util\Resp::fail(404);
```

### api list

- fail
- failWithJson
- notFound
- invalidParams
- success
- successWithJson
...


## UnitTest

`$ phpunit tests/Util/RespTest.php`

## Contact

<strever@.qq.com>

## Other Resources

## Donate Me

[Alipay](qmailme@qq.com)

## License

MIT


