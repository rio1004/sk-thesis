@extends('layouts.app')
@section('page-name')
    Request for Qoutation
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Request For Qoutation</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('qoutation.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Request For Qoutation
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Qoutation No.</th>
                        <th>Qoutation Date</th>
                        <th>Supplier</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @forelse ($qouatations as $qoutation)
                    <tr>
                        <input type="hidden" class="this_id" value="{{$qoutation->id}}">
                        <td class="font-w600 font-size-sm">
                          {{$qoutation->qoutation_no}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$qoutation->date}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$qoutation?->supplier?->supplier_name}}
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @livewire('pages.request-qoutation', ['qoutation' => $qoutation], key($qoutation->id))
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
                  url: '/delete-quatation/'+delete_this,
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
