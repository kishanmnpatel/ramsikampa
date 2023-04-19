<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    //Relation to parent
    public const SELF = 0;
    public const FATHER = 1;
    public const HUSBUND = 2;
    public const WIFE = 3;

    protected $fillable = [
        'parent_id', 'name', 'surname_id', 'mobile', 'address', 'gender', 'relation', 'is_daughter', 'is_married', 'is_died',
    ];

    protected $with = ['child','surname'];

    public function surname()
    {
        return $this->belongsTo(Surname::class);
    }

    public function parent()
    {
        return $this->belongsTo(Person::class,'parent_id','id');
    }

    public function child()
    {
        return $this->hasMany(Person::class,'parent_id','id');
    }
}
