<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function bankTrans(){
        return $this->hasMany(BankTransaaction::class,'bank_id','id')->where('type','OPENING BALANCE');
    }
}
