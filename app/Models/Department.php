<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

      /**
     * The table associated with the model.
     *
     * @var string
     */
      protected $table = 'department';

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
          'department',
          'description',
      ];
  
      // The attributes that should be hidden for arrays.
      protected $hidden = [
          // You can add hidden attributes here if needed.
      ];
  
      // The attributes that should be cast to native types.
      protected $casts = [
          // You can add casts for your attributes here if needed.
      ];
}
