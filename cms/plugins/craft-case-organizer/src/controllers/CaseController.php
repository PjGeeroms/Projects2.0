<?php
/**
 * CaseOrganizerController.php
 */

namespace bitsandbytes\caseOrganizer\controllers;

use Craft;
use craft\elements\Entry;
use craft\errors\ElementNotFoundException;
use craft\fields\Entries;
use craft\helpers\Json;
use craft\web\Controller;
use yii\base\Exception;

/**
 * CaseOrganizerController
 *
 * @copyright   2020 Bits&Bytes
 * @since       2020-07-31 21:17
 * @author      pieterjangeeroms
 */
class CaseController extends Controller
{

    public function actionUpdateOrder() {
        $request = Craft::$app->getRequest();
        $id = $request->getRequiredBodyParam('caseId');
        $caseOrder = $request->getRequiredBodyParam('value');
        $case = Entry::find()->uid($id)->one();
        $case->setFieldValue('caseOrder', $caseOrder);

        $error = '';
        try {
            Craft::$app->getElements()->saveElement($case);
        } catch (ElementNotFoundException $e) {
            $error = "That case was not found";
        } catch (Exception $e) {
            $error = "Whoops, something went wrong: " . $e;
        } catch (\Throwable $e) {
            $error = "Whoops, something went wrong: " . $e;
        }

        if (!empty($error)) {
            return $this->asJson($error);
        }

        $response = [
          "uid" => $case->uid,
          "title"  => $case->title,
          "order" => $case->getFieldValue('caseOrder')
        ];

        return $this->asJson($response);
    }

    public function actionUnfeature() {
        $request = Craft::$app->getRequest();
        $uid = $request->getRequiredBodyParam("uid");
        $case = Entry::find()->uid($uid)->one();
        $case->setFieldValue("featured", 0);

        $error = '';
        try {
            Craft::$app->getElements()->saveElement($case);
        } catch (ElementNotFoundException $e) {
            $error = "That case was not found";
        } catch (Exception $e) {
            $error = "Whoops, something went wrong: " . $e;
        } catch (\Throwable $e) {
            $error = "Whoops, something went wrong: " . $e;
        }

        if (!empty($error)) {
            return $this->asJson($error);
        }

        $response = [
            "uid" => $case->uid,
            "title"  => $case->title,
            "featured" => $case->getFieldValue('featured')
        ];

        return $this->asJson($response);

    }

}