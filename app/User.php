<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\PasswordReset;

class User extends Authenticatable implements Auditable
{
    use Notifiable, HasRoles, HasApiTokens;
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     *
     */

    protected $table = 'users';
    protected $fillable = [
        'name', 
        'email', 
        'password',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }

    public function employee_discipline()
    {
        return $this->hasMany('App\EmployeeDisciplinary', 'created_by');
    }


    // SECTION: Auditing
    protected $auditExclude = ['remember_token'];

    protected $auditEvents = [
        'created',
        'updated' => 'customUpdatedEventAttributes',
        'deleted',
        'restored'
    ];

    //this is to prevent changes to remember_token field from creating an audit entry in the db.
    protected function customUpdatedEventAttributes()
    {
        $old = [];
        $new = [];

        foreach ($this->getDirty() as $attribute => $value) {
            if ($this->isAttributeAuditable($attribute)) {
                $old[$attribute] = array_get($this->original, $attribute);
                $new[$attribute] = array_get($this->attributes, $attribute);
            }
        }

        // Ignore if no changed values
        if(empty($old) && empty($new)) {
            return;
        }

        return [
            $old,
            $new,
        ];
    }

}
