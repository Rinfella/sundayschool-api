<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Groups / Pawl</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Groups</li>
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
                            <h3 class="card-title">Sunday school pawl hrang hrang te:<a href="/admin/groups/create">Create New</a>:-</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Hming</th>
                                        <th>Department</th>
                                        <th>Zirtirtu</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                    <tr>
                                        <td>{{$group->name}}</td>
                                        <td>{{$group->department->name}}</td>
                                        <td>{{$group->is_teacher_group}}</td>
                                        <td>
                                        <form onsubmit="return confirm('Are you sure?')" action="/admin/groups/{{$group->id}}" class="d-inline" method="post">
                                                @method('delete')
                                                @csrf
                                            <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                        </form>
                                            <a href="/admin/groups/{{$group->id}}/edit" class="btn btn-secondary btn-small">Edit</a>
                                            <a href="/" class="btn btn-primary btn-small">View Members</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                {{$groups->links()}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-admin-layout>
