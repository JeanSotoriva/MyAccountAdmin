<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;



class Movimentacao extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'movimentacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'num_conta',
        'data_movimetacao',
        'acao',
        'valor',
    ];

    protected $casts = [
        'num_conta' => 'integer',
    ];

    public function conta(){
        return $this->belongsTo(Conta::class);
    }
}
