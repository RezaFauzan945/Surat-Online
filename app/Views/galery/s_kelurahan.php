<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<?php if (session()->getFlashdata('success') == TRUE) : ?>
			<div class="alert alert-success">
				<span><?= session()->getFlashdata('success'); ?></span>
			</div>
			<?php endif; ?>
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="purple">
						<i class="material-icons">people</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Struktur Kelurahan</h4>
						<image class="img-fluid" src="/assets/galery/<?= $profil['s_kelurahan'] ?>" alt="struktur-kelurahan"></image>
						<a href="/galery/edit_s_kelurahan/<?= $profil['id']?>"
							class="btn btn-finish pull-right">Edit</a>
					</div>
					<!-- end content-->
				</div>
				<!--  end card  -->
			</div>
			<!-- end col-md-12 -->
		</div>
		<!-- end row -->
	</div>
</div>
