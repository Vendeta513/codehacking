@extends('layouts.admin')


@section('content')
  <h1>Media</h1>
  <form action="/admin/delete/multimedia" method="post" class="form-inline">
    {{ csrf_field() }}
    {{method_field('delete')}}

    <div class="form-group">
      <select name="checkBoxArray" class="form-control">
        <option value="">Delete</option>
      </select>

    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" name="multiple_remove">
    </div>

    <table class="table">
      <thead>
        <tr>
          <th> <input type="checkbox" id="choices" > </th>
          <th>Id</th>
          <th>Images</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        @if ($photos)
          @foreach ($photos as $photo)
            <tr>
              <td> <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$photo->id}}"> </td>
              <td>{{$photo->id}}</td>
              <td><img height="50" src="{{$photo->file}}" alt=""></td>
              <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
              {{-- <td>
                <input type="hidden" name="image_id" value="{{$photo->id}}">
                <div class="form-group">
                  <input type="submit" name="single_remove" value="Delete Picture" class="btn btn-danger">
                </div>
              </td> --}}
            </tr>

          @endforeach
        @endif



      </tbody>
    </table>
  </form>
@endsection


@section('footer')
  <script>
    $(document).ready(function(){
      $("#choices").click(function(){
        if(this.checked == true){
          $(".checkBoxes").each(function(){
            this.checked = true;
          });
        }else{
          $(".checkBoxes").each(function(){
            this.checked = false;
          })
        }

      });
    });
  </script>
@endsection
