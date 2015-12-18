<?php
namespace cyneek\yii2\searchEngine\widgets;

use cyneek\yii2\searchEngine\models\AbstractSearch;
use cyneek\yii2\searchEngine\Module;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\data\DataProviderInterface;
use yii\helpers\Url;


/**
 */
class SearchBar extends Widget
{

    /** @var Model implements searchInterface */
    var $searchModel;

    /** @var DataProviderInterface */
    var $dataProvider;

    /** @var String */
    var $searchUrl;

    public function init()
    {
        $searchModelData = Yii::$app->getModule(Module::$name)->model('searchModel');

        $searchUrlString = Yii::$app->getModule(Module::$name)->searchUrlString;

        $this->searchModel = Yii::createObject($searchModelData);

        if (!$this->searchModel instanceof AbstractSearch)
        {
            throw new Exception("Search model must implement 'searchInterface'");
        }

        $this->searchUrl = ((is_null($searchUrlString)) ? NULL : Url::to([$searchUrlString]));

        $view = $this->getView();

        SearchAsset::register($view);
    }


    /**
     * Runs the widget.
     */
    public function run()
    {
        return $this->render('_search', ['searchModel' => $this->searchModel, 'searchUrl' => $this->searchUrl]);
    }


    /**
     * @return DataProviderInterface
     * @throws \Exception
     */
    public static function getSearchDataProvider()
    {
        try
        {
            /* @var $widget Widget */
            $config['class'] = get_called_class();
            $widget = Yii::createObject($config);

            if ($widget->searchModel->load(Yii::$app->request->get()) && $widget->searchModel->validate())
            {
                $widget->dataProvider = $widget->searchModel->makeDataProvider();
            }

            $out = $widget->dataProvider;

        } catch (\Exception $e)
        {
            throw $e;
        }

        return $out;
    }


}
