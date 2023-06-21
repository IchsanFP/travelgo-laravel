<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'location', 'about', 'featured_event', 
        'language', 'foods', 'departure_date', 'duration', 'type',
        'price', 'vendor_id'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}
