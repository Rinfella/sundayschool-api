<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Groups/Pawl</h1>
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sunday school pawl hrang hrang te </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Hming</th>
                                            <th>Department</th>
                                            <th>Zirtirtu Pawl</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groups as $group)
                                        <tr>
                                            <td>{{$group->teacherAppointment ? $group->teacherAppointment->teacher->user->name . ' Pawl (' . $group->name . ')' : $group->name}}</td>
                                            <td>{{$group->department->name}}</td>
                                            <td class="{{$group->is_teacher_group ? 'text-success' :  'text-danger'}}"">{{$group->is_teacher_group ? '✓' : '✕'}}</td>
                                            <td>
                                                <form onsubmit="return confirm('Are you sure')" action="/admin/groups/{{$group->id}}" class="d-inline" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input class="btn btn-danger btn-small" type="submit" value="Delete">
                                                </form>
                                                <a class="btn btn-info btn-small" href="/admin/groups/{{$group->id}}/edit">Edit</a> 
                                                <a class="btn btn-info btn-small" href="/admin/groups/{{$group->id}}/enrollments">
                                                    <i class="fa fa-users"></i>
                                                    View Members
                                                </a>
                                                <a class="btn btn-info btn-small" title="Zirlai enroll-na" href="/admin/groups/{{$group->id}}/enrollments/create">
                                                    <i class="fa fa-users"></i>
                                                    Enroll Members
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$groups->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
