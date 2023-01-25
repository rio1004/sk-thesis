@extends('layouts.app')
@section('page-name')
    Disbursement Voucher
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Disbursement Voucher</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('dibursement.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Disbursement Voucher
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>DV No.</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Check No.</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @forelse($dibursements as $disbursement)
                    <tr>
                        <input type="hidden" class="this_id" value="{{$disbursement->id}}">
                        <td>{{ $disbursement->dv_no }}</td>
                        <td>{{ $disbursement->dv_date->format('M. d, Y') }}</td>
                        <td>{{ $disbursement?->supplier?->supplier_name }}</td>
                        <td>{{ $disbursement->check_no }}</td>
                        <td>Php. {{ number_format($disbursement->total_amount, 2) }}</td>
                        <td>{{ $disbursement->status }}</td>
                        <td>
                            <div class="btn-group">
                            @livewire('pages.disbursement', ['disbursement' => $disbursement], key($disbursement->id))
                             <button type="button" class="btn btn-sm btn-alt-danger serviceDelete" data-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No data</td>
                    </tr>
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
                  url: '/delete-disbursment/'+delete_this,
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

