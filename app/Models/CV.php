<?php
// app/Models/CV.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'user_id', 'modele', 'vorname', 'nachname', 'email',
        'telefon', 'adresse', 'stadt', 'beruf_titel', 'profil_text',
        'berufserfahrung', 'ausbildung', 'kenntnisse', 'sprachen',
        'hobbys', 'foto', 'ats_score',
    ];

    protected $casts = [
        'berufserfahrung' => 'array',
        'ausbildung'      => 'array',
        'kenntnisse'      => 'array',
        'sprachen'        => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Calcul automatique du ATS score
    public function calculateAtsScore(): int {
        $score = 0;
        if ($this->vorname && $this->nachname) $score += 10;
        if ($this->email)       $score += 10;
        if ($this->telefon)     $score += 5;
        if ($this->adresse)     $score += 5;
        if ($this->beruf_titel) $score += 10;
        if ($this->profil_text && strlen($this->profil_text) > 50) $score += 15;
        if (!empty($this->berufserfahrung)) $score += 20;
        if (!empty($this->ausbildung))      $score += 10;
        if (!empty($this->kenntnisse))      $score += 10;
        if (!empty($this->sprachen))        $score += 5;
        return min($score, 100);
    }
}