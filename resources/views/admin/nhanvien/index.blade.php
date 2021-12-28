@extends('layouts.admin')
@section('main')
<form action="" class="form-inline mb-3">
  
  <div class="form-group ">
    <input class="form-control" name="tukhoa" placeholder="Nhập tên danh mục">
   </div>
   <button type="submit" class="btn btn-primary">
    <i class ="fas fa-search"></i>
  </button>
  @if(Auth::user()->chucvu_id==1)
  <a href="{{route('nhanvien.create')}}"  class="btn btn-secondary ml-5">Thêm</a>
  @endif
</form> 

<div class="card" >
 
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">SĐT</th>
            <th scope="col">Chức vụ</th>
            <th class="text-right" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->hovaten}}</td>
            <td>
              @if ($item->gioitinh_id==0)
              <span class="badge bg-navy">{{$item->gioitinh->gioitinh}}</span>
                
            @elseif($item->gioitinh_id==1)
            <span class="badge bg-olive">{{$item->gioitinh->gioitinh}}</span>
            @endif
            </td>
            <td>{{$item->diachi}}</td>
            <td>{{$item->sdt}}</td>
            <td>
              @if ($item->chucvu_id==1)
                <span class="badge bg-danger">{{$item->chucvu->tenchucvu}}</span>
                  
              @elseif($item->chucvu_id==3)
              <span class="badge bg-fuchsia">{{$item->chucvu->tenchucvu}}</span>
              @endif
          </td>
          @if(Auth::user()->chucvu_id==3)
            <td class="text-right">
              <a href="{{route('nhanvien.show',$item->id)}}" class="btn btn-sm btn-warning disabled">
                <i class="fas fa-eye"></i>              
              </a>
              <a href="{{route('nhanvien.edit',$item->id)}}" class="btn btn-sm btn-success disabled">
                <i class="fas fa-edit"></i>              
              </a> 
              <a  href="{{route('nhanvien.destroy',$item->id)}}" class="btn btn-sm btn-danger btndelete disabled">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          @elseif(Auth::user()->chucvu_id==1)
            <td class="text-right">
              <a href="{{route('nhanvien.show',$item->id)}}" class="btn btn-sm btn-warning">
                <i class="fas fa-eye"></i>              
              </a>
              <a href="{{route('nhanvien.edit',$item->id)}}" class="btn btn-sm btn-success">
                <i class="fas fa-edit"></i>              
              </a> 
              <a  href="{{route('nhanvien.destroy',$item->id)}}" class="btn btn-sm btn-danger btndelete">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          @endif
           
            </tr>
          @endforeach
        </tbody>
      </table>
      <form method="POST" action="" id="form-delete">
        @csrf @method('DELETE')
      <form>
    </div>
</div>

@endsection

@section('js')
<script>
  $('.btndelete').click(function(ev){
    ev.preventDefault();
    var _href=$(this).attr('href');
    $('form#form-delete').attr('action',_href);
   if(confirm('bạn có chắc muốn xóa nó không?')){
      $('form#form-delete').submit();
   }
    
  })
</script>

@endsection
