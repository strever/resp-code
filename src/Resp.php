<?php
/**
 * @Copyright (C), 2016 strever@qq.com
 * @Name  Resp.php
 * @Author  strever
 * @Version  1.0
 * @Date:  2016/7/25 12:49
 * @Description
 * @History
 *      <author>    <time>              <version >        <desc>
 *      Strever     2016/7/25 12:49      1.0            第一次建立该文件
 *
 */
namespace Strever\Http;

class Resp
{
    /**
     * status code
     *
     * @var int
     */
    protected static $_statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return self::$_statusCode;
    }

    /**
     * @param int $statusCode
     */
    public static function setStatusCode($statusCode)
    {
        self::$_statusCode = $statusCode;
        return self;
    }

    /**
     * 返回错误
     *
     * @author Strever
     * @access public
     * @param int $code
     * @param string $msg
     * @param string $format
     * @return array
     */
    public static function fail($code, $msg = '', $format = 'array')
    {
        $msg = $msg ? $msg : RespCode::getMessage($code);

        return self::send($code, $msg, [], $format);
    }

    /**
     * 返回错误json
     *
     * @param int $code
     * @param string $msg
     * @return array|string
     */
    public static function failWithJson($code, $msg = '')
    {
        $msg = $msg ? $msg : RespCode::getMessage($code);

        return self::send($code, $msg, [], 'json');
    }

    /**
     * 返回成功
     *
     * @author Strever
     * @access public
     * @param mixed $data
     * @param string $format
     * @return array|string
     */
    public static function success($data, $format = 'array')
    {
        return self::send(200, 'success', $data, $format);
    }

    /**
     * 返回成功json
     *
     * @param mixed $data
     * @return array|string
     */
    public static function successWithJson($data)
    {
        return self::send(200, 'success', $data, 'json');
    }

    /**
     * 返回
     *
     * @param int $code
     * @param string $msg
     * @param array $data
     * @param string $format
     * @return array|string
     */
    public static function send($code, $msg, $data = [], $format = 'array')
    {
        static $_reqTime = 0;
        $_reqTime === 0 and $_reqTime = $_SERVER['REQUEST_TIME_FLOAT'];
        $now = microtime(true);

        $respData = [
            'elapsed_time' => number_format(($now - $_reqTime), 4, '.', ''),
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        $_reqTime = $now;

        switch(strtolower($format))
        {
            case 'json':
                return json_encode($respData, JSON_UNESCAPED_UNICODE);
            default:
                return $respData;
        }
    }

    /**
     * 实现notFound，invalidParams等方法
     *
     * @param string $name 方法名
     * @param string $arguments 方法参数
     * @return array|null
     */
    public static function __callStatic($name, $arguments)
    {
        $errConstant = 'ERR_' . strtoupper(preg_replace('/([A-Z])/', '_$1', lcfirst($name)));
        if(RespCode::hasConstant($errConstant))
        {
            $errMsg = strtolower(str_replace(['ERR_', '_'], ['', ' '], $errConstant));
            return self::fail(RespCode::getConstant($errConstant), $errMsg, ...$arguments);
        }
    }

}