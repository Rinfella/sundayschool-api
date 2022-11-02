<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department thar siamna</h1>
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
            <form action="/admin/groups/{{$group->id}}/enrollments" method="post">
            @csrf
            @for ($i = 0; $i < 20; $i++)
            <div class="form-group row ">
                <label class="form-label col-3 text-right" for="user_id">User</label>
                <select
                    class="form-control userSelector col-3 @error('user_id') is-invalid @enderror"
                    name="user_id[{{$i}}]"></select>
                <div class="invalid-feedback offset-3">{{ $errors->first('user_id['.$i.']') }}</div>
            </div>
            @endfor
            <input type="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
    @section('bottomResources')
        <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
        <script src="/plugins/select2/js/select2.full.min.js"></script>
        <script>
        $('.userSelector').select2({
            minimumInputLength: 4,
            ajax: {
            url: '/admin/users/search',
            dataType: 'json',
            delay: 1000,
            }
        })
        </script>
    @endsection
</x-admin-layout>