<?php

namespace App\Http\Controllers;
use App\Exceptions\Notificacion;
use Illuminate\Support\Facades\redirect;
use Illuminate\Support\Facades\Input;
use SGMA\Http\Request\CompraFormRequest;

use Illuminate\Http\Request;
use App\Models\DocumentoCompra;
use App\Models\DocumentoDetalleCompra;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class CompraController extends Controller
{
    // protected $DocumentoCompraModel;
    // public function __construct(DocumentoCompra $documentocompra)
    // {
    //     $this->DocumentoCompraModel = $documentocompra;
    // }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request) {
            $query = trim($request->input('searchText'));
            //DB::raw() permite escribir sentencias SQL en crudo
            $compras = DB::table('documento_compras as dc')
                ->join('sujetos as s', 's.id', '=', 'dc.SujetoId')
                ->join('documento_compra_detalles as dcd', 'dc.id', '=', 'dcd.DocumentoCompraId')
                ->join('productos as p', 'p.id', '=', 'dcd.ProductoId')
                ->select(
                    'dc.id', 'dc.NumeroCompra', 'dc.FechaDocumento', 'dc.NumeroDocumento',
                    's.id', 's.DNI', 'dc.Proveedor', 'dcd.Impuestos', 'dc.ValorSinImpuestos',
                    'dc.ValorImpuestos', DB::raw('sum(dcd.Cantidad * dcd.CostoUnitario) as Total')
                )

                ->where('dc.NumeroDocumento', 'LIKE', "%$query%")
                ->orderBy('dc.id', 'DESC')
                ->groupBy(
                    'dc.id', 'dc.NumeroCompra', 'dc.FechaDocumento', 'dc.NumeroDocumento',
                    's.id', 's.DNI', 'dc.Proveedor', 'dcd.Impuestos', 'dc.ValorSinImpuestos',
                    'dc.ValorImpuestos'
                )
                ->paginate(10);

            return view('compras.compras.index', ['compras' => $compras, 'searchText' => $query]);
        }
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
