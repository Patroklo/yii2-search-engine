<?php

namespace cyneek\yii2\searchEngine\controllers;

use cyneek\yii2\searchEngine\models\AbstractSearch;
use yii\db\ActiveQueryInterface;
use yii\web\Controller;

class SearchController extends Controller
{
    /**
     * Returns a list of categories
     *
     * @param null $q
     * @param null $typeId
     * @return array
     */
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => [['id' => '', 'text' => '']]];

        $searchModelData = \Yii::$app->getModule('searchEngine')->model('searchModel');

        /** @var AbstractSearch $searchModel */
        $searchModel = \Yii::createObject($searchModelData);

        if ($searchModel->load(\Yii::$app->request->get()) and $searchModel->validate())
        {
            /** @var ActiveQueryInterface $query */
            $query = $searchModel->searchQuery();

            $_results = $query->asArray()->all();


            $results = [];

            foreach ($_results as $r)
            {
                $results[] = ['id' => $r[$searchModel->textKey], 'text' => $r[$searchModel->textKey]];
            }

            $out['results'] = ((empty($results)) ? $out['results'] : $results);
        }

        return $out;

    }
}