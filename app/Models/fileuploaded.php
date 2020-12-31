<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fileuploaded extends Model
{
    use HasFactory;

     /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'fileuploaded';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'path',
      '_token',
  ];
}
