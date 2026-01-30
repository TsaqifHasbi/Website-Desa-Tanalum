<?php

namespace App\Models;

/**
 * Alias model untuk backward compatibility
 */
class Aparatur extends AparaturDesa
{
    protected $table = 'aparatur_desa';
}
