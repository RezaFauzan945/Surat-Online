 <!-- Masthead-->
 <header class="masthead">
 	<div class="container">
 		<div class="masthead-subheading">Selamat Datang Di</div>
 		<div class="masthead-heading text-uppercase">Kantor Desa Meliau Hilir</div>
 		<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#profil">Lihat Profil</a>
 	</div>
 </header>

 <!-- profil-->
 <section class="page-section" id="profil">
 	<div class="container">
 		<div class="text-center">
 			<h2 class="section-heading text-uppercase">Profil</h2>
 			<h3 class="section-subheading text-muted">Kantor Desa Meliau Hilir</h3>
 		</div>
 		<div class="row text-justify pl-5 pr-5">
 			<p><?= $profil[0]['profile'] ?></p>
 		</div>
 	</div>
 </section>

 <!-- struktur -->
 <section class="page-section bg-light" id="struktur">
 	<div class="container">
 		<div class="text-center">
 			<h2 class="section-heading text-uppercase">Struktur Organisasi</h2>
 			<h3 class="section-subheading text-muted">Kantor Desa Meliau Hilir</h3>
 		</div>
 		<div class="row">
 			<div class="col-lg-12 col-sm-6 mb-10">
 				<div class="portfolio-item">
 					<a class="portfolio-link" data-toggle="modal" href="#skelurahan">
 						<div class="portfolio-hover">
 							<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
 						</div>
 						<img class="img-fluid" src="/assets/galery/<?= $profil[0]['s_kelurahan'] ?>" alt="struktur-kelurahan" />
 					</a>
 					<div class="portfolio-caption">
 						<div class="portfolio-caption-heading">Struktur Kantor Desa</div>
 						<div class="portfolio-caption-subheading text-muted">Klik + lihat detail</div>
 					</div>
 				</div>
 			</div>

 			<div class="container">
 				<div class="text-center">
 					<h2 class="section-heading text-uppercase">Info Pengajuan Surat Online</h2>
 					<h3 class="section-subheading text-muted">Kantor Desa Meliau Hilir</h3>
 				</div>
 				<div class="row text-justify pl-5 pr-5">
 					<p>Diberitahukan untuk melakukan Pengajuan Surat Online dimohon untuk melengkapi data dengan benar dan
 						berkas persyaratan untuk Pengajuan Surat Online di Upload. Jika terdapat permasalahan dalam mengisi
 						form Pengajuan Surat Online dimohon kepada pengaju untuk datang langsung ke Kantor Kelurahan Pulau,
 						atas perhatiannya terimakasih.</p>
 				</div>
 			</div>

 		</div>
 	</div>
 </section>