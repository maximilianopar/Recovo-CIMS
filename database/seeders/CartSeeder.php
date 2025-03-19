<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@recovo.com')->first();
        if (!$user) {
            $this->command->warn("No se encontró el usuario 'user@recovo.com'. Ejecuta primero el UserSeeder.");
            return;
        }
     
        DB::table('carts')->insert([
            'user_id'    => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info("Carrito creado correctamente para el usuario {$user->email}");
    }
}
