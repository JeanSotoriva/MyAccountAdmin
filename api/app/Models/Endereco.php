<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;



class Endereco extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario_id',
        'cep',
        'rua',
        'numero',
        'cidade',
        'estado',
    ];

    protected $casts = [
        'cep' => 'integer',
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }   
}