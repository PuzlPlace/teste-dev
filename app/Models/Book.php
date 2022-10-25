<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Classes\DataBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * 
 * @property int $id
 * @property string $name
 * @property string $author
 * @property string $category
 * @property string $code
 * @property string $type
 * @property string $size
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Book extends Model
{
	use SoftDeletes;
	use DataBase;
	protected $table = 'books';

	public static $rules = [
		'name'       	=> 'required',
		'author'       	=> 'required',
		'category'      => 'required',
		'code'			=> 'required|unique:books,code,NULL,id,deleted_at,NULL',
		'type'       	=> 'required',
		'size'       	=> 'required',
	];

	protected $fillable = [
		'name',
		'author',
		'category',
		'code',
		'type',
		'size'
	];
}
