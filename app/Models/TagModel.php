<?php namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function blogs()
    {
        return $this->hasMany('App\Models\BlogModel', 'tag_id');
    }
}
