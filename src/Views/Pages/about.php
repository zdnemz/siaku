<?php
use App\Core\View;

View::render('Components/navbar');
?>

<!-- About Start -->
<div class="container-fluid overflow-hidden py-5 mt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="RotateMoveLeft">
                    <img src="https://siaku-assets.vercel.app/assets/images/about.png" class="img-fluid w-75" alt="">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h4 class="mb-1 text-primary">Tentang Kami</h4>
                <h1 class="display-5 mb-4">PLN UPDL</h1>
                <p class="mb-4">Sebagai bagian dari PT PLN (Persero), PLN UPDL berkomitmen untuk mengembangkan sumber daya manusia
                    yang unggul dan siap menghadapi tantangan sektor ketenagalistrikan. Kami berfokus pada peningkatan
                    kompetensi dan pengetahuan untuk mengantisipasi perkembangan kebutuhan industri ketenagalistrikan.
                    PLN UPDL menjadi pusat pelatihan dan pengembangan SDM yang mempersiapkan generasi penerus dalam
                    menghadapi tantangan di masa depan melalui pengalaman pembelajaran yang luar biasa.
                </p>
                <a href="https://youtu.be/wibY7l1PynM" class="btn btn-primary rounded-pill py-3 px-5" id="lightbox" data-toggle="lightbox">Video Pedoman</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<script type="module">
    import * as Lightbox from "https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js";

    const options = {
        keyboard: true,
        size: 'fullscreen'
    };

    document.querySelectorAll('.my-lightbox-toggle').forEach(el => {
        const lightbox = new Lightbox(el, options); // Akses Lightbox melalui `default`
        el.addEventListener('click', (e) => {
            e.preventDefault();
            lightbox.show(); // Tampilkan lightbox saat elemen diklik
        });
    });
</script>

<?php
View::render('Components/footer');
?>