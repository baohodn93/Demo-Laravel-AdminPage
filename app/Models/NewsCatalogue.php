<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCatalogue extends Model
{
    //
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_catalogues';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
