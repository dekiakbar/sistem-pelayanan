@extends('kades.admin')
@section('judul','Tambah Postingan')

@section('blog','active')
@section('createPost','active')
@section('isi')
	<section class="content-header">
      <h1>
        Dashboard
        <small>Kepala Desa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Postingan</li>
      </ol>
    </section>

    <section class="content">
		<form action="{{ route('kades.blog.store') }}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}

		    <div class="box box-primary">
		        <div class="box-header with-border">
		          <h3 class="box-title">Tambah Postingan</h3>

		          <div class="pull-right box-tools">
	                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
	                        title="Collapse">
	                  <i class="fa fa-minus"></i></button>
	              </div>
		        </div>

		        <div class="box-body">
				    <div class="row">
				       <div class="col-md-6">
				           	<div class="form-group">
				           	  <label>Judul</label>
				           	  <input name="judul" type="text" class="form-control" required>
				           	</div>
							
							<div class="form-group">
								<label for="exampleInputFile">Foto Postingan</label>
								<input name="foto" type="file" required>
								<p class="help-block">Gambar Untuk Postingan Website</p>
							</div>
				        </div>

				        <div class="col-md-6">
				        	<div class="form-group">
				              <label>Kategori</label>
				              <select name="kategori_id" class="form-control" required>
				              		@foreach($datas as $d)
				              			<option value="{{$d->id}}">{{$d->nama}}</option>
				              		@endforeach
				              </select>
				            </div>

				            <div class="form-group">
				              <label>Deskripsi</label>
				              <textarea name="deskripsi" type="text" class="form-control" rows="3" required>
				              </textarea>
				            </div>

				        </div>

				    </div>
			    </div>
		    </div>
		
			<div class="box box-info">
		        <div class="box-header">
		          <h3 class="box-title">
		            Postingan
		          </h3>
		          <div class="pull-right box-tools">
		            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i>
		          	</button>
		          </div>
		        </div>

		        <div class="box-body pad">
		            <div class="form-group">
		            	<textarea name="isi" rows="10" cols="80" required></textarea>	
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="btn btn-sm btn-info">Posting</button>	
		            </div>
		        </div>
		    </div>
		</form>
    </section>
@endsection

@section('ckUploadJS')
	<script type="text/javascript">
	  var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
	</script>
	<script type="text/javascript">
	  $('textarea[name=isi]').ckeditor({
	      height: 500,
	      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
	      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
	  });
	</script>
@endsection