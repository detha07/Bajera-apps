<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeritaEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $judul;
    public $konten;

    public function __construct($judul, $konten)
    {
        $this->judul = $judul;
        $this->konten = $konten;
    }

    public function build()
{
    logger('judul: ' . $this->judul); // Akan tampil di storage/logs/laravel.log

    return $this->view('emails.berita')->with([
        'judul' => $this->judul,
        'konten' => $this->konten,
    ]);
}

}