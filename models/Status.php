<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $message
 * @property integer $permissions
 * @property string $image_src_filename
 * @property string $image_web_filename
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by 
 * 
 * @property User $createdBy
 */
class Status extends \yii\db\ActiveRecord
{
      const PERMISSIONS_PRIVATE = 10;
      const PERMISSIONS_PUBLIC = 20;  
      public $image;
      
      public function behaviors()
          {
              return [
                  [
                      'class' => SluggableBehavior::className(),
                      'attribute' => 'message',
                      'immutable' => true,
                      'ensureUnique'=>true,
                  ],
                  [
                      'class' => BlameableBehavior::className(),
                      'createdByAttribute' => 'created_by',
                      'updatedByAttribute' => 'updated_by',
                  ],
                  'timestamp' => [
                      'class' => 'yii\behaviors\TimestampBehavior',
                      'attributes' => [
                          ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                          ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                      ],
                  ],
              ];
          }
            
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [        
            [['message'], 'required'],
            [['message'], 'string'],
            [['permissions', 'created_at', 'updated_at','created_by'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
             [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
          'id' => Yii::t('app', 'ID'),
          'message' => Yii::t('app', 'Message'),
          'permissions' => Yii::t('app', 'Permissions'),
          'image_src_filename' => Yii::t('app', 'Filename'),
          'image_web_filename' => Yii::t('app', 'Pathname'),          
          'created_by' => Yii::t('app', 'Created By'),
          'created_at' => Yii::t('app', 'Created At'),
          'updated_at' => Yii::t('app', 'Updated At'),        ];
    }
    
    public function getPermissions() {
          return array (self::PERMISSIONS_PRIVATE=>'Private',self::PERMISSIONS_PUBLIC=>'Public');
        }

        public function getPermissionsLabel($permissions) {
          if ($permissions==self::PERMISSIONS_PUBLIC) {
            return 'Public';
          } else {
            return 'Private';        
          }
        }
        
        public function afterSave($insert,$changedAttributes)
        {
            parent::afterSave($insert,$changedAttributes);
            // when insert false, then record has been updated
            if (!$insert) {
              // add StatusLog entry
              $status_log = new StatusLog;
              $status_log->status_id = $this->id;
              $status_log->updated_by = $this->updated_by;
              $status_log->created_at = time();
              $status_log->save();
            } 
        }
        
        
    /**
        * @return \yii\db\ActiveQuery
        */
       public function getCreatedBy()
       {
           return $this->hasOne(User::className(), ['id' => 'created_by']);
       }
}
