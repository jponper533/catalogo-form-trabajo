<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormStoreRequest;
use App\Http\Requests\FormUpdateRequest;
use App\Services\formService;
use App\Services\favoritoService;
use App\Models\Formulario;
use App\Models\Favorito;
use Illuminate\Http\Request;
use App\Http\Requests\FormSubmitRequestJSON;
use Seld\JsonLint\JsonParser;
use App\Models\Tag;


class FormularioController extends Controller
{

    protected $formService;
    protected $favoritoService;

    public function __construct(formService $formService, favoritoService $favoritoService)
    {
        $this->formService = $formService;
        $this->favoritoService = $favoritoService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formulario = Formulario::where('visible', true)
            ->orWhere('username', session('username'))
            ->get();

        // Obtener IDs de favoritos del usuario actual
        $favoritosIds = Favorito::where('username', session('username'))
            ->pluck('formulario_id')
            ->toArray();

        return view('formulario.index', compact('formulario', 'favoritosIds'));
    }

    public function detectarTipoCampo($valor)
    {
        // Boolean
        if (is_bool($valor)) {
            return 'checkbox';
        }

        // Número
        if (is_int($valor) || is_float($valor)) {
            return 'number';
        }

        // Array
        if (is_array($valor)) {
            return 'select';
        }

        // Email
        if (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        // Texto largo
        if (is_string($valor) && strlen($valor) > 100) {
            return 'textarea';
        }

        // Por defecto
        return 'text';
    }

    private function generarCampos($json, $prefix = '')
    {
        $campos = [];

        foreach ($json as $key => $valor) {

            $nombre = $prefix ? $prefix . '[' . $key . ']' : $key;

            if (is_array($valor) && $this->esAsociativo($valor)) {
                $campos = array_merge($campos, $this->generarCampos($valor, $nombre));
            } else {
                $campos[] = [
                    'name' => $nombre,
                    'label' => ucfirst($key),
                    'type' => $this->detectarTipoCampo($valor),
                    'value' => $valor,
                    'options' => is_array($valor) ? $valor : null
                ];
            }
        }

        return $campos;
    }

    private function esAsociativo(array $array)
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function show(Formulario $formulario)
    {
        // $formulario->contenido ya es array automáticamente
        $json = json_decode($formulario->datos, true);

        $campos = $this->generarCampos($json);

        $tag = Tag::first();

        return view('formulario.formularioJSON', compact('formulario', 'campos', 'tag'));
    }

    public function seeUserForms()
    {
        $username = session('username');
        $formularios = Formulario::where('username', $username)->get();
        $favoritosIds = Favorito::where('username', session('username'))
            ->pluck('formulario_id')
            ->toArray();

        return view('formulario.userforms', compact('formularios', 'favoritosIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formulario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormStoreRequest $request)
    {
        $validated = $request->validated();

        $errorJson = $this->validarJson($validated['datos']);

        if ($errorJson) {

            if ($request->expectsJson()) {
                return response()->json([
                    'errors' => ['datos' => [$errorJson]]
                ], 422);
            }

            return back()
                ->withErrors(['datos' => $errorJson])
                ->withInput();
        }

        $validated['username'] = session('username');

        $this->formService->crearFormulario($validated);
        $this->favoritoService->crearFavorito();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard')
            ]);
        }

        return redirect()->route('dashboard');
    }

    private function validarJson($json)
    {
        $parser = new JsonParser();
        $result = $parser->lint($json);

        if ($result instanceof \Seld\JsonLint\ParsingException) {
            return $result->getMessage();
        }

        return null;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formulario $formulario)
    {
        return view('formulario.edit', compact('formulario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormUpdateRequest $request, Formulario $formulario)
    {
        $validated = $request->validated();

        $errorJson = $this->validarJson($validated['datos']);

        if ($errorJson) {
            return back()
                ->withErrors(['datos' => $errorJson])
                ->withInput();
        }

        $formulario->update($validated);

        return redirect()->route('formulario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formulario $formulario)
    {
        $formulario->delete();
        return redirect()->route('formulario.index');
    }


    public function activar(Request $request, Formulario $formulario)
    {
        $username = session('username');

        if ($request->has('activo')) {

            Favorito::firstOrCreate([
                'formulario_id' => $formulario->id,
                'username' => $username,
            ]);

            $activo = true;
        } else {

            Favorito::where('formulario_id', $formulario->id)
                ->where('username', $username)
                ->delete();

            $activo = false;
        }

        // Si la petición es AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'activo' => $activo
            ]);
        }

        return redirect()->route('formulario.index');
    }
}
