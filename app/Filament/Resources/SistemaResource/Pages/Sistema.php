<?php

namespace App\Filament\Resources\SistemaResource\Pages;

use App\Filament\Resources\SistemaResource;
use Filament\Resources\Pages\Page;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Sistema extends Page
{
    protected static string $resource = SistemaResource::class;

    protected static string $view = 'filament.resources.sistema-resource.pages.sistema';
    public $logo;
    public function mount(Request $request)
    {
        $this->logo = Option::where("clave","logo")->pluck("valor")[0];
        if($request->file('logo')){
            dd($request->file('logo'));
        }
    }
}
