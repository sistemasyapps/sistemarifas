<?php

namespace App\Http\Controllers;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function getTopTen() {
        $raffle = DB::select("SELECT id FROM `raffles` WHERE fecha_inicial < now() and fecha_final > now()");

        $top = DB::select("SELECT
            client_id, sum(cantidad) as cant, UPPER(clients.nombre_completo) as nombre
        FROM
            orders
        INNER JOIN clients on clients.id = orders.client_id
        WHERE
            estatus = 1 and raffle_id = ".$raffle[0]->id."
        GROUP BY
            client_id
        ORDER BY
            cant DESC
        limit 10");

        $add=[
            // (object) array(
            //     "client_id" => 9991,
            //     "cant" => "686",
            //     "nombre" => "JOHAN ALIGIERI"
            // ),
            // (object) array(
            //     "client_id" => 9990,
            //     "cant" => "295",
            //     "nombre" => "JOSE RODRIGUEZ"
            // ),
        ];

        array_push($top,...$add);
        // $top[1]->cant = 475;
        usort($top, fn ($a, $b) => $a->cant < $b->cant);

        $data = [
            "patrocinadores" => Sponsor::All(),
            "topten" => $top
        ];

        return view('top',$data);
    }
}
