<?php

namespace FrameworkSimas\Config;

class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        $html = '';
        if (isset($_SESSION['flash'])) {
            $html = '
        <div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show position-fixed z-3" style="bottom: 1rem; right: 2rem;" role="alert">
            <strong>' . $_SESSION['flash']['pesan'] . '</strong>' . ' ' . $_SESSION['flash']['aksi'] . '
            <button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
            unset($_SESSION['flash']);
        }
        return $html;
    }
}
