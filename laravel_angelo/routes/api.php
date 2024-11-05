<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorUsuarios;
use App\Http\Controllers\ControladorCliente;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [ControladorUsuarios::class, 'control']);

Route::get('/clientesList',[ControladorCliente::class, 'lista']); //lista todos los clientes
Route::get('/clientesCli/{id}',[ControladorCliente::class, 'cliente']); //obtiene un cliente
Route::post('/clientesCrea',[ControladorCliente::class, 'crear']); //creando un cliente
Route::put('/clientesAct/{id}',[ControladorCliente::class, 'actualizar']); //actualiza un cliente
Route::delete('/clientesElm/{id}',[ControladorCliente::class, 'eliminar']); //elimina un cliente
Route::patch('/clientesMod/{id}',[ControladorCliente::class, 'modificar']); //modifica un cliente sin importar que falte algun campo