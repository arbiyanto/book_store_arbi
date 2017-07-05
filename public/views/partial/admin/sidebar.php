<div class="ui left visible fixed sidebar inverted vertical menu">

  <div class="item">
    <a class="ui logo icon image">
      <img src="<?= fullurl(); ?>/public/img/logo_invert.png" width="50" />
    </a>
    <a class="ui inverted header" href="<?= fullurl(); ?>">
    ArBooks Admin
    </a>
  </div>

  <div class="item">
    <div class="header">Dasar</div>
    <div class="menu">
      <a href="<?= fullurl(); ?>/admin/dashboard" class="item">
      Beranda
      </a>
      <a href="<?= fullurl(); ?>" class="item">
      Lihat Website
      </a>
    </div>
  </div>

  <div class="item">
    <div class="header">Buku</div>
    <div class="menu">
      <a href="<?= fullurl(); ?>/admin/books" class="item">
      Pengaturan Buku
      </a>
      <a href="<?= fullurl(); ?>/admin/categories" class="item">
      Pengaturan Kategori
      </a>
      <a href="<?= fullurl(); ?>/admin/labels" class="item">
      Pengaturan Label
      </a>
    </div>
  </div>

  <div class="item">
    <div class="header">Transaksi</div>
    <div class="menu">
      <a href="<?= fullurl(); ?>/admin/payment" class="item">
      Permintaan Transaksi
      </a>
      <a href="<?= fullurl(); ?>/admin/payment/history" class="item">
      Riwayat Transaksi
      </a>
    </div>
  </div>

  <div class="item">
    <div class="header">Akun</div>
    <div class="menu">
      <a href="<?= fullurl(); ?>/logout" class="item">
      Keluar
      </a>
    </div>
  </div>

</div>