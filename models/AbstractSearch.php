<?php

namespace cyneek\yii2\searchEngine\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQueryInterface;

abstract class AbstractSearch extends Model
{

    /**
     * Basic search query text
     * @var String
     */
    public $searchQuery;

    /** @var string */
    public $primaryKey = 'id';

    /** @var string */
    public $textKey = 'name';


    public function rules()
    {
        return [['searchQuery', 'safe']];
    }

    /**
     * Search in the database with the loaded model data.
     *
     * Returns an object implementing QueryInterface
     *
     * Will be used in DataSources and Search in the SearchController
     *
     *
     * @return ActiveQueryInterface
     */
    public abstract function searchQuery();


    /**
     * Creates a DataProvider from the search query and returns it
     * Can be overloaded to insert additional properties into the DataProvider
     *
     * @return ActiveDataProvider
     */
    public function makeDataProvider()
    {
        $query = $this->searchQuery();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}