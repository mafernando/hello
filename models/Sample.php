<?php

namespace app\models;

use Yii;
use yii\models\User;

/**
 * This is the model class for table "sample".
 *
 * @property integer $id
 * @property string $thought
 * @property integer $goodness
 * @property integer $rank
 * @property string $censorship
 * @property string $occurred
 */
class Sample extends \yii\db\ActiveRecord
{
    public $captcha;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['thought'], 'string', 'max' => 255],
          ['thought', 'match', 'pattern' => '/^[a-z][A-Za-z,;\"\\s]+[!?.]$/i','message'=>Yii::t('app','Your thoughts should form a complete sentence of alphabetic characters.')],
          [['email'], 'email'],
          [['email'], 'exist','targetClass'=>'\app\models\User','message'=>Yii::t('app','Sorry, that person hasn\'t registered yet')],
          [['url'], 'url'],
          ['censorship', 'in', 'range' => ['yes','no','Yes','No'],'message'=>Yii::t('app','The censors demand a yes or no answer.')],
          [['thought'], 'trim'],
          [['thought'], 'required'],
          [['captcha'], 'captcha'],
          [['rank'], 'integer'],
          ['rank', 'compare', 'compareValue' => 0, 'operator' => '>','message'=>Yii::t('app','Rank must be between 0 and 100 inclusive.')],
          ['rank', 'compare', 'compareValue' => 100, 'operator' => '<=','message'=>Yii::t('app','Rank must be between 0 and 100 inclusive.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sample';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thought' => 'Thought',
            'goodness' => 'Goodness',
            'rank' => 'Rank',
            'censorship' => 'Censorship',
            'occurred' => 'Occurred',
        ];
    }
}
