<?php

namespace app\models\Form;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\TworkFile;
use Yii;

class TworkUploadForm extends Model
{
     /**
     * @var UploadedFile[]
     */
    public $mutiFiles;

    public function rules()
    {
        return [
            [['mutiFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 0],
        ];
    }
    
    public function attributeLabels() {
        return [
          'mutiFiles' => '请选择要上传的文件',
        ];
    }
    /**
     * 上传文件到服务器并且在对应数据表中创建文件索引
     * tworkid为对应作业号,上传成功返回true
     * @param integer $tworkid
     * @return boolean 
     */
    public function upload($tworkid)
    {
        if ($this->validate()) { 
            foreach ($this->mutiFiles as $file) {
                $randomKey = Yii::$app->getSecurity()->generateRandomString(32);
                $file->saveAs(Yii::getAlias('@webroot').'/uploads/' . $randomKey . '.' . $file->extension);
                $courseFile = new TworkFile();
                $courseFile->twork_id = $tworkid;
                $courseFile->file_name = $file->baseName;
                $courseFile->file_extension = $file->extension;
                $courseFile->file_hash = $randomKey;
                $courseFile->file_upload_time = time();
                $courseFile->save();
            }
            return true;
        } else {
            return false;
        }
    }

}

