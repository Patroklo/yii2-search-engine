<?php
namespace cyneek\yii2\searchEngine\widgets;

use app\models\Article;
use Yii;
use yii\base\Widget;

/**
 */
class SearchListView extends Widget
{
    /**
     * Dataprovider for the ListView
     */
    public $dataProvider;


    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        $view = $this->getView();

        SearchAsset::register($view);

    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        if ($this->dataProvider !== NULL)
        {
            return $this->render('_listView', ['dataProvider' => $this->dataProvider]);
        }
        return NULL;
    }

}