<div class="main">
    <div class="mask"></div>
    <img src="<?= fullurl(); ?>/public/img/geek_mascot.png" class="ui tiny image" />
    <div id="textHeader" class="ui large header">ArBuku
        <div class="ui sub header">Toko Buku Online Terpercaya & Terbesar</div>
    </div>
</div>
<div class="ui grid container uk-margin-top">
    <div class="row">
        <div class="eleven wide column">
            <div class="uk-slidenav-position" data-uk-slideshow="{height:'400',autoplay:true}">
                <ul class="uk-slideshow">
                    <li><img src="<?= fullurl(); ?>/public/img/1197.jpg"  alt="" /></li>
                    <li><img src="<?= fullurl(); ?>/public/img/1196.jpg"  alt="" /></li>
                    <li><img src="<?= fullurl(); ?>/public/img/bukareksa.jpg" alt="" /></li>
                    <li><img src="<?= fullurl(); ?>/public/img/1195.jpg" alt="" /></li>
                    <li><img src="<?= fullurl(); ?>/public/img/1207.jpg" alt="" /></li>
                </ul>
                <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <ul class="uk-dotnav uk-position-bottom uk-flex-center">
                    <li data-uk-slideshow-item="0"><a href=""></a></li>
                    <li data-uk-slideshow-item="1"><a href=""></a></li>
                    <li data-uk-slideshow-item="2"><a href=""></a></li>
                    <li data-uk-slideshow-item="3"><a href=""></a></li>
                    <li data-uk-slideshow-item="4"><a href=""></a></li>
                </ul>
            </div>
        </div>

        <div class="five wide column">
            <div class="ui padded red stacked segment">
                <div class="ui header">Asal Pengiriman Barang Yang Tersedia</div>
                <div class="ui two column grid">
                    <div class="ui column list">
                        <div class="item"><i class="marker icon"></i> Jakarta</div>
                        <div class="item"><i class="marker icon"></i> Bogor</div>
                        <div class="item"><i class="marker icon"></i> Depok</div>
                        <div class="item"><i class="marker icon"></i> Tangerang</div>
                    </div>
                    <div class="ui column list">
                        <div class="item"><i class="marker icon"></i> Bekasi</div>
                        <div class="item"><i class="marker icon"></i> Bandung</div>
                     <div class="item"><i class="marker icon"></i> Yogyakarta</div>
                    </div>
                </div>
                <div class="ui divider"></div>
                <div class="ui header">Kontak</div>
                <div class="ui list">
                    <div class="item"><i class="user icon"></i> 55780074 (Kantor)</div>
                    <div class="item"><i class="user icon"></i> 081280827770 (Arbiyanto Wijaya)</div>
                    <div class="item"><i class="at icon"></i> arbuku@arbuku.id</div>
                    <div class="item"><i class="at icon"></i> arbiyantowijaya17@gmail.com</div>
                </div>
                <div class="divider"></div>
                <button class="ui blue button">Buka Bantuan</button>
                <button class="ui red button">Lapor</button>
            </div>
        </div>
    </div>
    <div class="ui uk-margin-left inverted red header uk-margin-top uk-margin-small-bottom">BEST SELLER </div>
    <div class="doubling six column row">
        <div class="column web-card" ng-repeat="b in bestSeller">
            <a href="<?= fullurl(); ?>/books/detail/{{ b.id }}" class="mask"></a>
            <a >
                <div class="ui image">
                    <button ng-click="cart(b)" class="ui icon button my-red cart-button">
                        <i class="add to cart icon"></i>
                    </button>
                    <a class="ui ribbon label">Rp.{{ b.price }}</a>
                    <img ng-src="<?= fullurl(); ?>/public/img/upload/{{ b.picture }}" alt="">
                </div>
                <div class="ui tiny header">{{ b.title }}
                    <div class="sub header uk-margin-small-top">{{ b.author }}</div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <a href="<?= fullurl(); ?>/books?label=bestseller" class="ui my-red button uk-float-right uk-margin-bottom">
            Buku Best Seller Lainnya</a>
            <div class="ui clearing divider"></div>
        </div>
    </div>
    <div class="ui uk-margin-left inverted red header uk-margin-small-top uk-margin-small-bottom">Populer: Buku Terbaru </div>
    <div class="doubling six column row">
        <div class="column web-card" ng-repeat="n in newBooks">
            <a href="<?= fullurl(); ?>/books/detail/{{ n.id }}" class="mask"></a>
            <a >
                <div class="ui image">
                    <button ng-click="cart(n)" class="ui icon button my-red cart-button">
                        <i class="add to cart icon"></i>
                    </button>
                    <a class="ui ribbon label">Rp.{{ n.price }}</a>
                    <img ng-src="<?= fullurl(); ?>/public/img/upload/{{ n.picture }}" alt="">
                </div>
                <div class="ui tiny header">{{ n.title }}
                    <div class="sub header uk-margin-small-top">{{ n.author }}</div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <a href="<?= fullurl(); ?>/books" class="ui my-red button uk-float-right uk-margin-bottom">
            Lihat Buku Terbaru Lainnya</a>
            <div class="ui clearing divider"></div>
        </div>
    </div>
</div>