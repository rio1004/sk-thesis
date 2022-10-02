@if (session('success-message'))
<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h3 class="alert-heading h4 my-2">Success</h3>
    <p class="mb-0">{{session('success-message')}}</p>
</div>
@endif
