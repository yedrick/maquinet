<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;

class PlayerController extends Controller
{
    public function register(StorePlayerRequest $request)
    {
        $player = Player::create([
            'first_name' => $request->input('nombre'),
            'last_name' => $request->input('apellido'),
            'dni' => $request->input('dni') ?? null,
            'email' => $request->input('email'),
            'cellphone' => $request->input('telefono'),
            'accepts_terms' => $request->input('aceptaTerminos'),
        ]);

        //send  correo de confirmacion
        // Mail::to($request->email)->send(
        //     new ConfirmationEmail(
        //         $request->nombre,
        //         url('/')
        //     )
        // );
        return response()->json(['message' => 'Jugador registrado con éxito', 'player' => $player], 201);
    }
}
