<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfficeSupply extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'office_supplies';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($food) {
            if(!User::find(Auth::id())->isAdmin())
            {
                $this->user_id = Auth::id();
            }
            $food->generateQrCodePicture();
        });

        static::updating(function ($food) {
            if(!User::find(Auth::id())->isAdmin())
            {
                $this->user_id = Auth::id();
            }
            $food->generateQrCodePicture();
        });
    }

    protected $casts = [
        'expiry_date' => 'datetime'
    ];

    public function generateQrCodePicture()
    {
        $qrFileName = $this->barcode.'.png';
        QrCode::size(200)
            ->format('png')
            ->generate($this->barcode, $picPath= storage_path('app/public/QR/'.$qrFileName));
        $this->qrcode_path = '/QR/'.$qrFileName;
        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
