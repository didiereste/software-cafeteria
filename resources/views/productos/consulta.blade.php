@extends('layaout.navbar')
@section('contenido')
<link rel="stylesheet" href="{{ asset('css/consulta.css') }}">
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="row">

    <div class="col-lg-5">
        <div id="barras-chart" class="grafico mt-4"></div>
    </div>

    <div class="col-lg-2">
        @if($productoMasVendido)
            <table class="table text-center mt-4">
                <thead class="table-dark">
                    <th colspan="2">Producto mas vendido</th>
                </thead>
                <thead>
                    <tr>
                        <td>{{ $productoMasVendido->nombre_producto }}</td>
                        <td>{{ $productoMasVendido->total_ventas }}</td>
                    </tr>
                </thead>
            </table>
        @endif
    </div>

    <div class="col-lg-5">
        <div id="barras-stock-chart" class="grafico mt-4 mb-4"></div>
    </div>
    
    <script>
       
        var productosVentasData = @json($productosVentas->pluck('ventas_count'));
        var productosVentasCategorias = @json($productosVentas->pluck('nombre_producto'));

        
        Highcharts.chart('barras-chart', {
            chart: {
                type: 'bar',
                backgroundColor: 'rgba(255, 255, 255, 0.7)'
            },
            title: {
                text: 'Productos con mas registros de ventas'
            },
            xAxis: {
                categories: productosVentasCategorias
            },
            yAxis: {
                title: {
                    text: 'Cantidad ventas'
                }
            },
            series: [{
                name: 'Ventas',
                data: productosVentasData
            }]
        });
       
        
        var productosStockData = @json($productosStock->pluck('stock'));
        var productosStockCategorias = @json($productosStock->pluck('nombre_producto'));
    
        Highcharts.chart('barras-stock-chart', {
            chart: {
                type: 'bar',
                backgroundColor: 'rgba(255, 255, 255, 0.7)'
            },
            title: {
                text: 'Productos con Mayor Stock'
            },
            xAxis: {
                categories: productosStockCategorias
            },
            yAxis: {
                title: {
                    text: 'Cantidad en Stock'
                }
            },
            series: [{
                name: 'Stock',
                data: productosStockData
            }]
        });
    </script>
@endsection