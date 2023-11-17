<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::truncate();

        
        Department::create(['name' => 'ANTIOQUIA']);
        Department::create(['name' => 'ATLÁNTICO']);
        Department::create(['name' => 'BOGOTÁ, D.C.']);
        Department::create(['name' => 'BOLÍVAR']);
        Department::create(['name' => 'BOYACÁ']);
        Department::create(['name' => 'CALDAS']);
        Department::create(['name' => 'CAQUETÁ']);
        Department::create(['name' => 'CAUCA']);
        Department::create(['name' => 'CESAR']);
        Department::create(['name' => 'CÓRDOBA']);
        Department::create(['name' => 'CUNDINAMARCA']);
        Department::create(['name' => 'CHOCÓ']);
        Department::create(['name' => 'HUILA']);
        Department::create(['name' => 'LA GUAJIRA']);
        Department::create(['name' => 'MAGDALENA']);
        Department::create(['name' => 'META']);
        Department::create(['name' => 'NARIÑO']);
        Department::create(['name' => 'NORTE DE SANTANDER']);
        Department::create(['name' => 'QUINDIO']);
        Department::create(['name' => 'RISARALDA']);
        Department::create(['name' => 'SANTANDER']);
        Department::create(['name' => 'SUCRE']);
        Department::create(['name' => 'TOLIMA']);
        Department::create(['name' => 'VALLE DEL CAUCA']);
        Department::create(['name' => 'ARAUCA']);
        Department::create(['name' => 'CASANARE']);
        Department::create(['name' => 'PUTUMAYO']);
        Department::create(['name' => 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA']);
        Department::create(['name' => 'AMAZONAS']);
        Department::create(['name' => 'GUAINÍA']);
        Department::create(['name' => 'GUAVIARE']);
        Department::create(['name' => 'VAUPÉS']);
        Department::create(['name' => 'VICHADA']);
    }
}
