<?php
/**
 * @copyright 2017 Champion Computer Consulting Inc. - All Rights Reserved.
 */

namespace app\models;

class TemplateList extends BaseModel
{
    public static $dataLib = 'CodiacSDK.CommonArea.dll';
    public static $dataAction = 'GetTemplateList';

    //Override method for prepare returned from API server values
    public static function getData($fieldList = [], $postData = [], $additionallyParam = [])
    {
        $additionallyParam = ['field_out_list' => ['alias_field', 'field_type']];
        return parent::getData($fieldList, $postData, $additionallyParam);
    }
}