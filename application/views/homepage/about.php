<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
    <p class="m-text13 t-center">
        Doa Ibu Coffee
    </p>
</section>
<!-- content page -->
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-b-30">
                <div class="hov-img-zoom">
                    <img src="<?= base_url('assets/img/'); ?>configuration/<?= $about['image']; ?>" alt="IMG-ABOUT">
                </div>
            </div>
            <div class="col-md-8 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    <?= $about['title']; ?>
                </h3>
                <p class="p-b-28">
                    <?= $about['description']; ?>
                </p>
                <div class="bo13 p-l-29 m-l-9 p-b-10">
                    <p class="p-b-11">
                        <?= $about['quotes']; ?>
                    </p>
                    <span class="s-text7">
                        - <?= $about['author']; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>