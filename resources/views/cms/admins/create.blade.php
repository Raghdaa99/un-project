@extends('cms.parent')

@section('title',__('cms.create'))

@section('styles')

@endsection

@section('large-page-name',__('cms.create'))
@section('main-page-name',__('cms.admins'))
@section('small-page-name',__('cms.create'))

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
                        <h3 class="card-title">{{__('cms.create')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="role_id">{{__('cms.role')}}</label>
                                <select class="custom-select form-control-border" id="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="{{__('cms.enter_email')}}" name="email">
                            </div>
                            <div class="form-group">
                                <label for="gender">{{__('cms.gender')}}</label>
                                <select class="custom-select form-control-border" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
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
    function performStore() {
        axios.post('/cms/admin/admins', {
            name: document.getElementById('name').value,
            email_address: document.getElementById('email').value,
            role_id: document.getElementById('role_id').value,
            gender: document.getElementById('gender').value
        })
        .then(function (response) {
            //2xx
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            //4xx - 5xx
            console.log(error.response.data.message);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection