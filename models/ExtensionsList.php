<?php
/**
 * @copyright 2017 Champion Computer Consulting Inc. - All Rights Reserved.
 */

namespace app\models;

use Yii;

class ExtensionsList extends AccountModel
{
    public static $dataLib = 'CodiacSDK.CommonArea.dll';
    public static $dataAction = 'GetExtCallStack';

    //Change controller of API server
    protected static function getSourceLink()
    {
        if (!empty(Yii::$app->session['apiEndpointCustom'])) {
            return Yii::$app->session['apiEndpointCustom'];
        }
        return (YII_ENV == 'dev') ? Yii::$app->params['apiEndpointCustomDev'] : Yii::$app->params['apiEndpointCustom'];
    }

    /**
     * @param null|string $libName
     * @param array $functionName
     *
     * @return null|static
     */
    public static function getList($libName, $functionName)
    {
        $postData = [
            "func_name" => self::$dataAction,
            "func_param" => [
                "datasource_func" => $functionName,
                "datasource_lib" => $libName
            ],
            "lib_name" => self::$dataLib
        ];

        $result = (new static())->processData($postData);
        return (!empty($result['record_list'])) ? $result['record_list'] : null;
    }
}