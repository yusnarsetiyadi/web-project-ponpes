<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('formatTanggal')) {
    function formatTanggal($datetime)
    {
        return \App\Helpers\AlzaHelpers::formatTanggal($datetime);
    }
}
