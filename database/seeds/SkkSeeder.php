<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SkkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Faker\Factory::create('id_ID');
        $limit = 30;
        $pekerjaan = array('buruh','wiraswasta','PNS');
        $jenis = array("Laki-laki","Perempuan");
        for ($i=0; $i < $limit ; $i++) { 
        	DB::table('skks')->insert([

        		'user_id' => 3,
                'status' => $f->randomElement(array('acc','pending')),
        		'kabupaten' =>$f->state,
        		'kecamatan' =>$f->city,
        		'desa' =>$f->citySuffix,
        		'nama_kepala_keluarga' =>$f->name,
        		'no_kk' =>$f->unixTime($max='now'),
    	
    			'b_nama' =>$f->name,
    			'b_jenis_kelamin' =>$f->randomElement($jenis),
    			'b_tempat' =>"sukabumi",
    			'b_tanggal' =>$f->date($format = 'Y-m-d', $max = 'now'),
    			'b_jenis_kelahiran' =>"Normal",
    			'b_kelahiran_ke' =>$f->NumberBetween($min=1,$max=5),
    			'b_berat' =>$f->NumberBetween($min=1,$max=4),
    			'b_panjang' =>$f->NumberBetween($min=30,$max=60),
    
    			'i_nik' =>$f->unixTime($max='now'),
    			'i_nama' =>$f->name($gender="female"),
    			'i_tanggal_lahir' =>$f->date($format = 'Y-m-d', $max = 'now'),
    			'i_pekerjaan' =>$f->jobTitle,
    			'i_alamat' =>$f->address,
    			'i_kewarganegaraan' => "Indonesia",
    			'i_kebangsaan' => "Indonesia",
    			'i_tanggal_perkawinan' =>$f->date($format = 'Y-m-d', $max = 'now'),
    	
    			'a_nik' =>$f->unixTime($max='now'),
    			'a_nama' =>$f->name($gender="male"),
    			'a_tanggal_lahir' =>$f->date($format = 'Y-m-d', $max = 'now'),
    			'a_pekerjaan' =>$f->jobTitle,
    			'a_alamat' =>$f->address,
    			'a_kewarganegaraan' => "Indonesia",
    			'a_kebangsaan' => "Indonesia",
    			'a_tanggal_perkawinan' =>$f->date($format = 'Y-m-d', $max = 'now'),
    	
    			'p_nik' =>$f->unixTime($max='now'),
    			'p_nama' =>$f->name,
    			'p_umur' =>$f->NumberBetween($min=19,$max=40),
    			'p_jenis_kelamin' =>$f->randomElement($jenis),
    			'p_pekerjaan' =>$f->jobTitle,
    			'p_alamat' =>$f->address,
    	
    			's1_nik' =>$f->unixTime($max='now'),
    			's1_nama' =>$f->name,
    			's1_umur' =>$f->NumberBetween($min=19,$max=40),
    			's1_pekerjaan' =>$f->jobTitle,
    			's1_alamat' =>$f->address,
    	
    			's2_nik' =>$f->unixTime($max='now'),
    			's2_nama' =>$f->name,
    			's2_umur' =>$f->NumberBetween($min=19,$max=40),
    			's2_pekerjaan' =>$f->jobTitle,
    			's2_alamat' =>$f->address,

                'created_at' => $f->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $f->date($format = 'Y-m-d', $max = 'now'),
        	]);
        }
    }
}
