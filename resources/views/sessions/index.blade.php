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
                        <li class="breadcrumb-item active">Sessions</li>
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
                            <h3 class="card-title">Sessions <a href="/admin/sessions/create">Create New</a>:-</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                        <th>Start Month</th>
                                        <th>End Month</th>
                                        <th>Honor Cutoff</th>
                                        <th>Exam Mark</th>
                                        <th>Total number of Sunday School</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions as $session)
                                    <tr>
                                        <td>{{$session->year}}</td>
                                        <td>{{$session->start_month}}</td>
                                        <td>{{$session->end_month}}</td>
                                        <td>{{$session->honor_cutoff}}</td>
                                        <td>{{$session->exam_full_mark}}</td>
                                        <td>{{$session->total_number_of_sunday_schools}}</td>
                                        <td>
                                        <form onsubmit="return confirm('Are you sure?')" action="/admin/sessions/{{$session->id}}" class="d-inline" method="post">
                                                @method('delete')
                                                @csrf
                                            <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                        </form>
                                            <a href="/admin/sessions/{{$session->id}}/edit" class="btn btn-primary btn-small">Edit</a>
                                            view members
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
