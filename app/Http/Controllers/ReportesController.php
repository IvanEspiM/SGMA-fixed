<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    private $EmpresaModel;

    /**
     * @Rafael1108
     * Muestra la vista de reportes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *
     * @Rafael1108
     * Muestra formulario modales de parámetros.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        switch ($id) {
            case 2:
                /* retorna la vista en funcion del id del reporte que se requiere*/
                return view('reportes.nuevosClientes');
                break;

            default:
                return response()->json(['error' => 'Reporte no encontrado!'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    /**
     *
     * @Rafael1108
     * Método POST para obtener los reportes renderizados y exportables.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function showReport(Request $request, $id)
    {
        switch ($id) {
            case 2:
                /* retorna la vista en funcion del id del reporte que se requiere*/
                return $this->rptNuevosClientes($request);
            default:
                return response()->json(['error' => 'Reporte no encontrado!'], 500);
        }
    }

    /**
     *
     * @Rafael1108
     * Método para Generar reporte de Nuevos clientes
     * la funcion requeire el request del POST.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Barryvdh\DomPDF\Facade\Pdf
     */
    private function rptNuevosClientes(Request $request)
    {
        setlocale(LC_ALL, 'es_ES');
        $EmpresaModel = new Empresa();
        $emp  = $EmpresaModel::all(['id', 'RUC', 'RazonSocial', 'NombreComercial']);
        $data = null;
        $lblrango = null;
        if (!is_null($request->get('checkRangos'))) {
            $dtDesde = $request->get('dtDesde');
            $dtHasta = $request->get('dtHasta');

            $lblrango = "<strong>Desde:</strong> " . $dtDesde . " <strong>Hasta:</strong> " . $dtHasta;
            $data = DB::table('sujetos')
                ->select("created_at as FechaCrecion", "DNI", "DNI", "Nombre", "Apellido", "Telefono", "Email", "Direccion")
                ->where('Activo', '=', 1)
                ->where('TipoSujeto', '=', 1)
                ->whereBetween('created_at', [$dtDesde, $dtHasta])
                ->get();
        } else {
            $dtMesAnio =  str_split($request->get('dtMesAnio'), 4);
            $mes = str_replace("-", "", $dtMesAnio[1]);
            $anio = $dtMesAnio[0];

            $lblrango = "<strong>Mes:</strong> " . date("F", mktime(0, 0, 0, (int) $mes, 10))  . " <strong>Año:</strong> " . $anio;
            $data = DB::table('sujetos')
                ->select("created_at as FechaCrecion", "DNI", "DNI", "Nombre", "Apellido", "Telefono", "Email", "Direccion")
                ->where('Activo', '=', 1)
                ->where('TipoSujeto', '=', 1)
                ->whereRaw('month(created_at) =?', [(int) $mes])
                ->whereRaw('year(created_at)=?', [(int) $anio])
                ->get();
        }

        $view =  view('reportes.rptForm.rptNuevosClientes')->with('emp', $emp[0])->with('lblrango', $lblrango)->with('data', $data);
        $pdf = PDF::loadHTML($view);
        return $pdf->download();
    }
}
