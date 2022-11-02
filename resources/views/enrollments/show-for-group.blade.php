<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$group->name}} Zirlaite</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Departments</a></li>
                        <li class="breadcrumb-item active">Create Department</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Pa Hming</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Kal Kim</th>
                        <th>Kal Loh Zat</th>
                        <th>Exam Honour</th>
                        <th>Exam Marks</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>
                            {{$enrollment->user->name}}
                        </td>
                        <td>
                            {{$enrollment->user->fathers_name}}
                        </td>
                        <td>
                            {{$enrollment->user->phone}}
                        </td>
                        <td>
                            {{$enrollment->user->email}}
                        </td>
                        <td class="{{$enrollment->full_attendance ? 'text-success' :  'text-danger'}}"">
                            {{$enrollment->full_attendance ? '✓' : '✕'}}
                        </td>
                        <td>
                            {{$enrollment->absent_count}}
                        </td>
                        <td class="{{$enrollment->exam_honours ? 'text-success' :  'text-danger'}}"">
                            {{$enrollment->exam_honours ? '✓' : '✕'}}
                        </td>
                        <td>
                            {{$enrollment->exam_marks}}
                        </td>
                        <td>
                            <form onsubmit="return confirm('Are you sure')" action="/admin/enrollments/{{$enrollment->id}}" class="d-inline" method="post">
                                @method('delete')
                                @csrf
                                <input class="btn btn-danger btn-small" type="submit" value="Delete">
                            </form>
                            <a class="btn btn-info btn-small" href="/admin/groups/{{$group->id}}/enrollments/{{$enrollment->id}}edit">Edit</a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>