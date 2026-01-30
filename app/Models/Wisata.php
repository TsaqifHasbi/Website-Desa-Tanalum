<?php

namespace App\Models;

/**
 * Alias model untuk backward compatibility
 */
class Wisata extends WisataDesa
{
    protected $table = 'wisata_desa';
}
