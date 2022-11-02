<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Departments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Departments</li>
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
                            <h3 class="card-title">Sunday school departments <a href="/admin/departments/create">Create New</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Hming</th>
                                            <th>Kum (minimum)</th>
                                            <th>Kum (maximum)</th>
                                            <th>Rei zawng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                        <tr>
                                            <td>{{$department->name}}</td>
                                            <td>{{$department->minimum_age}}</td>
                                            <td>{{$department->maximum_age}}</td>
                                            <td>{{$department->duration}}</td>
                                            <td>
                                                <form onsubmit="return confirm('Are you sure')" action="/admin/departments/{{$department->id}}" class="d-inline" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                                </form>
                                                <a class="btn btn-info btn-small" href="/admin/departments/{{$department->id}}/edit">Edit</a> 
                                                <a class="btn btn-info btn-small" href="#">
                                                    <i class="fa fa-users"></i>
                                                    View Members
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
