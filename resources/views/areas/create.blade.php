<x-main-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/areas">Areas</a></li>
                        <li class="breadcrumb-item active">Create Area</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="/areas" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="inputPerson_in_charge">Person In Charge</label>
                  <input type="text" class="form-control" name="person_in_charge" placeholder="Enter number">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" value="submit" class="btn btn-primary">Submit</button>
              </div>
        {{-- <input type="text" name="name">
        <input type="text" name="person_in_charge">
        <input type="submit" value="submit"> --}}
        </form>
    </section>
</x-main-layout>
