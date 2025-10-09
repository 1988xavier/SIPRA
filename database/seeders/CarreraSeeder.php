<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
            [
                'nombre' => 'Ingeniería en Sistemas Computacionales',
                'descripcion' => 'Formación integral en desarrollo de software y sistemas informáticos.',
                'objetivo' => 'Desarrollar profesionales capaces de diseñar, implementar y mantener sistemas computacionales.',
                'perfil' => 'Profesional con conocimientos en programación, bases de datos y redes.',
                'plan_estudio' => '8 semestres con materias de programación, matemáticas y ciencias de la computación.',
                'desarrollo_profesional' => 'Desarrollador de software, analista de sistemas, arquitecto de software.',
                'competencias' => 'Programación, análisis de sistemas, gestión de proyectos tecnológicos.',
                'requisitos' => 'Bachillerato concluido, conocimientos básicos de matemáticas.',
                'capacidad' => 50,
                'activo' => true,
            ],
            [
                'nombre' => 'Licenciatura en Administración',
                'descripcion' => 'Formación en gestión empresarial y administración de organizaciones.',
                'objetivo' => 'Desarrollar líderes empresariales con visión estratégica.',
                'perfil' => 'Profesional con habilidades de liderazgo y gestión.',
                'plan_estudio' => '8 semestres con materias de administración, economía y finanzas.',
                'desarrollo_profesional' => 'Gerente general, director de área, consultor empresarial.',
                'competencias' => 'Liderazgo, gestión de equipos, análisis financiero.',
                'requisitos' => 'Bachillerato concluido, interés en el mundo empresarial.',
                'capacidad' => 40,
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería Industrial',
                'descripcion' => 'Optimización de procesos productivos y gestión de operaciones.',
                'objetivo' => 'Formar ingenieros capaces de optimizar procesos industriales.',
                'perfil' => 'Profesional con conocimientos en procesos y calidad.',
                'plan_estudio' => '8 semestres con materias de matemáticas, física y procesos industriales.',
                'desarrollo_profesional' => 'Ingeniero de procesos, gerente de producción, consultor.',
                'competencias' => 'Optimización, control de calidad, gestión de proyectos.',
                'requisitos' => 'Bachillerato concluido, conocimientos de matemáticas y física.',
                'capacidad' => 35,
                'activo' => true,
            ],
        ];

        foreach ($carreras as $carrera) {
            Carrera::create($carrera);
        }
    }
}