<?php
namespace cyneek\yii2\searchEngine;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;


/**
 * searchEngine module
 *
 * @author joseba <joseba.juaniz@gmail.com>
 */
class Module extends \yii\base\Module
{
    /**
     * @var string Alias for module
     */
    public static $name = "searchEngine";


    /**
     * Array that will store the models used in the package
     * e.g. :
     * [
     *     'FileModel' => 'cyneek\yii2\upload\models\FileModel'
     * ]
     *
     * The classes defined here will be merged with getDefaultModels()
     * having he manually defined by the user preference.
     *
     * @var array
     */
    public $modelMap = [];

    public $enableAjaxSearch = true;

    public $searchUrlString;

    /**
     * Array that will store the user defined assets for this package
     * e.g. :
     * [
     *      'js' => ['file1'],
     *      'css' => ['file2'],
     *      'sourcePath' => 'url',
     *      'depends' => ['file3', 'file4']
     * ]
     *
     * If defined, will be used INSTEAD OF THE DEFAULT ONES
     *
     * @var array
     */
    public $assetMap = [];


    public function init()
    {
        parent::init();

        $this->defineModelClasses();

        if ($this->enableAjaxSearch && is_null($this->searchUrlString))
        {
            throw new Exception('Must define a search url string with enableAjaxSearch activated');
        }

    }

    /**
     * Merges the default and user defined model classes
     * Also let's the developer to set new ones with the
     * parameter being those the ones with most preference.
     *
     * @param array $modelClasses
     */
    public function defineModelClasses($modelClasses = [])
    {
        $this->modelMap = ArrayHelper::merge(
            $this->getDefaultModels(),
            $this->modelMap,
            $modelClasses
        );
    }

    /**
     * Get default model classes
     */
    public function getDefaultModels()
    {
        return [
            'searchModel' => NULL,
        ];
    }

    /**
     * Get defined className of model
     *
     * Returns an string or array compatible
     * with the Yii::createObject method.
     *
     * @param string $name
     * @param array $config // You should never send an array with a key defined as "class" since this will
     *                      // overwrite the main className defined by the system.
     * @return string|array
     */
    public function model($name, $config = [])
    {
        $modelData = $this->modelMap[$name];

        if (!empty($config))
        {
            if (is_string($modelData))
            {
                $modelData = ['class' => $modelData];
            }

            $modelData = ArrayHelper::merge(
                $modelData,
                $config
            );
        }

        return $modelData;
    }

}