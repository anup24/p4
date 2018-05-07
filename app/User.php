<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Define the one to many relationship with authors
    */
    public function texts()
    {
        # Define a one-to-many relationship.
        return $this->hasMany('App\Text');
    }
    /*
     * Return an array of authors where key = author id and value = authors name
     */
    public static function getForDropdown()
    {
        $users = self::orderBy('last_name')->get();
        $usersForDropdown = [];
        foreach ($users as $user) {
            $usersForDropdown[$user->id] = $user->getFullName($reverse = true);
        }
        return $usersForDropdown;
    }
    /*
     * Return authors full name
     */
    public function getFullName($reverse = false) {
        if($reverse) {
            return $this->last_name . ', ' . $this->first_name;
        } else {
            return $this->first_name.' '.$this->last_name;
        }
    }
}