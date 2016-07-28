<?php
/**
 * @Copyright (C), 2016 strever@qq.com
 * @Name  JumpType.php
 * @Author  strever <xingjian@juanpi.com>
 * @Version  1.0
 * @Date:  2016/7/22 12:49
 * @Description
 * @History
 *      <author>    <time>              <version >        <desc>
 *      Strever     2016/7/22 12:49      1.0            第一次建立该文件
 *
 */
namespace Strever\Utils;

class RespCode
{
    // [POST/PUT/PATCH]：用户发出的请求有错误，服务器没有进行新建或修改数据的操作，该操作是幂等的。
    const ERR_BAD_REQUEST = 400;

    // 表示用户没有权限（令牌、用户名、密码错误）。
    const ERR_UNAUTHORIZED = 401;

    // 表示用户得到授权（与401错误相对），但是访问是被禁止的。
    const ERR_FORBIDDEN = 403;

    // 用户发出的请求针对的是不存在的记录，服务器没有进行操作，该操作是幂等的。
    const ERR_NOT_FOUND = 404;

    // 该http方法不被允许,比如不允许get访问
    const ERR_METHOD_NOT_ALLOWED = 405;

    // 用户请求的格式不可得（比如用户请求JSON格式，但是只有XML格式）。或者认为不提供这种服务
    const ERR_NOT_ACCEPTABLE = 406;

    // [GET]：用户请求的资源被永久删除，且不会再得到的。
    const ERR_GONE = 410;

    // 请求过多
    const ERR_TOO_MANY_REQUEST = 429;

    // 服务器发生错误，用户将无法判断发出的请求是否成功。
    const ERR_INTERNAL = 500;

    // 未知错误
    const ERR_UNKNOWN = 510;

    // 无效参数
    const ERR_INVALID_PARAMS = 420;

    // 请求鉴权token未通过
    const ERR_INVALID_TOKEN = 440;

    // 不是cli请求
    const ERR_NOT_CLI = 450;


    /**
     * @var \ReflectionClass
     */
    private static $_reflectionClass = null;

    /**
     * 获取自己的反射
     *
     * @author strever
     * @date 2016/5/5
     * @return \ReflectionClass
     */
    public static function getReflectionClass()
    {
        if(!self::$_reflectionClass instanceof \ReflectionClass)
        {
            self::$_reflectionClass = new \ReflectionClass(__CLASS__);
        }

        return self::$_reflectionClass;
    }

    /**
     * 检查常量是否已经定义
     *
     * @param $constant
     * @return bool
     */
    public static function hasConstant($constant)
    {
        $reflectionClass = self::getReflectionClass();
        return $reflectionClass->hasConstant($constant);
    }

    /**
     * 获取定义的常量
     *
     * @param $constant
     * @return mixed
     */
    public static function getConstant($constant)
    {
        $reflectionClass = self::getReflectionClass();
        return $reflectionClass->getConstant($constant);
    }

    /**
     * 获取定义的所有常量
     *
     * @author Strever <xingjian@juanpi.com>
     * @date 2016/5/5
     * @return mixed
     */
    public static function getConstants()
    {
        $reflectionClass = self::getReflectionClass();
        return $reflectionClass->getConstants();
    }

    /**
     * 获取常量名称
     *
     * @author Strever <xingjian@juanpi.com>
     * @date 2016/5/5
     * @param $constantValue
     * @return mixed
     */
    public static function getConstantName($constantValue)
    {
        $constants = self::getConstants();
        return array_search($constantValue, $constants);
    }

    /**
     * 获取code对应的描述
     *
     * @author Strever <xingjian@juanpi.com>
     * @date 2016/5/5
     * @param $constantValue
     * @return mixed|string
     */
    public static function getMessage($constantValue)
    {
        return ($msg = self::getConstantName($constantValue)) ? strtolower(str_replace(['ERR_', '_'], ['', ' '], $msg)) : 'unknown';
    }
}