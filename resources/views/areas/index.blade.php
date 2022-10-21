<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Areas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kohhran chhung a bial hrang hrangte <a href="/areas/create">Create New</a>:-</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Hming</th>
                                        <th>Bial tu</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($areas as $area)
                                    <tr>
                                        <td>{{$area->name}}</td>
                                        <td>{{$area->bialtu->name}}</td>
                                        <td>
                                        <form onsubmit="return confirm('Are you sure?')" action="/areas/{{$area->id}}" class="d-inline" method="post">
                                                @method('delete')
                                                @csrf
                                            <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                        </form>
                                            <a href="/areas/{{$area->id}}/edit" class="btn btn-secondary btn-small">Edit</a>
                                            <a href="/" class="btn btn-primary btn-small">View Members</a>
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
    </section>

</x-admin-layout>
