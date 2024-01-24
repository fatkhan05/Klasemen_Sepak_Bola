<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKlasemen extends Model
{
    use HasFactory;

    protected $table = 'data_klasemen';
    protected $primariKey = 'id_klasemen';
    protected $guarded = ['id_klasemen'];

    public function data_club() 
    {
        return $this->belongsTo(DataClub::class, 'club_id', 'id_club');
    }

    public function calculatePoints()
    {
        $clubs = DataClub::get();
        $points = [];

        foreach ($clubs as $club) {
            // $matches = Match::where('club1', $club->name)->orWhere('club2', $club->name)->get();
            $matches = DataKlasemen::where('nama_club', $club->nama_club)->get();
            $totalPoints = 0;
            $totalGoalsFor = 0;
            $totalGoalsAgainst = 0;

            foreach ($matches as $match) {
                if ($match->club1 == $club->name) {
                    $totalGoalsFor += $match->score1;
                    $totalGoalsAgainst += $match->score2;

                    if ($match->score1 > $match->score2) {
                        $totalPoints += 3; // Menang
                    } elseif ($match->score1 == $match->score2) {
                        $totalPoints += 1; // Seri
                    }
                } else {
                    $totalGoalsFor += $match->score2;
                    $totalGoalsAgainst += $match->score1;

                    if ($match->score2 > $match->score1) {
                        $totalPoints += 3; // Menang
                    } elseif ($match->score2 == $match->score1) {
                        $totalPoints += 1; // Seri
                    }
                }
            }

            $points[] = [
                'club' => $club->name,
                'matches' => $matches->count(),
                'wins' => $totalPoints / 3, // Menang = Poin / 3
                'draws' => $totalPoints % 3, // Sisa poin setelah menang dibagi 3
                'losses' => $matches->count() - ($totalPoints / 3) - ($totalPoints % 3),
                'goalsFor' => $totalGoalsFor,
                'goalsAgainst' => $totalGoalsAgainst,
                'points' => $totalPoints,
            ];
        }

        // Sorting klasemen berdasarkan poin (descending)
        usort($points, function ($a, $b) {
            return $b['points'] - $a['points'];
        });

        return $points;
    }
}
