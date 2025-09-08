<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use App\Models\Raffle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PreOrderController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'raffle_id' => 'required|integer|exists:raffles,id',
            'cantidad' => 'required|integer|min:1',
            'cedula' => 'required|string',
            'nombre_completo' => 'required|string',
            'correo' => 'required|string',
            'telefono' => 'required|string',
            'bank_code' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $raffle = Raffle::findOrFail($request->raffle_id);

        $monto = round($raffle->precio * $request->cantidad, 2);

        // Normalizar cédula a solo números para guardar en pre_orden
        $cedulaNumerica = preg_replace('/[^0-9]/', '', (string) $request->cedula);

        $data = [
            'uuid' => Str::uuid()->toString(),
            'raffle_id' => (int) $request->raffle_id,
            'cantidad' => (int) $request->cantidad,
            'cedula' => $cedulaNumerica,
            'nombre_completo' => (string) $request->nombre_completo,
            'correo' => (string) $request->correo,
            'telefono' => (string) $request->telefono,
            'bank_code' => (string) $request->bank_code,
            'monto' => $monto,
            'IP' => $request->ip(),
        ];

        $preOrder = PreOrder::create($data);

        Log::info('PreOrder creada', ['uuid' => $preOrder->uuid, 'cedula' => $preOrder->cedula, 'monto' => $preOrder->monto]);

        return response()->json([
            'success' => true,
            'pre_order' => $preOrder,
        ], 201);
    }
}
