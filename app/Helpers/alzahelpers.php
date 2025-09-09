<?php
namespace App\Helpers;
use App\Models\Identitas;
use Carbon\Carbon;
class AlzaHelpers
{
    public static function title(){
        $iden = Identitas::select('nama_web')->where('id',1)->first();
        return $iden->nama_web;
    }

   
    public static function formatRupiah($angka) {
            return 'Rp ' . number_format($angka, 0, ',', '.');
        }

    public static function meta_desc(){
        $iden = Identitas::select('meta_desc_web')->where('id',1)->first();
        return $iden->meta_desc_web;
    }

    public static function meta_key(){
        $iden = Identitas::select('meta_key_web')->where('id',1)->first();
        return $iden->meta_key_web;
    }

    public static function logo()
    {
        $iden = Identitas::select('logo_web')->where('id',1)->first();
        return url('/storage/logo/'.$iden->logo_web);
    }
    
    public static function maps()
    {
        $iden = Identitas::select('maps_web')->where('id',1)->first();
        return $iden->maps_web;
    }

    public static function about()
    {
        $iden = Identitas::select('about')->where('id',1)->first();
        return $iden->about;
    }

    public static function alamat()
    {
        $iden = Identitas::select('alamat_web')->where('id',1)->first();
        return $iden->alamat_web;
    }

    public static function kontak()
    {
        $iden = Identitas::select('kontak_web')->where('id',1)->first();
        return $iden->kontak_web;
    }

    public static function ig()
    {
        $iden = Identitas::select('ig_web')->where('id',1)->first();
        return $iden->ig_web;
    }

    public static function fb()
    {
        $iden = Identitas::select('fb_web')->where('id',1)->first();
        return $iden->fb_web;
    }

    public static function yt()
    {
        $iden = Identitas::select('yt_web')->where('id',1)->first();
        return $iden->yt_web;
    }


    public static function greeting() {
        //mengatur zona waktu
        date_default_timezone_set("Asia/Jakarta");
        //variables
        $welcome_string="Welcome!";
        $numeric_date=date("G");
        //kondisioal untuk menampilkan ucapan menurut waktu/jam
        if($numeric_date>=0&&$numeric_date<=11)
        $welcome_string="Selamat pagi!";
        else if($numeric_date>=12&&$numeric_date<=14)
        $welcome_string="Selamat siang!";
        else if($numeric_date>=15&&$numeric_date<=17)
        $welcome_string="Selamat sore!";
        else if($numeric_date>=18&&$numeric_date<=23)
        $welcome_string="Selamat malam!";
        echo "$welcome_string";
    }

    public static function active_template_path($path = '')
    {
        $activeTemplate = config('template.active_template');
        return resource_path('templates/' . $activeTemplate . '/' . $path);
    }

    public static function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }

    public static function cetak_meta($str,$mulai,$selesai){

        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
    }

    public static function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    public static function buildMenu($array)
    {

        foreach ($array as $item)
        {
            echo '<li class="nav-item" id="'.$item['id'].'"><a '.(!empty($item['child']) ? "class=\"nav-link with-sub\"" : "class=\"nav-link\"").' href="'.(!empty($item['child']) ? "#" : '/'.config('pathadmin.admin_name').$item['link']).'">';
            echo (!empty($item['child']) ? "<i class=\"".$item['class']."\"></i>" : "").(!empty($item['child']) ? "<span class=\"ml-1\">".$item['label']."</span>" : ($item['depth']==0 ? "<i class=\"".$item['class']."\" ></i>&nbsp;".$item['label'] : $item['label'])).'</a>';
            if (!empty($item['child'])){
                echo '<ul class="nav-sub">';
                    (new AlzaHelpers)->buildMenu($item['child']);
                echo '</ul>';
            }
            echo '</li>';
        }

    }

    public static function buildFrontMenu($array, $cls = '')
    {
        foreach ($array as $item) {
            // Periksa apakah menu memiliki submenu
            $hasChild = !empty($item['child']);

            // Tambahkan elemen <li> dengan class dan atribut yang sesuai
            echo '<li class="' . ($hasChild ? 'uk-parent' : '') . '" id="' . $item['id'] . '">';
            echo '<a href="' . ($hasChild ? '#' : $item['link']) . '" ' .
                ($cls == '' ? '' : ' class="' . $cls . '"') .
                '>';
            echo (!empty($item['class']) ? '<i class="' . $item['class'] . '"></i> ' : '') . $item['label'];

            if ($hasChild) {
                echo ' <span uk-icon="icon: chevron-down"></span>';
            }

            echo '</a>';

            // Jika memiliki submenu, tambahkan elemen <div> untuk dropdown
            if ($hasChild) {
                echo '<div class="uk-navbar-dropdown">';
                echo '<ul class="uk-nav uk-navbar-dropdown-nav">';
                self::buildFrontMenu($item['child']); // Rekursif untuk submenu
                echo '</ul>';
                echo '</div>';
            }

            echo '</li>';
        }
    }

    public static function buildFrontMenux($array, $cls = '', $isOffCanvas = false)
    {
        foreach ($array as $item) {
            // Periksa apakah menu memiliki submenu
            $hasChild = !empty($item['child']);

            // Tambahkan elemen <li> dengan class dan atribut yang sesuai
            echo '<li class="' . ($hasChild ? 'uk-parent' : '') . '" id="' . $item['id'] . '">';
            echo '<a href="' . ($hasChild ? '#' : $item['link']) . '" ' .
                ($cls == '' ? '' : ' class="' . $cls . '"') .
                '>';
            // Tampilkan label dan ikon jika ada
            echo (!empty($item['class']) ? '<i class="' . $item['class'] . '"></i> ' : '') . $item['label'];

            // Tambahkan ikon panah jika memiliki submenu
            if ($hasChild) {
                echo ' <span uk-icon="icon: chevron-down"></span>';
            }

            echo '</a>';

            // Jika memiliki submenu
            if ($hasChild) {
                // Gunakan struktur off-canvas
                echo '<ul class="uk-nav-sub">';
                self::buildFrontMenu($item['child'], $cls, $isOffCanvas);
                echo '</ul>';
            }

            echo '</li>';
        }

    }


    public static function totalGuru()
    {
        return \App\Models\Guru::count();
    }

    public static function totalTahfiz()
    {
        return \App\Models\Santri::where('jurusan_id',1)->count();
    }

    public static function totalKitab()
    {
        return \App\Models\Santri::where('jurusan_id',2)->count();
    }

    public static function totalAlumni()
    {
        return 1;
    }

    public static function formatTanggal($datetime) {
        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Ubah datetime ke objek Carbon
        $date = Carbon::parse($datetime);

        // Format tanggal
        return $date->translatedFormat('F, d Y | H:i');
    }

}
