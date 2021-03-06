@extends('kades.admin')
@section('judul','Daftar Surat Keterangan Kelahiran Yang Telah Di Terima')

@section('skk','active')
@section('riwayatSkk','active')
@section('isi')
	<section class="content-header">
      <h1>
        Dashboard
        <small>Kepala Desa</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('kades.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Surat Keterangan Kelahiran Yang Telah Di Terima</li>
      </ol>
    </section>

    <section class="content">

    	<div class="row">
    		<div class="col-xs-12">
    			<div class="box">

		           	<div class="box-header">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h4>Daftar Surat Keterangan Kelahiran</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<form class="navbar-form navbar-form pull-right" method="post" action="{{ route('kades.skk.export') }}">
									{{csrf_field()}}
									<div class="form-group">
										<label>Pilih Data :&nbsp;</label>
										<select name="export" class="form-control">
											@foreach($export as $x)
												<option value="{{$x->month.'-'.$x->year}}">{{$x->year.' - '.bulan($x->month)}}</option>
											@endforeach
										</select>
										<button type="submit" class="btn btn-sm btn-info" style="margin-left: 5px;">Download</button>
									</div>
								</form>
							</div>
						</div>
		            </div>
		            
		            <div class="box-body table-responsive no-padding">
		              <table class="table table-hover">
		                <tr>
							<th>No</th>
			                <th>Nama</th>
			                <th>Tempat Tanggal Lahir</th>
			                <th>Nama Ibu</th>
			                <th>Nama Ayah</th>
			                <th>Jenis Kelamin</th>
			                <th>Kelahiran Ke</th>
			                <th>Status</th>
			                <th>Aksi</th>
		                </tr>
		                @foreach($datas as $data)
				            	<tr>
				                  	<td>{{++$no}}</td>
				                  	<td>{{$data->b_nama}}</td>
				                  	<td>{{$data->b_tempat}}, {{date('d-m-Y',strtotime($data->b_tanggal))}}</td> 
				                  	<td>{{$data->a_nama}}</td>
				                  	<td>{{$data->i_nama}}</td>
				                  	<td>{{$data->b_jenis_kelamin}}</td>
				                  	<td>{{$data->b_kelahiran_ke}}</td>
				                  	<td>
				                  		<span class="label label-success">{{$data->status}}</span>
				                  	</td>
				                  	<td>
				                  		<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#{{md5($data->id.'skkpdf')}}">
											<i class="fa fa-file-alt"></i>
											 PDF
										</a>
										<br>
										<a class="btn btn-xs btn-info" data-toggle="modal" data-target="#{{md5($data->id.'skk')}}" style="margin-top: 10px;">
											<i class="fa fa-edit"></i>
											Edit
										</a>
										<br>
										<a class="btn btn-xs btn-danger" onclick="event.preventDefault();document.getElementById('{{md5($data->id."hapus")}}').submit();" style="margin-top: 10px;">
						                    <i class="fa fa-trash"></i>
						                    Hapus
						                    </a>

						                    <form id="{{md5($data->id.'hapus')}}" action="{{ route('kades.skk.destroy',$data->id) }}" method="POST" style="display: none;">
						                        {{ csrf_field() }}
						                        <input type="hidden" name="_method" value="DELETE">
						                    </form>
				                  	</td>
				                </tr>
		                @endforeach
		              </table>
		              <div class="pull-right">
		              	{!! $datas->render('vendor.pagination.default') !!}
		              </div>
		            </div>

		        </div>

    		</div>
    	</div>

    	@foreach($datas as $d)
    		<div class="modal fade" id="{{md5($d->id.'skkpdf')}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog" role="document">
			        <div class="modal-content">
			            <div class="modal-header text-center">
			                <h4 class="modal-title w-100 font-weight-bold">
			                	Penanggung Jawab Surat
				                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
			                </h4>
			            </div>
			            <div class="modal-body">
							<h5>Pilih Penanggung Jawab Surat</h5>
				            <div class="input-group">
				              	<span class="input-group-addon"><i class="fa fa-hammer"></i></span>
				              	<select class="form-control" data-url="{{ route('kades.skk.show',['skk'=> $d->id,'user_id' => '']) }}" onchange="getData(this);">
				              		<option disabled selected>Pilih Penanggung Jawab Surat</option>
				              		@foreach($user as $u)
				              			<option data-id="{{$u->id}}">{{$u->name}}</option>
				              		@endforeach
				              	</select>
				            </div>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="modal fade" id="{{md5($d->id.'skk')}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-lg" role="document">
			        <div class="modal-content">
			            <div class="modal-header text-center">
			                <h4 class="modal-title w-100 font-weight-bold">
			                	Ubah Data Surat Keterangan Kelahiran
				                <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
			                </h4>
			            </div>
			            <div class="modal-body">

				            <form method="POST" action="{{ route('kades.skk.update',$d->id) }}">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="PATCH">
								
								<div class="panel panel-info">
						            <div class="panel-heading"><strong>BAYI</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>Pemerintah Desa / Kelurahan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-home"></i></span>
								              		<input name="kabupaten" type="text" class="form-control" required value="{{$data->kabupaten}}">
								            	</div>

								            	<h5>Kecamatan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-vihara"></i></span>
								              		<input name="kecamatan" type="text" class="form-control" required value="{{$data->kecamatan}}">
								            	</div>

								            	<h5>Kabupaten / Kota</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-globe-asia"></i></span>
								              		<input name="desa" type="text" class="form-control" required value="{{$data->desa}}">
								            	</div>
											</div>
											<div class="col-md-6">

								            	<h5>Nama Kepala Keluarga</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="nama_kepala_keluarga" type="text" class="form-control" required value="{{$data->nama_kepala_keluarga}}">
								            	</div>

								            	<h5>No Kartu Keluarga</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-address-card"></i></span>
								              		<input name="no_kk" type="text" class="form-control" required value="{{$data->no_kk}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

								<div class="panel panel-info">
						            <div class="panel-heading"><strong>BAYI</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="b_nama" type="text" class="form-control" required value="{{$d->b_nama}}">
								            	</div>

								            	<h5>Jenis Kelamin</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
								              		<select class="form-control" name="b_jenis_kelamin">
								              			@if($d->b_jenis_kelamin == 'laki-laki')
															<option value="laki-laki" selected>Laki-laki</option>
												  			<option value="perempuan">Perempuan</option>
												  		@else
															<option value="laki-laki">Laki-laki</option>
												  			<option value="perempuan" selected>Perempuan</option>
												  		@endif
								              		</select>
								            	</div>

								            	<h5>Tempat Lahir</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-marked-alt"></i></span>
								              		<input name="b_tempat" type="text" class="form-control" required value="{{$d->b_tempat}}">
								            	</div>

								            	<h5>Tanggal Lahir</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
								              		<input name="b_tanggal" type="text" id="l_bayi" class="form-control" required value="{{date('d-m-Y', strtotime($d->b_tanggal))}}">
								            	</div>
						                	</div>
						                	<div class="col-md-6">
						                		<h5>Jenis Kelahiran</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-first-aid"></i></span>
								              		<input name="b_jenis_kelahiran" type="text" class="form-control" required value="{{$d->b_jenis_kelahiran}}">
								            	</div>

								            	<h5>Kelahiran Ke</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-child"></i></span>
								              		<input name="b_kelahiran_ke" type="number" class="form-control" required value="{{$d->b_kelahiran_ke}}">
								            	</div>

								            	<h5>Berat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-weight"></i></span>
								              		<input name="b_berat" type="number" class="form-control" required value="{{$d->b_berat}}">
								              		<span class="input-group-addon">KG</span>
								            	</div>

								            	<h5>Panjang</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-ruler-combined"></i></span>
								              		<input name="b_panjang" type="number" class="form-control" required value="{{$d->b_panjang}}">
								              		<span class="input-group-addon">CM</span>
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

					            <div class="panel panel-primary">
						            <div class="panel-heading"><strong>IBU</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>NIK</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
								              		<input name="i_nik" type="number" class="form-control" required value="{{$d->i_nik}}">
								            	</div>

								            	<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="i_nama" type="text" class="form-control" required value="{{$d->i_nama}}">
								            	</div>

								            	<h5>Tanggal Lahir</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
								              		<input name="i_tanggal_lahir" id="l_ibu" type="text" class="form-control" required value="{{date('d-m-Y', strtotime($d->i_tanggal_lahir))}}"">
								            	</div>

								            	<h5>Pekerjaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								              		<select class="form-control" name="i_pekerjaan">
								              			@foreach($ps as $p)
												  			@if($p->slug == $d->i_pekerjaan)
																<option value="{{$p->slug}}" selected>{{$p->nama}}</option>
												  			@else
																<option value="{{$p->slug}}">{{$p->nama}}</option>
												  			@endif
												  		@endforeach
								              		</select>
								            	</div>
						                	</div>
						                	<div class="col-md-6">
						                		<h5>Alamat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
								              		<input name="i_alamat" type="text" class="form-control" required value="{{$d->i_alamat}}">
								            	</div>

								            	<h5>Kewarganegaraan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
								              		<input name="i_kewarganegaraan" type="text" class="form-control" required value="{{$d->i_kewarganegaraan}}">
								            	</div>

								            	<h5>Kebangsaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
								              		<input name="i_kebangsaan" type="text" class="form-control" required value="{{$d->i_kebangsaan}}">
								            	</div>

								            	<h5>Tanggal Pernikahan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
								              		<input name="i_tanggal_perkawinan" id="p_ibu" type="text" class="form-control" required value="{{date('Y-m-d',strtotime($d->i_tanggal_perkawinan))}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

					            <div class="panel panel-success">
						            <div class="panel-heading"><strong>AYAH</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>NIK</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
								              		<input name="a_nik" type="number" class="form-control" required value="{{$d->a_nik}}">
								            	</div>

								            	<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="a_nama" type="text" class="form-control" required value="{{$d->a_nama}}">
								            	</div>

								            	<h5>Tanggal Lahir</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
								              		<input name="a_tanggal_lahir" type="text" id="l_ayah" class="form-control" required value="{{date('d-m-Y', strtotime($d->a_tanggal_lahir))}}">
								            	</div>

								            	<h5>Pekerjaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								              		<select class="form-control" name="a_pekerjaan">
									              		@foreach($ps as $p)
												  			@if($p->slug == $d->a_pekerjaan)
																<option value="{{$p->slug}}" selected>{{$p->nama}}</option>
												  			@else
																<option value="{{$p->slug}}">{{$p->nama}}</option>
												  			@endif
												  		@endforeach
								              		</select>
								            	</div>
						                	</div>
						                	<div class="col-md-6">
						                		<h5>Alamat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
								              		<input name="a_alamat" type="text" class="form-control" required value="{{$d->a_alamat}}">
								            	</div>

								            	<h5>Kewarganegaraan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
								              		<input name="a_kewarganegaraan" type="text" class="form-control" required value="{{$d->a_kewarganegaraan}}">
								            	</div>

								            	<h5>Kebangsaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card-alt"></i></span>
								              		<input name="a_kebangsaan" type="text" class="form-control" required value="{{$d->a_kebangsaan}}">
								            	</div>

								            	<h5>Tanggal Pernikahan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
								              		<input name="a_tanggal_perkawinan" type="text" id="p_ayah" class="form-control" required value="{{$d->a_tanggal_perkawinan}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

					            <div class="panel panel-info">
						            <div class="panel-heading"><strong>PELAPOR</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>NIK</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
								              		<input name="p_nik" type="number" class="form-control" required value="{{$d->p_nik}}">
								            	</div>

								            	<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="p_nama" type="text" class="form-control" required value="{{$d->p_nama}}">
								            	</div>

								            	<h5>Umur</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="p_umur" type="text" class="form-control" required value="{{$d->p_umur}}">
								            	</div>
						                	</div>
						                	<div class="col-md-6">
						                		<h5>Jenis Kelamin</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
								              		<select class="form-control" name="p_jenis_kelamin">
								              			@if($d->p_jenis_kelamin == 'laki-laki')
															<option value="laki-laki" selected>Laki-laki</option>
												  			<option value="perempuan">Perempuan</option>
												  		@else
															<option value="laki-laki">Laki-laki</option>
												  			<option value="perempuan" selected>Perempuan</option>
												  		@endif
								              		</select>
								            	</div>

								            	<h5>Pekerjaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								              		<select class="form-control" name="p_pekerjaan">
									              		@foreach($ps as $p)
												  			@if($p->slug == $d->p_pekerjaan)
																<option value="{{$p->slug}}" selected>{{$p->nama}}</option>
												  			@else
																<option value="{{$p->slug}}">{{$p->nama}}</option>
												  			@endif
												  		@endforeach
								              		</select>
								            	</div>

								            	<h5>Alamat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
								              		<input name="p_alamat" type="text" class="form-control" required value="{{$d->p_alamat}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

					            <div class="panel panel-primary">
						            <div class="panel-heading"><strong>SAKSI I</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>NIK</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
								              		<input name="s1_nik" type="number" class="form-control" required value="{{$d->s1_nik}}">
								            	</div>

								            	<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="s1_nama" type="text" class="form-control" required value="{{$d->s1_nama}}">
								            	</div>

								            	<h5>Umur</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="s1_umur" type="text" class="form-control" required value="{{$d->s1_umur}}">
								            	</div>
						                	</div>
						                	<div class="col-md-6">

								            	<h5>Pekerjaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								              		<select class="form-control" name="s1_pekerjaan">
								              			@foreach($ps as $p)
												  			@if($p->slug == $d->s1_pekerjaan)
																<option value="{{$p->slug}}" selected>{{$p->nama}}</option>
												  			@else
																<option value="{{$p->slug}}">{{$p->nama}}</option>
												  			@endif
												  		@endforeach
								              		</select>
								            	</div>

								            	<h5>Alamat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
								              		<input name="s1_alamat" type="text" class="form-control" required value="{{$d->s1_alamat}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

					            <div class="panel panel-success">
						            <div class="panel-heading"><strong>SAKSI II</strong></div>
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<h5>NIK</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
								              		<input name="s2_nik" type="number" class="form-control" required value="{{$d->s2_nik}}">
								            	</div>

								            	<h5>Nama</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="s2_nama" type="text" class="form-control" required value="{{$d->s2_nama}}">
								            	</div>

								            	<h5>Umur</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								              		<input name="s2_umur" type="text" class="form-control" required value="{{$d->s2_umur}}">
								            	</div>
						                	</div>
						                	<div class="col-md-6">

								            	<h5>Pekerjaan</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
								              		<select class="form-control" name="s2_pekerjaan">
								              			@foreach($ps as $p)
												  			@if($p->slug == $d->s2_pekerjaan)
																<option value="{{$p->slug}}" selected>{{$p->nama}}</option>
												  			@else
																<option value="{{$p->slug}}">{{$p->nama}}</option>
												  			@endif
												  		@endforeach
								              		</select>
								            	</div>

								            	<h5>Alamat</h5>
								            	<div class="input-group">
								              		<span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
								              		<input name="s2_alamat" type="text" class="form-control" required value="{{$d->s2_alamat}}">
								            	</div>
						                	</div>
						              	</div>
						            </div>
					            </div>

				            	<div class="modal-footer d-flex justify-content-center">
				               		<button type="submit" class="btn btn-primary">Simpan</button>
				              	</div>
							</form>

			            </div>
			        </div>
			    </div>
			</div>
    	@endforeach

    </section>
@endsection