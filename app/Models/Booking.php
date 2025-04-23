<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan model Room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Memeriksa apakah booking masih pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Memeriksa apakah booking telah disetujui.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Memeriksa apakah booking ditolak.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Mengambil judul event untuk ditampilkan di kalender.
     */
    public function getEventTitle()
    {
        return $this->room->name . ' - ' . $this->purpose; // Nama ruangan dan tujuan
    }

    /**
     * Memeriksa apakah ruangan tersedia pada waktu yang diberikan.
     */
    public function isRoomAvailable($start_time, $end_time)
    {
        return !$this->where('room_id', $this->room_id)
                     ->where(function ($query) use ($start_time, $end_time) {
                         $query->whereBetween('start_time', [$start_time, $end_time])
                               ->orWhereBetween('end_time', [$start_time, $end_time])
                               ->orWhere(function ($query) use ($start_time, $end_time) {
                                   $query->where('start_time', '<', $end_time)
                                         ->where('end_time', '>', $start_time);
                               });
                     })
                     ->exists();
    }

    /**
     * Mendapatkan waktu yang tersisa sampai booking dimulai.
     */
    public function timeRemaining()
    {
        return $this->start_time->diffForHumans();
    }

    /**
     * Mendapatkan status booking dalam format yang lebih mudah dibaca.
     */
    public function getStatusLabel()
    {
        switch ($this->status) {
            case 'pending':
                return 'Menunggu Persetujuan';
            case 'approved':
                return 'Disetujui';
            case 'rejected':
                return 'Ditolak';
            default:
                return 'Status Tidak Diketahui';
        }
    }

    /**
     * Mendapatkan waktu dalam format string yang lebih mudah dibaca.
     */
    public function getFormattedStartTime()
    {
        return $this->start_time->format('l, d M Y H:i'); // Format: Hari, Tanggal Bulan Tahun Jam:Menit
    }

    /**
     * Mendapatkan waktu berakhir dalam format string yang lebih mudah dibaca.
     */
    public function getFormattedEndTime()
    {
        return $this->end_time->format('l, d M Y H:i');
    }

    /**
     * Memperbarui status booking.
     */
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * Menambahkan catatan admin pada booking.
     */
    public function addAdminNotes($notes)
    {
        $this->admin_notes = $notes;
        $this->save();
    }

    /**
     * Memeriksa apakah booking sedang berlangsung.
     */
    public function isOngoing()
    {
        $now = now();
        return $now->between($this->start_time, $this->end_time);
    }

    /**
     * Memeriksa apakah booking sudah lewat.
     */
    public function isPast()
    {
        return $this->end_time->isBefore(now());
    }
}