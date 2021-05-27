<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $ruta_img = $request->file('file')->store('establecimiento', 'public');
        $img = Image::make(public_path("storage/{$ruta_img}"))->fit(800, 450);
        $img->save();

        Imagen::create([
           'id_establecimiento' => $request['uuid'],
           'ruta_imagen' => $ruta_img,
        ]);

        $resp = [
            'archivo' => $ruta_img
        ];

        return response()->json($resp);
    }

    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');

        if (File::exists('storage/'.$imagen)){
            File::delete('storage/'.$imagen);
        }

        $response = [
          'mensaje' => 'Imagen Eliminada',
          'imagen' => $imagen,
        ];

        Imagen::where('ruta_imagen', 'LIKE', $imagen)->delete();

        return response()->json($response);
    }
}
