<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class testCrud extends Eloquent
{
    protected $connection = 'mongodb';
    protected $table = 'testCrud';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','desc',
    ];
}


?>