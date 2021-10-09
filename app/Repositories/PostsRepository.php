<?php

namespace App\Repositories;

use App\Models\Posts;
use App\Repositories\BaseRepository;

/**
 * Class PostsRepository
 * @package App\Repositories
 * @version October 9, 2021, 7:56 am UTC
*/

class PostsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Posts::class;
    }
}
