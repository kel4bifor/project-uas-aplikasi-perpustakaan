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
    <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Anggota</a>
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
                  <h4 class="card-title">Data Anggota</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>NPM</th>
                          <th>Prodi</th>
                          <th>Jenis Kelamin</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          @if($data->user->gambar)
                            <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                          @endif

                            {{$data->nama}}
                          </td>
                          <td>
                          <a href="{{route('anggota.show', $data->id)}}"> 
                            {{$data->npm}}
                          </a>
                          </td>

                          <td>
                          @if($data->prodi == 'RPL')
                            Rekayasa Perangkat Lunak
                          @elseif($data->prodi == 'TKJ')
                            Teknik Komputer Jaringan
                          @else
                            Mutimedia
                          @endif
                          </td>
                          <td>
                            {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                          </td>
                          <td>
                            <form action="{{route('anggota.edit', $data->id)}}">  
                            <button class="btn btn-warning" type="submit">Edit</button>
                          </form>
                            <form action="{{ route('anggota.destroy', $data->id) }}" class="pull-left"  method="post">
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
               {{--  {!! $datas->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection