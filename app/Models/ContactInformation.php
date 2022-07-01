<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInformation extends Model
{
    use HasFactory;
    protected $table = 'contactinfo';
    protected $fillable = ['address','city','country','postalcode'];
    
    public function user(){
        $this->belongsTo(User::class);
    }
}
