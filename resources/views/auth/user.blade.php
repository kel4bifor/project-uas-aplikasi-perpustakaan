@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah User</a>
  </div>
    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data User</h4>
                  
                  <div class="table-responsive">
                    <table id="table" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Dibuat Tangal</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          @if($data->gambar)
                            <img src="{{url('images/user', $data->gambar)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />

                          @endif


                            {{$data->name}}
                          </td>
                          <td><a href="{{route('user.show', $data->id)}}"> 
                          {{$data->username}}</a></td>
                          <td>{{$data->email}}</td>
                          <td>{{$data->created_at}}</td>
                          <td>
                          <form action="{{route('user.edit', $data->id)}}">  
                            <button class="btn btn-warning" type="submit">Edit</button>
                          </form>
                            <form action="{{ route('user.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                              <button class="btn btn-danger" type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{-- {!! $datas->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection