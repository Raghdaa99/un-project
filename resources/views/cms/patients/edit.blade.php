@extends('cms.parent')

@section('title',__('cms.patient'))

@section('styles')

@endsection

@section('large-page-name',__('cms.update'))
@section('main-page-name',__('cms.patient'))
@section('small-page-name',__('cms.update'))

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.update')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                           
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"
                                    name="name" value="{{$patient->name}}">
                            </div>
                           <div class="form-group">
                                <label for="age">{{__('cms.age')}}</label>
                                 <input type="number" class="form-control" id="age" placeholder="{{__('cms.enter_age')}}" name="age"
                                 value="{{$patient->age}}" >
                            </div>
                                            
                            <div class="form-group">
                            <label for="phone">{{__('cms.phone')}}</label>
                             <input type="text" class="form-control" id="phone" placeholder="{{__('cms.enter_phone')}}"
                              name="phone" value="{{$patient->phone}}">
                             </div>


                            <div class="form-group">
                                <label for="gender">{{__('cms.gender')}}</label>
                                <select class="custom-select form-control-border" id="gender">
                                    <option value="Male" @if($patient->gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($patient->gender == 'Female') selected @endif>Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate()"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    function performUpdate() {
        axios.put('/cms/admin/patients/{{$patient->id}}', {
            name: document.getElementById('name').value,
            age: document.getElementById('age').value,
            phone: document.getElementById('phone').value,
            gender: document.getElementById('gender').value
        })
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            //
            window.location.href = '/cms/admin/patients';
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection