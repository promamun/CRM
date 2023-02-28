<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function cusTrans(){
        return $this->hasMany(Transaction::class,'ledger_id','id')->where('type','OPENING BALANCE');
    }
}
