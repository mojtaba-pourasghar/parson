{!! Form::label(__('user.user_title'),null,['class' => 'col-sm-2 control-label']) !!}
<div class="col-sm-3">
    {!! Form::text('user', $name , ['class' => 'form-control','id'=>'user']) !!}
</div>
<div class="col-sm-4">
    {!! Form::select('user_id',[] , null, ['data-placeholder'=>__('user.please_enter_user_name'),'class' => 'chosen-select chosen-rtl','style'=>'width: 350px;','id'=>'user_id']) !!}
</div>

@if(!empty($name))
    <script>
        var name = $('#user').val();
        var url = '{{ route("backend.users.getusers", ":name") }}';
        url = url.replace(':name', name);
        getUsers(name, url, '{{ csrf_token() }}', 'user_id');
    </script>
@endif

<script>

    $('#user_id').chosen({
        width: "100%",
        search_contains: true
    });

    $("#user").keyup(function () {
        var name = $(this).val();
        var url = '{{ route("backend.users.getusers", ":name") }}';
        url = url.replace(':name', name);
        getUsers(name, url, '{{ csrf_token() }}', 'user_id');
    });
</script>
