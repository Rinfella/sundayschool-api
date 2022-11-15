<x-admin-layout>
    <script>
        let total = {{$total}};

        function submitForm() {
            document.getElementById('attendanceForm').submit()
        }

        function fillTotals() {
            total = event.target.value
            Array.from(document.getElementsByClassName('total-input')).forEach(input => input.value = total || 0)
            Array.from(document.getElementsByClassName('present-input')).forEach(input => input.value = total || 0)
            Array.from(document.getElementsByClassName('absent-input')).forEach(input => input.value = 0)
        }

        function calculateAbsentInput() {
            const element = event.target
            const enrollmentId = element.dataset.enrollmentId
            document.getElementById('absent-input-' + enrollmentId).value= total - element.value
            // console.log(element)
            // console.log(element.parentNode)
            // console.log(element.dataset.enrollmentId)
            // document.querySelectorAll('[data-enrollment-id=' + + ']');

        }
    </script>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Entry</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/teachers">Zirtirtu</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card-body">
            <form action="/admin/monthly-report/entry" method="post" id="monthlyReportForm">
                @csrf

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="month">Month</label>
                    @php
                        $months = array();
                        for ($i = 1; $i <= 12; $i++) {
                            $timestamp = mktime(0, 0, 0, $i, 1);
                            $months[date('n', $timestamp)] = date('F', $timestamp);
                        }
                    @endphp 
                    <select name="month" id="month">
                        @foreach ($months as $key => $value)
                            <option value="{{$key}}" @selected($month == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('date') }}</div>
                </div>

                
                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="department_id">Department</label>
                    <select
                        class="form-control col-3 @error('department_id') is-invalid @enderror"
                        name="department_id" id="department_id"
                        onchange="submitForm"
                        value="{{old('department_id')}}">
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('department_id') }}</div>
                </div>
                

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="group_id">Group</label>
                    <select
                        class="form-control col-3 @error('group_id') is-invalid @enderror"
                        name="group_id" id="group_id"
                        onchange="submitForm"
                        value="{{old('group_id')}}">
                    </select>
                    <div class="invalid-feedback offset-3">{{ $errors->first('group_id') }}</div>
                </div>

                <div class="form-group row ">
                    <label class="form-label col-3 text-right" for="total">Total Attendance</label>
                    <input type="number"
                        class="form-control col-3"
                        name="total" id="total"
                        onkeyup="fillTotals()"
                        value="{{$total}}">
                </div>

                {{-- Date, Department leh group te hi thlak apiangin form a in submit anga. Teacher appointment ang khan a kal ang --}}

                <fieldset>
                    <legend>Zirlaite</legend>
                    @foreach ($enrollments as $enrollment)
                    <div class="form-group row ">
                        <label class="form-label col-3 text-right" for="enrollment_{{$enrollment->id}}">{{$enrollment->user->name}} {{$enrollment->status}}</label>
                        <div class="col">
                            <label class="form-label col-3 text-right" >Total</label>
                            <input 
                            placeholder="Total"
                            class="total-input" 
                            disabled 
                            type="number"
                            value="{{$enrollment->total}}">
                        </div>
                        <div class="col">
                            <label class="form-label col-3 text-right" >Present</label>
                            <input 
                            placeholder="Present"
                            class="present-input" 
                            type="number"
                            data-enrollment-id="{{$enrollment->id}}"
                            oninput="calculateAbsentInput()"
                            name="enrollments[{{$enrollment->id}}]" 
                            value="{{$enrollment->present ?? $total}}">
                        </div>
                        <div class="col">
                            <label class="form-label col-3 text-right" >Absent</label>
                            <input 
                            placeholder="Absent"
                            class="absent-input" 
                            data-enrollment-id="{{$enrollment->id}}"
                            type="number"
                            disabled
                            id="absent-input-{{$enrollment->id}}"
                            value="{{$enrollment->absent??0}}">
                        </div>
                    </div>
                    @endforeach
                    
                </fieldset>

                <div class="form-group row">
                    <input type="submit" value="submit" class="offset-3 mr-3 btn btn-primary">
                </div>
            </form>
        </div>
    </section>
</x-admin-layout>
