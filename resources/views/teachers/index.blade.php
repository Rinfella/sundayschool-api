<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Zirtirtu te</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/">Home</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sunday Zirtirtu te </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Zirtirtu</th>
                                            <th>Session</th>
                                            <th>Department</th>
                                            <th>Pawl</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{$teacher->user->name}}</td>
                                            <td>{{$teacher->session->year}}</td>
                                            <td>{{$teacher->appointment->department->name}}</td>
                                            <td>{{$teacher->appointment->group->name}}</td>
                                            <td>
                                                <form onsubmit="return confirm('Are you sure')" action="/admin/teachers/{{$teacher->id}}" class="d-inline" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                                </form>
                                                <a class="btn btn-info btn-small" href="/admin/teachers/{{$teacher->id}}/edit">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$teachers->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
