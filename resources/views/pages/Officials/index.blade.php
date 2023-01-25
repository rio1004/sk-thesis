@extends('layouts.app')
@section('page-name')
    Officials
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Officials</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('official.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Official
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Other Position</th>
                        {{-- <th>Barangay</th> --}}
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officials as $official)
                    <tr>
                        <input type="hidden" class="this_id" value="{{$official->id}}">
                        <td class="font-w600 font-size-sm">
                          {{$official->full_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$official->age}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->gender}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->position}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->other_position}}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @livewire('official.official', ['official' => $official], key($official->id))
                                <button type="button" class="btn btn-sm btn-alt-danger serviceDelete" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <td class="font-size-sm" colspan="7">No User Available</td>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){

    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.serviceDelete').click(function (e){
      e.preventDefault();

      var delete_this = $(this).closest("tr").find('.this_id').val();
      Swal.fire({
              title: 'Are you sure?',
              text: 'You cannot restore this once deleted!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                var data ={
                  "_token": $('input[name=_token]').val(),
                  "id": delete_this,
                };
                $.ajax({
                  type: "DELETE",
                  url: '/delete-official/'+delete_this,
                  data: data,
                  success: function(response){
                     Swal.fire(
                      'Removed!',
                      'Successfully Deleted.',
                      'success',
                      response.status,
                    ).then((result) => {
                      location.reload();
                    });
                    }
                });
              }
            })
          })
        });
</script>
@endsection()
