<?php

namespace admin\controllers;

use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\Apartment;
use common\models\ApartmentSearch;
use common\models\Room;
use Exception;
use kartik\grid\EditableColumnAction;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ApartmentController implements the CRUD actions for Apartment model.
 *
 * @package admin\controllers
 */
final class ApartmentController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => ['delete' => ['POST']]
            ]
        ]);
    }

    /**
     * Lists all Apartment models.
     *
     * @throws InvalidConfigException
     */
    public function actionIndex(): string
    {
        $model = new Apartment();

        if (RbacHtml::isAvailable(['create']) && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Элемент №$model->id создан успешно");
        }

        $searchModel = new ApartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'model' => $model]
        );
    }

    /**
     * Displays a single Apartment model.
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Apartment model.
     *
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param string|null $redirect если нужен иной редирект после успешного создания
     *
     * @throws InvalidConfigException
     */
    public function actionCreate(string $redirect = null): Response|string
    {
        $modelApartment = new Apartment();
        $modelsRooms = [new Room()];
        if ($modelApartment->load(Yii::$app->request->post())) {

            $modelsRooms = Room::createMultiple();
            Room::loadMultiple($modelsRooms, Yii::$app->request->post());


            // validate all models
            $valid = $modelApartment->validate();
            $valid = Room::validateMultiple($modelsRooms) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelApartment->save(false)) {
                        foreach ($modelsRooms as $modelsRoom) {
                            $modelsRoom->id_apartment = $modelApartment->id;
                            if (!($flag = $modelsRoom->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelApartment->id]);
//                        Yii::$app->session->setFlash('success', "Элемент №$modelApartment->id создан успешно");
//                        return match ($redirect) {
//                            'create' => $this->redirect(['create']),
//                            'index' => $this->redirect(UserUrl::setFilters(ApartmentSearch::class)),
//                            default => $this->redirect(['view', 'id' => $modelApartment->id])
//                        };
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelApartment' => $modelApartment,
            'modelsRooms' => (empty($modelsRooms)) ? [new Room()] : $modelsRooms
        ]);
    }

    /**
     * Updates an existing Apartment model.
     *
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @throws InvalidConfigException
     */
    public function actionUpdate(int $id): Response|string
    {
        $modelApartment = $this->findModel($id);
        $modelsRooms = $modelApartment->rooms;
//            $modelApartment->addresses;

        // primary key of $modelsAddress
        $pkey = 'id';

        if ($modelApartment->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsRooms, $pkey, $pkey);
            $modelsRooms = Room::createMultiple($modelsRooms);
            Room::loadMultiple($modelsRooms, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRooms, $pkey, $pkey)));


            // validate all models
            $valid = $modelApartment->validate();
            $valid = Room::validateMultiple($modelsRooms) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelApartment->save(false)) {
                        if (!empty($deletedIDs)) {
                            Room::deleteAll([$pkey => $deletedIDs]);
                        }
                        foreach ($modelsRooms as $modelsRoom) {
                            $modelsRoom->id_apartment = $modelApartment->id;
                            if (!($flag = $modelsRoom->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelApartment->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelApartment' => $modelApartment,
            'modelsRooms' => (empty($modelsRooms)) ? [new Room()] : $modelsRooms
        ]);
    }

    /**
     * Deletes an existing Apartment model.
     *
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Элемент №$id удален успешно");
        return $this->redirect(UserUrl::setFilters(ApartmentSearch::class));
    }

    /**
     * Finds the Apartment model based on its primary key value.
     *
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel(int $id): Apartment
    {
        if (($model = Apartment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'change' => [
                'class' => EditableColumnAction::class,
                'modelClass' => Apartment::class
            ]
        ];
    }
}
