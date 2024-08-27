<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php
    View::render('Components/navbar');

    ?>

    <div class="hero-header overflow-hidden px-5">

        <main class="">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <ul class="nav nav-pills flex-column">
                    <li>
                        <a href="/admin/dashboard" class="nav-link link-dark">
                            Dashboard
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a href="/admin/kelas" class="nav-link link-dark">
                            Kelas
                        </a>
                    </li>
                    <li>
                        <a href="/admin/pengajar" class="nav-link link-dark">
                            Pengajar
                        </a>
                    </li>
                    <li>
                        <a href="/admin/peserta" class="nav-link link-dark">
                            Peserta
                        </a>
                    </li>
                    <li>
                        <a href="/admin/divisi" class="nav-link link-dark">
                            Divisi
                        </a>
                    </li>
                    <hr>
                    <li>
                        <a href="/admin/absensi" class="nav-link link-dark">
                            Absensi
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </div>
</div>