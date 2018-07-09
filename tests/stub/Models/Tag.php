<?php

namespace CodePress\CodeDatabase\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Tag
 *
 * @author gabriel
 */
class Tag extends Model
{

    protected $table = "codepress_tags";
    protected $fillable = [
        'name'
    ];

}
