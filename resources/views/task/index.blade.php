@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @can('create task')
                    <a class="btn btn-primary" href="{{route('task.create')}}">create</a>
                    @endcan
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
                                    @can('update task')  
                                        <a href="{{route('task.edit', 1)}}">edit</a>
                                    @endcan
                                    @can('read tasks')  
                                        <a href="{{route('task.show', 1)}}">show</a>
                                    @endcan
                                    @can('delete task')  
                                        <a href="{{route('task.destroy', 1)}}">delate</a>
                                    @endcan
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Task 2</td>
                                <td>
                                    @can('update task')  
                                        <a href="{{route('task.edit', 1)}}">edit</a>
                                    @endcan
                                    @can('read tasks')  
                                        <a href="{{route('task.show', 1)}}">show</a>
                                    @endcan
                                    @can('delete task')  
                                        <a href="{{route('task.destroy', 1)}}">delate</a>
                                    @endcan
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Task 3</td>
                                <td>
                                    @can('update task')  
                                        <a href="{{route('task.edit', 1)}}">edit</a>
                                    @endcan
                                    @can('read tasks')  
                                        <a href="{{route('task.show', 1)}}">show</a>
                                    @endcan
                                    @can('delete task')  
                                        <a href="{{route('task.destroy', 1)}}">delate</a>
                                    @endcan
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