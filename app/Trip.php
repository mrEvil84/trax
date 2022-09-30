<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'trips';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'date', 'miles', 'total', 'car_id', 'make', 'model', 'year'];

    public $incrementing = true;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'date' => Carbon::createFromTimeString($this->date)->format('m/d/Y'),
            'miles' => $this->miles,
            'total' => $this->total,
            'car' => [
                'id' => $this->car_id,
                'make' => $this->make,
                'model' => $this->model,
                'year' => $this->year,
            ]
        ];
    }
}
