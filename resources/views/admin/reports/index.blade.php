@extends('admin.layouts.app')

@section('title', 'Отчеты')
@section('layout-title', 'Админ')
@section('page-title', 'Отчеты')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-2">Отчеты</h4>

                    <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-1">

                    </form>

                    <a class="btn btn-primary waves-effect waves-float waves-light" href="">Получить отчет</a>

                    <div class="table-responsive mt-2">
                        <table class="table">
                           <tr>
                               <td>Заявки в работе</td>
                               <td>1</td>
                           </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
