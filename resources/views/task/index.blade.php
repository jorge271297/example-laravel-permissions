@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Task 1</td>
                                <td>
                                    @can('update')  
                                        <a href="">edit</a>
                                    @endcan
                                    @can('update')  
                                        <a href="">show</a>
                                    @endcan
                                    @can('update')  
                                        <a href="">delate</a>
                                    @endcan
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Task 2</td>
                                <td>
                                    <a href="">edit</a>
                                    <a href="">show</a>
                                    <a href="">delate</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Task 3</td>
                                <td>
                                    <a href="">edit</a>
                                    <a href="">show</a>
                                    <a href="">delate</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection