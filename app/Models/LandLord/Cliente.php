<?php

namespace App\Models\LandLord;

use App\Models\LandLord\TenantLandlord;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id',
        'ruc',
        'razon_social',
        'email',
        'password',
        'plan',
        'perfil',
        'soap_envio',
        'soap_tipo',
        'soap_password',
        'certificado_pfx',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'smtp_encrypt',
        'estado',
        'fecha_pago',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['fecha_creacion', 'dias_faltantes','pago_fecha'];
    /**
     * Get the tenant that owns the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(TenantLandlord::class);
    }
    public function FechaCreacion(): Attribute
    {
        return new Attribute(
            get:fn() => $this->created_at ? date_format($this->created_at, 'd/m/Y') : null,
        );
    }
    public function PagoFecha(): Attribute
    {
        return new Attribute(
            get:fn() => $this->fecha_pago ? date_format(Carbon::parse($this->fecha_pago), 'd/m/Y') : null
        );
    }
    public function DiasFaltantes(): Attribute
    {
        $nowFecha = date_format(now(),'Y-m-d');
        $currentFecha = new Carbon($nowFecha);

        $pagoFechaParse = $this->fecha_pago;
       
        return new Attribute(
            get:fn()=>$currentFecha->diffInDays($this->fecha_pago)
        );
    }
}