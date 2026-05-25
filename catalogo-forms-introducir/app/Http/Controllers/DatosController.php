<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormStoreRequest;
use App\Models\datos;
use Illuminate\Support\Arr;
use App\Exports\DynamicExport;
use Maatwebsite\Excel\Facades\Excel;

class DatosController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function store(Request $request)
    {

        $textoFinal = $request->input('data');
        $textoFinal = str_replace(["\r", "\n"], ' ', $textoFinal);

        $data = Datos::create([
            'data' =>  $textoFinal
        ]);

        return redirect()->route('main.index')->with('success', 'Datos guardados correctamente.');
    }

    public function buscar(Request $request)
    {
        $nombre = $request->input('busqueda');

        $resultados = Datos::where('data', 'LIKE', '%nombre_form=EPOGRE-' . $nombre . '%')->get();


        $datos = $resultados->map(function ($resultado) {
            return $this->parseDataToJson($resultado->data);
        });

        $filas = collect($datos)->map(function ($item) {

            $aplanado = Arr::dot($item);


            return collect($aplanado)->map(function ($valor) {
                $boolVal = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

                if (!is_null($boolVal)) {
                    return $boolVal ? 'Sí' : 'No';
                }

                return (is_null($valor) || $valor === '') ? '-' : $valor;
            })->toArray();
        });

        $columnas = array_keys($filas->first() ?? []);
        return view('busqueda.resultado', compact('filas', 'columnas', 'nombre'));
    }

    private function parseDataToJson($input)
    {
        $result = [];

        // separar cada par clave=valor
        // por 2 o más espacios
        $pairs = preg_split('/\s{2,}/', trim($input));

        foreach ($pairs as $pair) {

            if (strpos($pair, '=') === false) {
                continue;
            }

            [$fullKey, $value] = explode('=', $pair, 2);

            $fullKey = trim($fullKey);
            $value = trim($value);

            // convertir tipos
            if ($value === 'true') {
                $value = true;
            } elseif ($value === 'false') {
                $value = false;
            } elseif (is_numeric($value)) {
                $value = $value + 0;
            }

            // decodificar unicode tipo \u00f3
            $value = json_decode('"' . addslashes($value) . '"');

            // convertir producto[nombre]
            // en ['producto', 'nombre']
            preg_match_all('/([^\[\]]+)/', $fullKey, $matches);

            $keys = $matches[0];

            $temp = &$result;

            foreach ($keys as $index => $key) {

                if ($index === count($keys) - 1) {

                    $temp[$key] = $value;
                } else {

                    if (!isset($temp[$key]) || !is_array($temp[$key])) {
                        $temp[$key] = [];
                    }

                    $temp = &$temp[$key];
                }
            }
        }

        return $result;
    }

    public function export(Request $request)
    {
        $nombre = $request->input('busqueda');

        $resultados = Datos::where('data', 'LIKE', '%EPOGRE-' . $nombre . ' %')->get();

        $datos = $resultados->map(function ($resultado) {
            return $this->parseDataToJson($resultado->data);
        });

        $filas = collect($datos)->map(function ($item) {

            $aplanado = Arr::dot($item);

            return collect($aplanado)->map(function ($valor) {
                $boolVal = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

                if (!is_null($boolVal)) {
                    return $boolVal ? 'Sí' : 'No';
                }

                return (is_null($valor) || $valor === '') ? '-' : $valor;
            })->toArray();
        });

        // columnas igual que en buscar()
        $columnas = array_keys($filas->first() ?? []);

        return Excel::download(
            new DynamicExport($filas, $columnas),
            'resultados.xlsx'
        );
    }
}
