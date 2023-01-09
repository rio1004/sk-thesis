@extends('layouts.app')
@section('page-name')
    Budget
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Budget</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('budget.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Budget
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Initial Budget</th>
                        <th>Remaining Budget</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($budgets as $budget)
                        <tr>
                            <td>{{ $budget->fy_year }}</td>
                            <td>Php. {{ number_format($budget->initial_budget, 2) }}</td>
                            <td>Php. {{ number_format($budget->remaining_budget, 2) }}</td>
                            <td>@livewire('pages.budget', ['budget' => $budget], key($budget->id))</td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
