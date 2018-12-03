@extends('pdf.perwakilan.master')
@section('judul','Surat Keterangan | '.$data->nama)

@section('nomor')
	<h5><u>SURAT KETERANGAN</u></h5>
	<p>Nomor : 470/{{$data->id}}/{{romawi(date('m',strtotime($data->created_at)))}}/{{date('Y',strtotime($data->created_at))}}</p>
@endsection

@section('isi')
	<p>Kepala Desa Warnajati Kecamatan Cibadak Kabupaten Sukabumi menerangkan bahwa :</p>
	<br>

	<div class="content">
		<div class="row">
			<div class="col-md-3">Nama</div>
			<div class="col-md-9">: <strong>{{$data->nama}}</strong></div>
		</div>
		<div class="row">
			<div class="col-md-3">Jenis Kelamin</div>
			<div class="col-md-9">: {{$data->jenis_kelamin}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">NIK</div>
			<div class="col-md-9">: {{$data->nik}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">Tempat Tgl. Lahir</div>
			<div class="col-md-9">: {{$data->tempat}},{{$data->tanggal}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">Kewarganegaraan</div>
			<div class="col-md-9">: {{$data->kewarganegaraan}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">Agama</div>
			<div class="col-md-9">: {{$data->agama}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">Pekerjaan</div>
			<div class="col-md-9">: {{$data->pekerjaan}}</div>
		</div>
		<div class="row">
			<div class="col-md-3">Alamat</div>
			<div class="col-md-9">: {{$data->alamat}}</div>
		</div>
	</div>

	<br><p>Nama tersebut di atas memohon keterangan :</p><br>

	<div class="center">
		<h4>========== {{strtoupper($data->keperluan)}} ==========</h4>
	</div>

	<br><br>
	<p>Keterangan ini dibuat dalam rangka melengkapi persyaratan <strong>{{$data->keterangan}}</strong>.</p>
	<p>Keterangan ini kami berikan kepadanya, dengan berdasarkan sepengetahuan dan pertimbangan bahwa :</p>
	<p>1. Surat pengantar dari Ketua RT/RW</p>
	<p>2. Nama tersebut di atas adalah benar Warga Desa Warnajati Kecamatan Cibadak Kabupaten Sukabumi.</p>
	<br>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya sesuai dengan peruntukannya dan dimohon kepada pihak yang bersangkutan kiranya dapat memberikan bantuan serta agar maklum.</p>
	<br><br><br>

@endsection

@section('kanan')
	<p>Dibuat di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Warnajati</p>
	<p><u>Pada Tanggal	&nbsp;: {{date('d ').bulan(date('m')).date(' Y')}}</u></p>
	<br>
	<div class="center">
		<p>a.n Kepala Desa Warnajati</p>
		<p>{{$user->roles->first()->deskripsi}}</p>
		<br><br><br><br>
		<h4><u>{{$user->name}}</u></h4>
	</div>
@endsection