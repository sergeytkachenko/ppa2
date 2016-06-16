<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends \Phalcon\Mvc\Model
{
	use \PPA\Rest\Model\BaseModel, AutocapitalBaseModel;
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $ind_code;

    /**
     *
     * @var string
     */
    public $login;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $salt;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $last_name;

    /**
     *
     * @var string
     */
    public $second_name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $date_registration;

    /**
     *
     * @var string
     */
    public $birthday;

    /**
     *
     * @var string
     */
    public $phome;

    /**
     *
     * @var string
     */
    public $pmobile;

    /**
     *
     * @var string
     */
    public $address_home;

    /**
     *
     * @var string
     */
    public $photo_src;

    /**
     *
     * @var integer
     */
    public $is_in_third_system;

    /**
     *
     * @var string
     */
    public $third_system_id;

    /**
     *
     * @var integer
     */
    public $is_male;

    /**
     *
     * @var integer
     */
    public $is_active;

    /**
     *
     * @var integer
     */
    public $status_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
	    $this->hasMany('id', 'ActivitiesMethodists', 'user_id', array('alias' => 'ActivitiesMethodists'));
	    $this->hasMany('id', 'BrandsMethodists', 'user_id', array('alias' => 'BrandsMethodists'));
	    $this->hasMany('id', 'DealersControllers', 'user_id', array('alias' => 'DealersControllers'));
	    $this->hasMany('id', 'Trainings', 'trainer_id', array('alias' => 'Trainings'));
	    $this->hasMany('id', 'TrainingsMarks', 'user_id', array('alias' => 'TrainingsMarks'));
	    $this->hasMany('id', 'TrainingsUsers', 'user_id', array('alias' => 'TrainingsUsers'));
	    $this->hasMany('id', 'UserAuthorization', 'user_id', array('alias' => 'UserAuthorization'));
	    $this->hasMany('id', 'UsersCertifications', 'user_id', array('alias' => 'UsersCertifications'));
	    $this->hasMany('id', 'UsersEducations', 'user_id', array('alias' => 'UsersEducations'));
	    $this->hasMany('id', 'UsersGroups', 'user_id', array('alias' => 'UsersGroups'));
	    $this->hasMany('id', 'UsersPosts', 'user_id', array('alias' => 'UsersPosts'));
	    $this->hasMany('id', 'UsersWorkExperience', 'user_id', array('alias' => 'UsersWorkExperience'));
	    $this->belongsTo('status_id', 'UsersStatuses', 'id', array('alias' => 'UsersStatus'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

	public function beforeSave() {
		$security = $this->di->get('security');
		if ( $this->password && !$security->isLegacyHash($this->password) ) {
			$this->password = $security->hash($this->password.$this->salt);
		}
	}

}
