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
    const Err_Invalid_Request = 400;

    // 表示用户没有权限（令牌、用户名、密码错误）。
    const Err_Unauthorized = 401;

    // 表示用户得到授权（与401错误相对），但是访问是被禁止的。
    const Err_Forbidden = 403;

    // 用户发出的请求针对的是不存在的记录，服务器没有进行操作，该操作是幂等的。
    const Err_Not_Found = 404;

    // 用户请求的格式不可得（比如用户请求JSON格式，但是只有XML格式）。
    const Err_Not_Acceptable = 406;

    // [GET]：用户请求的资源被永久删除，且不会再得到的。
    const Err_Gone = 410;

    // [POST/PUT/PATCH] 当创建一个对象时，发生一个验证错误。
    const Err_Unprocessable_Entity = 422;

    // 服务器发生错误，用户将无法判断发出的请求是否成功。
    const Err_Internal = 500;

    // 未知错误
    const Err_Unknown = 510;

    // 无效参数
    const Err_Invalid_Params = 420;

    // 请求鉴权token未通过
    const Err_Invalid_Token = 440;

    // 不是cli请求
    const Err_Not_Cli = 450;

    const 尼玛这是一个奇葩的错误_不要随便带标点符号 = 499;


    private static $_reflectionClass = null;

    /**
     * 获取自己的反射
     *
     * @author strever
     * @date 2016/5/5
     * @return object
     */
    public static function getReflectionClass()
    {
        if(!self::$_reflectionClass instanceof ReflectionClass)
        {
            self::$_reflectionClass = new ReflectionClass(__CLASS__);
        }

        return self::$_reflectionClass;
    }

    /**
     * 获取定义的常量
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
        return ($msg = self::getConstantName($constantValue)) ? $msg : 'Err_Unknown';
    }
}