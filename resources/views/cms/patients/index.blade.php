@extends('cms.parent')

@section('title',__('cms.patient'))

@section('styles')

@endsection

@section('large-page-name',__('cms.index'))
@section('main-page-name',__('cms.patient'))
@section('small-page-name',__('cms.index'))

@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Bordered Table</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>{{__('cms.name')}}</th>
                  <th>{{__('cms.age')}}</th>
                  <th>{{__('cms.phone')}}</th>
                  <th>{{__('cms.gender')}}</th>
                  <th>{{__('cms.created_at')}}</th>
                  <th>{{__('cms.updated_at')}}</th>
                  <th style="width: 40px">Settings</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($patients as $Patient)
                <tr>
                  
                  <td>{{$Patient->id}}</td>
                  <td>{{$Patient->name}}</td>
                  <td>{{$Patient->age}}</td>
                  <td>{{$Patient->phone}}</td>
                  <td>{{$Patient->gender}}</td>
                  <td>{{$Patient->created_at}}</td>
                  <td>{{$Patient->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      @can('Update-Patient')
                     <a href="{{route('patients.edit',$Patient->id)}}" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      @endcan
                      @can('Delete-Patient')
                      <a href="#" onclick="confirmDelete('{{$Patient->id}}',this)" class=" btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
                      @endcan
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">

          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id,reference) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        performDelete(id,reference);
      }
    });
  }
  
  function performDelete(id,reference) {
    axios.delete('/cms/admin/patients/'+id)
    .then(function (response) {
        //2xx
        console.log(response);
        toastr.success(response.data.message);
        reference.closest('tr').remove();
    })
    .catch(function (error) {
        //4xx - 5xx
        console.log(error.response.data.message);
        toastr.error(error.response.data.message);
    });    
  }
</script>
@endsection