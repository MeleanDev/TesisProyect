<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $modalidades = ['online', 'presencial', 'semi-presencial'];
        $certificaciones = ['si', 'no'];
        $tiposCurso = ['computacion', 'administracion', 'diseno'];
        $categorias = ['menores', 'ejecutivo', 'empresarial'];
        $idiomas = ['spanish', 'english'];

        // Genera 20 registros falsos para la tabla 'cursos'
        for ($i = 0; $i < 20; $i++) {
            $nombre = fake()->unique()->sentence(3); // Genera un nombre de 3 palabras
            DB::table('cursos')->insert([
                'estado' => fake()->boolean(),
                'image' => fake()->imageUrl(640, 480, 'courses', true),
                'slug' => Str::slug($nombre),
                'nombre' => $nombre,
                'descripcion' => fake()->paragraph(),
                'precio' => fake()->randomFloat(2, 50, 500), // Precio entre 50 y 500 con 2 decimales
                'horasAcademicas' => fake()->numberBetween(10, 100),
                'maximoParticipantes' => fake()->numberBetween(5, 50),
                'modalidad' => fake()->randomElement($modalidades),
                'certificacion' => fake()->randomElement($certificaciones),
                'tipoCurso' => fake()->randomElement($tiposCurso),
                'categoria' => fake()->randomElement($categorias),
                'idioma' => fake()->randomElement($idiomas),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $faker = \Faker\Factory::create('es_ES');

        for ($i = 0; $i < 50; $i++) {
            DB::table('cliente_registrados')->insert([
                'estado' => $faker->boolean(),
                'Pnombre' => $faker->firstName(),
                'Snombre' => $faker->firstName(),
                'Papelldio' => $faker->lastName(),
                'Sapelldio' => $faker->lastName(),
                'identidad' => $faker->unique()->numerify('###########'), 
                'email' => $faker->unique()->safeEmail(),
                'telefono' => $faker->phoneNumber(),
                'image' => $faker->imageUrl(640, 480, 'people', true, 'Faker'),
                'fecha_nacimiento' => $faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
