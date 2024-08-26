<?php
use App\Core\View;

?>



<!-- Hero Start -->
<div class="container-fluid header position-relative overflow-hidden p-0">
    <?php
    View::render('Components/navbar');
    ?>

    <!-- Hero Header Start -->
    <div class="hero-header overflow-hidden px-5">
        <div class="rotate-img">
            <img src="/assets/images/sty.png" class="img-fluid w-100" alt="" />
            <div class="rotate-sty-2"></div>
        </div>
        <div class="row gy-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">
                    Sistem Informasi Akademik UPDL
                </h1>
                <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">
                    Meningkatkan efektivitas manajemen sumber daya manusia melalui teknologi informasi.
                </p>
                </p>
                <a href="#" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">Mulai
                    Sekarang</a>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <img src="/assets/images/hero.png" class="img-fluid w-100 h-100" alt="" />
            </div>
        </div>
    </div>
    <!-- Hero Header End -->
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid overflow-hidden py-5" style="margin-top: 6rem">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="RotateMoveLeft">
                    <img src="/assets/images/about.png" class="img-fluid w-75" alt="" />
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h4 class="mb-1 text-primary">Tentang Kami</h4>
                <h1 class="display-5 mb-4">
                    PLN UPDL
                </h1>
                <p class="mb-4">
                    Sebagai bagian dari PT PLN (Persero), PLN UPDL berkomitmen untuk mengembangkan sumber daya manusia
                    yang unggul dan siap menghadapi tantangan sektor ketenagalistrikan. Kami berfokus pada peningkatan
                    kompetensi dan pengetahuan untuk mengantisipasi perkembangan kebutuhan industri ketenagalistrikan.
                    PLN UPDL menjadi pusat pelatihan dan pengembangan SDM yang mempersiapkan generasi penerus dalam
                    menghadapi tantangan di masa depan melalui pengalaman pembelajaran yang luar biasa.
                </p>
                <a href="https://youtu.be/wibY7l1PynM" class="btn btn-primary rounded-pill py-3 px-5" id="lightbox"
                    data-toggle="lightbox">Video Pedoman</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- FAQ Start -->
<div class="container-fluid FAQ bg-light overflow-hidden py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <h4 class="mb-1 text-primary">FAQ</h4>
                <h1 class="display-5 mb-4">
                    Pertanyaan yang sering ditanyakan
                </h1>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0 mb-4">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button rounded-top" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apa keunggulan layanan PLN UPDL?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body my-2">
                                <h5>PLN UPDL sebagai pusat pengetahuan ketenagalistrikan.</h5>
                                <p>
                                    Kami berkomitmen untuk menyediakan program-program unggulan yang mendukung
                                    pengembangan Sumber Daya Manusia, sejalan dengan tuntutan industri ketenagalistrikan
                                    yang dinamis. Layanan kami dirancang untuk memenuhi kebutuhan masa depan dengan
                                    pendekatan ilmiah yang terbaru dan pengalaman belajar yang fenomenal.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-4">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed rounded-top" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">Apakah ada biaya tambahan dalam layanan kami?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body my-2">
                                <h5>Transparansi dalam setiap layanan.</h5>
                                <p>
                                    Kami menjamin tidak ada biaya tersembunyi dalam layanan kami. Semua biaya yang
                                    terkait
                                    akan dijelaskan secara transparan pada awal kerja sama, sehingga Anda dapat fokus
                                    pada pengembangan tanpa khawatir tentang biaya tambahan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed rounded-top" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">Apa saja tantangan utama dalam bidang ketenagalistrikan?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body my-2">
                                <h5>Menjawab tantangan ketenagalistrikan masa depan.</h5>
                                <p>
                                    Industri ketenagalistrikan menghadapi berbagai tantangan seperti kebutuhan akan
                                    energi yang berkelanjutan, inovasi teknologi, dan peningkatan efisiensi. PLN UPDL
                                    berperan aktif dalam mengidentifikasi dan memberikan solusi untuk
                                    tantangan-tantangan
                                    ini melalui pendidikan dan pelatihan yang berorientasi pada masa depan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <div class="FAQ-img RotateMoveRight rounded">
                    <img src="/assets/images/blog.png" class="img-fluid w-100" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQ End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
View::render('/Components/footer');
?>

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