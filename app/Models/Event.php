<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes , InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'date',
        'hour',
        'lieu',
        'total_tickets',
        'available_tickets',
        'category_id',
        'created_by',
        'duration_of_event',
        'type',
        'verified',
        'status_event',
        'ticket_price',
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media_events')
            ->useDisk('media_events')
            ->singleFile(); 
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
