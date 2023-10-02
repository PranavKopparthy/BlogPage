<?php 
// namespace App\Models;

// use CodeIgniter\Model;

// class BlogModel extends Model
// {
//     protected $table = 'blogs';
//     protected $primaryKey = 'id';
//     protected $allowedFields = ['title', 'content', 'created_at', 'image', 'tag_id'];

//     public function tag()
//     {
//         return $this->belongsTo('App\Models\TagModel', 'tag_id');
//     }
// }

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'created_at', 'image', 'tag_id'];

    public function tag()
    {
        return $this->belongsTo('App\Models\TagModel', 'tag_id');
    }

    public function findAllBanned()
    {
        return $this->where('ban', 1)->findAll();
    }

    public function paginateBlogs($perPage = 10)
    {
        return $this->paginate($perPage);
    }
}
