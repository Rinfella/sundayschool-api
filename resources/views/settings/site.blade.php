<x-admin-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Website Settings</li>
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
                            <h3 class="card-title">Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/admin/settings" method="post">
                                @csrf
                                
                                @foreach ($settings as $setting)
                                    @if(in_array($setting->type, ['textarea', 'select', 'multiselect', 'teacher', 'radio', 'checkbox']))
                                        @include('components.form-fields.' . $setting->type, ['setting' => $setting])
                                    @else
                                        @include('components.form-fields.generic', ['setting' => $setting])
                                    @endif
                                @endforeach

                                <input type="submit" class="btn btn-primary" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
