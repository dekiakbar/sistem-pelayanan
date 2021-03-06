@extends('pdf.kades.master')

@section('judul','Surat Keterangan Tidak Mampu | '.ucfirst($data->nama))

@section('nomor')
	<h5><u>SURAT KETERANGAN TIDAK MAMPU</u></h5>
	<p>Nomor : 421/{{$data->id}}/{{romawi(date('m',strtotime($data->created_at)))}}/{{date('Y',strtotime($data->created_at))}}</p>
@endsection

@section('isi')
	<p>Kepala Desa Warnajati Kecamatan Cibadak Kabupaten Sukabumi menerangkan bahwa :</p>
	<br>

	<div class="content">
		<div class="row">
			<div class="col-md-2">Nama</div>
			<div class="col-md-9">: <strong>{{ucfirst($data->nama)}}</strong></div>
		</div>
		<div class="row">
			<div class="col-md-2">Jenis Kelamin</div>
			<div class="col-md-9">: {{ucfirst($data->jenis_kelamin)}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">NIK</div>
			<div class="col-md-9">: {{$data->nik}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Tempat Tgl. Lahir</div>
			<div class="col-md-9">: {{ucfirst($data->tempat)}},{{(date('d',strtotime($data->tanggal)).' '.bulan(date('m',strtotime($data->tanggal))).' '.date('Y',strtotime($data->tanggal)))}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Kewarganegaraan</div>
			<div class="col-md-9">: {{ucfirst($data->kewarganegaraan)}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Agama</div>
			<div class="col-md-9">: {{ucfirst($data->agama)}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Pekerjaan</div>
			<div class="col-md-9">: {{ucfirst($data->pekerjaan)}}</div>
		</div>
		<div class="row">
			<div class="col-md-2">Alamat</div>
			<div class="col-md-9">: {{ucfirst($data->alamat)}}</div>
		</div>
	</div>

	<br><p>Adalah benar warga kami yang memohon Surat Keterangan Tidak Mampu kepada kami dalam rangka melengkapi persyaratan  <strong>{{ucfirst($data->keperluan)}}</strong></p><br>

	<br><p>Keterangan ini kami berikan kepadanya, dengan berdasarkan sepengetahuan dan pertimbangan bahwa :</p><br>
	
	<div class="content">
		<p>1. Surat pengantar dari Ketua RT/RW</p>
		<p>2. Nama tersebut di atas adalah benar Warga Desa Warnajati anak kandung dari Bapak <strong>{{ucfirst($data->n_ayah)}}</strong> dan Ibu <strong>{{ucfirst($data->n_ibu)}}</strong> yang tergolong keluarga tidak mampu.</p>
	</div>

	<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya sesuai dengan peruntukannya dan dimohon kepada pihak yang bersangkutan kiranya dapat memberikan bantuan serta agar maklum.</p>
	<br><br>

@endsection

@section('kanan')
	<p>Dibuat Di &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Warnajati</p>
	<p><u>Pada Tanggal	&nbsp;: {{(date('d',strtotime($data->created_at)).' '.bulan(date('m',strtotime($data->created_at))).' '.date('Y',strtotime($data->created_at)))}}</u></p>
	<br>
	<div class="center">
		<p>Kepala Desa Warnajati</p>
		<br><br><br><br>
		<h4><u>{{ucfirst($user->name)}}</u></h4>
	</div>
	<br><br><br><br><br><br>
@endsection